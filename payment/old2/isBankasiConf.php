<?php

class isBankasiConfClass
{
  /* Satıcı bilgileri */
  public const clientid        = "100300000"; //iş bankası tarafından verilen clientid.
  public const storekey        = "123456"; //storekey değeriniz
  public const islemTipi       = "Auth"; //işlem tipi
  public const returnURL       = "https://ahlanantalya.com.tr/payment/pay.php"; //dönüş urlsi
  public const storetype       = "3d_pay_hosting";
  public const postURL         = "https://entegrasyon.asseco-see.com.tr/fim/est3Dgate";
//   sanalpos
//   spos

  /* Adres Faturalandırma İçin */
  public const firmaAdresi     = ""; //firma adresi
  public const firmaSehir      = ""; //firma şehir
  public const firmaPostaKodu  = ""; //firma posta kodu
  public const ulkeKodu        = "90"; //ülkenin kodu, 90 = TR
  public const firmaTelefon    = ""; //firma telefon numarası
  public const firmaAdi        = ""; //firma adı
  public const firmaIlce        = ""; //firma İlçe
}





 ?>

