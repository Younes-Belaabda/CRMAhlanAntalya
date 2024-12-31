<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\Models\Payment;

class PaymentController extends Controller
{

    public function __construct()
    {
    //   $this->middleware('auth');
    }

    public function index(Request $request,$type,$price)
    {
        $requests = $request->all();
        return view('Payment.view' , compact('requests',"price",'type'));

    }

    public function pay(Request $request)
    {
        $id=$request->id;
        $mdStatus=1;
    	$storekey="Ahlan2006";

		$name="ynijme";
		$password="Zx-cv2006@";

		$clientid=$request->clientid;

		$mode = "P";                        //P is constant
		$type="Auth";   					//Transaction type
		$amount=$request->amount;           //Transaction amount
		$instalment="";           			//Instalment count. If there's no instalment, empty string should be passed
		$currency=$request->currency;

		$lip=$request->ip();  	//Client's IP address

		$xid=$request->xid;                 //3D Secure special field: PayerTxnId
		$eci=$request->eci;                 //3D Secure special field: PayerSecurityLevel
		$cavv=$request->cavv;               //3D Secure special field: PayerAuthenticationCode
		$md=$request->md;                   //Credit card number should not be send. Instead "md" value from 3D page should be passed.

		$oid = microtime().rand(1000,100000);
        $rand = microtime().rand(100,5000);

        $pan = $request->pan;

        $status = "";
		if($mdStatus =="1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4")
		{
    		//XML Request template
    		$request= "DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>".
    		"<CC5Request>".
    		"<Name>{NAME}</Name>".
    		"<Password>{PASSWORD}</Password>".
    		"<ClientId>{CLIENTID}</ClientId>".
    		"<IPAddress>{IP}</IPAddress>".
    		"<Mode>P</Mode>".
    		"<OrderId>{OID}</OrderId>".
    		"<GroupId></GroupId>".
    		"<TransId></TransId>".
    		"<UserId></UserId>".
    		"<Type>{TYPE}</Type>".
    		"<Number>{pan}</Number>".
    		"<Expires></Expires>".
    		"<Cvv2Val></Cvv2Val>".
    		"<Total>{AMOUNT}</Total>".
    		"<Currency>{CURRENCY}</Currency>".
    		"<Taksit>{INSTALMENT}</Taksit>".
    		"<PayerTxnId>{XID}</PayerTxnId>".
    		"<PayerSecurityLevel>{ECI}</PayerSecurityLevel>".
    		"<PayerAuthenticationCode>{CAVV}</PayerAuthenticationCode>".
    		"<Extra></Extra>".
    		"</CC5Request>";

    		//Replacing values in the XML template
    		$request=str_replace("{NAME}",$name,$request);
    		$request=str_replace("{PASSWORD}",$password,$request);
    		$request=str_replace("{CLIENTID}",$clientid,$request);
    		$request=str_replace("{IP}",$lip,$request);
    		$request=str_replace("{OID}",$oid,$request);
    		$request=str_replace("{TYPE}",$type,$request);
    		$request=str_replace("{XID}",$xid,$request);
    		$request=str_replace("{ECI}",$eci,$request);
    		$request=str_replace("{CAVV}",$cavv,$request);
    		$request=str_replace("{MD}",$md,$request);
    		$request=str_replace("{AMOUNT}",$amount,$request);
    		$request=str_replace("{INSTALMENT}",$instalment,$request);
    		$request=str_replace("{CURRENCY}",$currency,$request);
    		$request=str_replace("{pan}",$pan,$request);

            $url = "https://sanalpos.isbank.com.tr/fim/api";  //API server path

    		$ch = curl_init();    // initialize curl handle

    		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
    		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
    		curl_setopt($ch, CURLOPT_SSLVERSION, 0);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
    		curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90s
    		curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($request)); // add POST fields

    		$result = curl_exec($ch); // run the whole process

    		dd($result);

    		if (curl_errno($ch))
    		{
              $status = "Payment operation unsuccessful";
    		}
    		else
    		{
              curl_close($ch);

    			$response_tag="Response";
    			$posf = strpos (  $result, ("<" . $response_tag . ">") );
    			$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;
    			$posf = $posf+ strlen($response_tag) +2 ;
    			$Response = substr (  $result, $posf, $posl - $posf) ;

    		   if ( $Response == "Approved")
    			{
    				$status = "Your payment is approved";
    			}
    			else
    			{
    				$status = "Your payment is not approved";
    			}
    		}
    	}
    	else
    	{
    		$status = "3D Authentication is not successful. Payment request not sent";
    	}

