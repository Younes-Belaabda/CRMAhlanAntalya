<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>3D Model Payment Page</title>
    <style type="text/css">
        body
        {
            border-style: none;
            color: #6B7983;
            font-family: Tahoma,Arial,Verdana,Sans-Serif;
            font-size: 12px;
            font-weight: normal;
        }
        
        tableClass
        {
            margin: 0;
        }
        td
        {
            color: #6B7983;
            font-family: Tahoma,Arial,Verdana,Sans-Serif;
            font-size: 12px;
            font-weight: normal;
            vertical-align: top;
            background: none repeat scroll 0 0 #FFFFFF;
            border-color: #C3CBD1;
            border-style: solid;
            border-width: 0 1px 1px 0;
            padding: 8px 20px;
        }
        .trHeader td
        {
            color: #FFA92D;
            font-weight: bold;
        }
        span
        {
            margin: 0px 0px 6px 0px;
            font-size: 14px;
            font-weight: bold;
        }
        h3
        {
            margin: 0px 0px 6px 0px;
            font-size: 14px;
            font-weight: bold;
            color: #518ccc;
        }
        h1
        {
            font-family: Calibri, Tahoma, Arial, Verdana, Sans-Serif;
            font-size: 24px;
            font-weight: normal;
            color: #51596a;
        }
    </style>
</head>
<body>
    
    <?php
    
        $servername = "localhost";
        $username = "antalyatr_db";
        $password = "!}7vm{xFw^Q.";
        $dbname = "antalyatr_db";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $id=$_GET['id'];
        $mdStatus=$_POST['mdStatus'];       //Result of the 3D Secure authentication. 1,2,3,4 are successful; 5,6,7,8,9,0 are unsuccessful.
    	$storekey="Ahlan2006";
    	
	?>
    <h1>
     Ahlan Antalya Payment Page Status</h1>
     <?php
		$name="ynijme";       			//API user name
		$password="Zx-cv2006@";    			//API password

		$clientid=$_POST["clientid"];  		//Merchant Id

		$mode = "P";                        //P is constant
		$type="Auth";   					//Transaction type				
		$amount=$_POST["amount"];           //Transaction amount
		$instalment="";           			//Instalment count. If there's no instalment, empty string should be passed
		$currency=$_POST['currency'];  
												
		$lip=GetHostByName($REMOTE_ADDR);  	//Client's IP address

		$xid=$_POST['xid'];                 //3D Secure special field: PayerTxnId
		$eci=$_POST['eci'];                 //3D Secure special field: PayerSecurityLevel
		$cavv=$_POST['cavv'];               //3D Secure special field: PayerAuthenticationCode
		$md=$_POST['md'];                   //Credit card number should not be send. Instead "md" value from 3D page should be passed.
	 ?>
	 <h3>Payment Result</h3><br /><br />
	 <table class="tableClass">
	 <tr><td><h3> Payment Result:&nbsp;</h3></td><td><span>
	 <?php
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
		"<Number>{MD}</Number>".
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

        $url = "https://sanalpos.isbank.com.tr/fim/api";  //API server path
		
		$ch = curl_init();    // initialize curl handle
		
		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
		curl_setopt($ch, CURLOPT_SSLVERSION, 0);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90s
		curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode($request)); // add POST fields

		$result = curl_exec($ch); // run the whole process

		if (curl_errno($ch)) 
		{
           echo "<font color=\"red\">Payment operation unsuccessful.</font>";
		}
		else 
		{
           curl_close($ch);
		   
		   $Response ="";
			$OrderId ="";
			$AuthCode  ="";
			$ProcReturnCode    ="";
			$ErrMsg  ="";
			$HOSTMSG  ="";
			$HostRefNum = "";
			$TransId="";

			$response_tag="Response";
			$posf = strpos (  $result, ("<" . $response_tag . ">") );
			$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$Response = substr (  $result, $posf, $posl - $posf) ;

			$response_tag="OrderId";
			$posf = strpos (  $result, ("<" . $response_tag . ">") );
			$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$OrderId = substr (  $result, $posf , $posl - $posf   ) ;

			$response_tag="AuthCode";
			$posf = strpos (  $result, "<" . $response_tag . ">" );
			$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$AuthCode = substr (  $result, $posf , $posl - $posf   ) ;

			$response_tag="ProcReturnCode";
			$posf = strpos (  $result, "<" . $response_tag . ">" );
			$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$ProcReturnCode = substr (  $result, $posf , $posl - $posf   ) ;

			$response_tag="ErrMsg";
			$posf = strpos (  $result, "<" . $response_tag . ">" );
			$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$ErrMsg = substr (  $result, $posf , $posl - $posf   ) ;

			$response_tag="HostRefNum";
			$posf = strpos (  $result, "<" . $response_tag . ">" );
			$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$HostRefNum = substr (  $result, $posf , $posl - $posf   ) ;

			$response_tag="TransId";
			$posf = strpos (  $result, "<" . $response_tag . ">" );
			$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$TransId = substr (  $result, $posf , $posl - $posf   ) ;	
		   
			$response_tag="HOSTMSG";
			$posf = strpos (  $result, "<" . $response_tag . ">" );
			$posl = strpos (  $result, "</" . $response_tag . ">" ) ;
			$posf = $posf+ strlen($response_tag) +2 ;
			$HOSTMSG = substr (  $result, $posf , $posl - $posf   ) ;
			
		   if ( $Response == "Approved")
			{
				echo "<font color=\"green\">Your payment is approved.</font>";
			}
			else			
			{
				echo "<font color=\"red\">Your payment is not approved.</font>";
			}
			
            $query = "UPDATE testpayment SET status='".$mdStatus."', res='".$Response."' WHERE id=".$id;
            $result = mysqli_query($conn, $query);
		}
	}
	else
	{
		echo "<font color=\"red\">3D Authentication is not successful. Payment request not sent.</font>";
	}	
	
			
	 ?>
			</span>
		</td>
	</tr>	 
	<tr>
	 <tr> 
	<td><b>Parameter Name:</b></td> 
	<td><b>Parameter Value:</b></td> 
	</tr> 
	<tr> 
	<td>AuthCode</td> 
	<td><?php echo $AuthCode; ?></td> 
	</tr> 
	<tr> 
	<td>Response</td> 
	<td><?php echo $Response; ?></td> 
	</tr> 
	<tr> 
	<td>HostRefNum</td> 
	<td><?php echo $HostRefNum;?></td> 
	</tr> 
	<tr> 
	<td>ProcReturnCode</td> 
	<td><?php echo $ProcReturnCode; ?></td> 
	</tr> 
	<tr> 
	<td>TransId</td> 
	<td><?php echo $TransId; ?></td> 
	</tr> 
	<tr> 
	<td>ErrMsg</td> 
	<td><?php echo $ErrMsg; ?></td> 
	</tr> 
	<tr> 
	<td>HostMSG</td> 
	<td><?php echo $HOSTMSG;?></td> 
	</tr> 
	</table>
</body>
</html>