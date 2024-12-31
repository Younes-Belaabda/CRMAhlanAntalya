<?php

class isBankasiConfClass
{
  /* Satıcı bilgileri */
  public const clientid        = "700677004046";// //iş bankası tarafından verilen clientid.
  public const storekey        = "Ahlan2006"; //storekey değeriniz Ahlan2006
  public const islemTipi       = "Auth"; //işlem tipi
  public const returnURL       = "https://ahlanantalya.com.tr/payment/pay.php"; //dönüş urlsi
  public const storetype       = "3d";
  public const postURL         = "https://sanalpos.isbank.com.tr/fim/est3Dgate";
 // https://sanalpos.isbank.com.tr/fim/est3Dgate
//   sanalpos
//   spos

  /* Adres Faturalandırma İçin */
  public const firmaAdresi     = "t"; //firma adresi
  public const firmaSehir      = ""; //firma şehir
  public const firmaPostaKodu  = ""; //firma posta kodu
  public const ulkeKodu        = "90"; //ülkenin kodu, 90 = TR
  public const firmaTelefon    = ""; //firma telefon numarası
  public const firmaAdi        = ""; //firma adı
  public const firmaIlce        = ""; //firma İlçe
}





 ?>