    	dd($status);
        return view('Payment.paid' , compact('requests','status'));

    }

    public function paid(Request $request,$type,$price)
    {
        $clientid        = "700677004046";
        $storekey        = "Ahlan2006";
        $islemTipi       = "Auth";
        $returnURL       = "https://ahlanantalya.com.tr/payment/pay.php";
        // Edit by sohaib
        // $storetype       = "3d";
        $storetype       = "3D";
        $hashAlgorithm = "ver3";
        // end edit
        $postURL         = "https://sanalpos.isbank.com.tr/fim/est3Dgate";

        $requests = $request->all();
        $tutar = $request->amount;

        $request->pan= str_replace(' ', '', $request->pan );

        $paraBirimiKodu = $request->currency;


        $id = Payment::insertGetId([
            "name"=> $request->holder,
            "pan"=> $request->pan,
            "date"=> $request->Ecom_Payment_Card_ExpDate_Month."/".$request->Ecom_Payment_Card_ExpDate_Year,
            "cv2"=> $request->cv2,
            "amount"=> $request->amount,
            "currency"=> $request->currency,
        ]);

        $taksit = "";
        $oid = microtime().rand(1000,100000);
        $rand = microtime().rand(100,5000);

        $url = $returnURL."?id=".$id;
        // $hashstr = $clientid . $oid . $tutar . $url . $url .$islemTipi. $taksit .$rand .$storekey;
        // $hashCode = base64_encode(pack('H*',sha1($hashstr)));

        $hashstr = $clientid . $oid . $tutar . $url . $url . $islemTipi . $taksit . $rand . $storekey;
        $hashCode = base64_encode(hash_hmac('sha256', $hashstr, $storekey, true));



        $hashCode = base64_encode(pack('H*',sha1($hashstr)));

        $sendData = array(
          "clientid"=>$clientid ,
          "storetype"=>$storetype,
          "storekey"=>$storekey,
          "hash"=>$hashCode,
          "islemtipi"=>$islemTipi,
          "amount"=>$tutar,
          "oid"=>$oid,
          "currency"=>$paraBirimiKodu,
          "okUrl"=>$url,
          "failUrl"=> $url,
          "lang"=>"en",
          "rnd"=>$rand,
          "taksit"=>$taksit,

          "encoding"=>$request->encoding,
          "pan"=>$request->pan,
          "cv2"=>$request->cv2,
          "Ecom_Payment_Card_ExpDate_Month"=>$request->Ecom_Payment_Card_ExpDate_Month,
          "Ecom_Payment_Card_ExpDate_Year"=>$request->Ecom_Payment_Card_ExpDate_Year,
          "cardType"=>$request->cardType,
        );

        $postdata = http_build_query($sendData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $postURL);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        //curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));

        $data = curl_exec($ch);
        curl_close($ch);

        dd($data);
        return $data;
    }

    public function newPay(Request $request)
    {
        // dd($request->all());


        // Payment credentials from environment variables
        $name="ynijme";
        $password="Zx-cv2006@";
        $clientId = "700677004046";

        // Payment information from the request
        $orderId = microtime().rand(1000,100000); // Unique Order ID
        $cardNumber = $request->input('pan');
        $expiryDate = $request->Ecom_Payment_Card_ExpDate_Month."/".$request->Ecom_Payment_Card_ExpDate_Year; // Format: MM/YYYY
        $cvv = $request->input('cv2');
        $totalAmount = $request->amount; // Decimal total amount (e.g., 100.00)
        $currency = $request->currency; // Currency code for Turkish Lira

        // Create the XML request body
        $xmlRequest = "
        <CC5Request>
            <Name>{$name}</Name>
            <Password>{$password}</Password>
            <ClientId>{$clientId}</ClientId>
            <Type>Auth</Type>
            <IPAddress>{$request->ip()}</IPAddress>
            <Email>{$request->input('email')}</Email>
            <OrderId>{$orderId}</OrderId>
            <Total>{$totalAmount}</Total>
            <Currency>{$currency}</Currency>
            <Number>{$cardNumber}</Number>
            <Expires>{$expiryDate}</Expires>
            <Cvv2Val>{$cvv}</Cvv2Val>
            <PayerTxnId></PayerTxnId>
            <PayerSecurityLevel></PayerSecurityLevel>
            <PayerAuthenticationCode></PayerAuthenticationCode>
        </CC5Request>";

        // Send the request to Nestpay API
        $url = "https://sanalpos.isbank.com.tr/fim/api"; // API endpoint URL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);

        $response = curl_exec($ch);
        curl_close($ch);


         $response = new \SimpleXMLElement($response);


         $maskedCardNumber = substr($request->pan, 0, 4) . ' **** **** ' . substr($request->pan, -4);
          if ($response->Response == 'Approved') {
                $status = 1;
          }else{
                $status = 0;
          }

         $id = Payment::insertGetId([
            "name"=> $request->holder,
            "pan"=> $maskedCardNumber,
            "date"=> $request->Ecom_Payment_Card_ExpDate_Month."/".$request->Ecom_Payment_Card_ExpDate_Year,
            "cv2"=> 000,
            "amount"=> $request->amount,
            "currency"=> $request->currency,
            "craeted_at" => now(),
            "status" => $status,
            "res" => $response->ErrMsg . " | " . (string) $response->Extra->HOSTMSG
        ]);

        $record = Payment::find($id);
        if ($record) {
            $time = $record->created_at;

        }

        // Parse XML response
        //$response =  simplexml_load_string($response);

         if ( $response->Response == 'Approved')
		{
			$status = "Paid Successfully";
		}
		else
		{
			$status = "Payment Declined !!";
		}


        // Handle the response
        if ($response->Response == 'Approved') {
            return view('Payment.success' , compact('response','status', 'time'));
            // return view('Payment.paid' , compact('response','status', 'time'));
            //return response()->json(['message' => 'Payment successful', 'transaction_id' => $response->TransId], 200);
        } else {
            $err = $response->ErrMsg;
             return view('Payment.fail' , compact('response','status', 'time' , 'err'));
            // return view('Payment.paid' , compact('response','status', 'time'));
            // return response()->json(['error' => $response->ErrMsg], 400);
        }
    }





}
