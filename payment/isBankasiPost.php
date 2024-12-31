<?php


require_once("isBankasiConf.php");

class isBankasi extends isBankasiConfClass
{
    
  private $oid;
  private $rand;
  private  $taksit="";
  
  private  $holder="";
  private  $pan="";
  private  $cv2="";
  private  $Ecom_Payment_Card_ExpDate_Month="";
  private  $Ecom_Payment_Card_ExpDate_Year="";
  private  $cardType="";
  private  $encoding="";



  /* fatura bilgileri */
  public $musteriTel;
  public $musteriMail;
  public $faturaAdi;

  /* Fiyat Bilgileri */
  public  $tutar=1;
  public  $paraBirimiKodu = 840;


  function isBankasiOdemeYap(){
    $servername = "localhost";
    $username = "antalyatr_db";
    $password = "!}7vm{xFw^Q.";
    $dbname = "antalyatr_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $_POST["pan"] = str_replace(' ', '', $_POST["pan"]);
    $this->encoding = $_POST["encoding"];
    $this->holder = $_POST["holder"];
    $this->pan = $_POST["pan"];
    $this->cv2 = $_POST["cv2"];
    $this->Ecom_Payment_Card_ExpDate_Month = $_POST["Ecom_Payment_Card_ExpDate_Month"];
    $this->Ecom_Payment_Card_ExpDate_Year = $_POST["Ecom_Payment_Card_ExpDate_Year"];
    $this->cardType = $_POST["cardType"];
    
    
    //$pan = $_POST["pan"];
    //$name = $_POST["holder"];
    $date = $this->Ecom_Payment_Card_ExpDate_Month."/".$this->Ecom_Payment_Card_ExpDate_Year;
    $amount = $_POST["amount"];
    $this->tutar = $amount;
    
    $currency = $_POST["currency"];
    $this->paraBirimiKodu = $currency;

    $query = "INSERT INTO testpayment (name,pan,date,cv2,amount,currency)
    VALUES ('".$this->holder."', '".$this->pan."', '".$this->Ecom_Payment_Card_ExpDate_Month.$this->Ecom_Payment_Card_ExpDate_Year."','".$this->cv2."', '".$this->tutar."', '".$this->paraBirimiKodu."')";

    

    $result = mysqli_query($conn, $query);
    if($result == false){
        var_dump("Sorry We have Error To Send Data");exit();
    }
    
    $id = $conn->insert_id;
    $conn->close();
    $url = self::returnURL;
    $url = $url."?id=".$id;
    $this->oid = microtime().rand(1000,100000);
    $this->rand = microtime().rand(100,5000);


    //HASH HESAPLAMA
    $hashstr = self::clientid . $this->oid . $this->tutar . $url . $url .self::islemTipi. $this->taksit .$this->rand .self::storekey;
    
    $hashCode = base64_encode(pack('H*',sha1($hashstr)));
    
    $sendData = array(
      "clientid"=>self::clientid ,
      "storetype"=>self::storetype,
      "storekey"=>self::storekey,
      "hash"=>$hashCode,
      "islemtipi"=>self::islemTipi,
      "amount"=>$this->tutar,
      "oid"=>$this->oid,
      "currency"=>$this->paraBirimiKodu,
      "okUrl"=>$url,
      "failUrl"=> $url,
      "lang"=>"en",
      "rnd"=>$this->rand,
      "taksit"=>$this->taksit,
      
      "encoding"=>$this->encoding,
      "pan"=>$this->pan,
      "cv2"=>$this->cv2,
      "Ecom_Payment_Card_ExpDate_Month"=>$this->Ecom_Payment_Card_ExpDate_Month,
      "Ecom_Payment_Card_ExpDate_Year"=>$this->Ecom_Payment_Card_ExpDate_Year,
      "cardType"=>$this->cardType,


      "tel"=>$this->musteriTel,
      "Email"=>$this->musteriMail,
      "firmaadi"=>self::firmaAdi,
      "Faturafirma"=>$this->faturaAdi,
      "Fadres"=>self::firmaAdresi,
      "Fadres2"=>self::firmaAdresi,
      "Filce"=>self::firmaIlce,
      "Fil"=>self::firmaSehir,
      "Fpostakodu"=>self::firmaPostaKodu,
      "Fulkekodu"=>self::ulkeKodu
    );

    //post edip urlyi izliyoruz.

    $postdata = http_build_query($sendData);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true); //POST Metodu kullanarak verileri gönder
    curl_setopt($ch, CURLOPT_HEADER, false); //Serverdan gelen Header bilgilerini önemseme.
    curl_setopt($ch, CURLOPT_URL, self::postURL); //Bağlanacağı URL
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); //POST verilerinin querystring hali. Gönderime hazır!
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Transfer sonuçlarını return et. Onları kullanacağım!
    curl_setopt($ch, CURLOPT_TIMEOUT, 20); //20 saniyede işini bitiremezsen timeout ol.
    //curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;

  }



}

$isBank = new isBankasi;
echo $isBank->isBankasiOdemeYap();



 ?>

