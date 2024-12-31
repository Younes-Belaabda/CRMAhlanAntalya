<?php


require_once("isBankasiConf.php");

class isBankasi extends isBankasiConfClass
{
    
  private $oid;
  private $rand;
  private  $taksit="";


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

    $name = $_POST["pan"];
    $phone = $_POST["holder"];
    $amount = $_POST["amount"];
    $this->tutar = $amount;

    $query = "INSERT INTO testpayment (cname,phone,amount)
    VALUES ('".$name."', '".$phone."', '".$amount."')";


    $result = mysqli_query($conn, $query);
    $id = $conn->insert_id;
    $conn->close();
    $url = self::returnURL;
    $url = $url."?id=".$id;
    
    $this->oid = microtime().rand(1000,100000);
    $this->rand = microtime().rand(100,5000);


    //HASH HESAPLAMA
    $hashstr = self::clientid . $this->oid . $this->tutar . $url . $url .self::islemTipi. $this->taksit .$this->rand .self::storekey;
    //var_dump($hashstr);exit();
    $hashCode = base64_encode(pack('H*',sha1($hashstr)));
    //var_dump($hashCode);exit();
    //verileri array halinde topluyoruz.
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
      "lang"=>"tr",
      "rnd"=>$this->rand,

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
    // curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
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

