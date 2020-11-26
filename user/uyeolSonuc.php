<?php
if(isset($_POST["EmailAdresi"])){
	$GelenEmailAdresi		=	filtrele($_POST["EmailAdresi"]);
}else{
	$GelenEmailAdresi		=	"";
}
if(isset($_POST["Sifre"])){
	$GelenSifre				=	filtrele($_POST["Sifre"]);
}else{
	$GelenSifre				=	"";
}
if(isset($_POST["SifreTekrar"])){
	$GelenSifreTekrar		=	filtrele($_POST["SifreTekrar"]);
}else{
	$GelenSifreTekrar		=	"";
}
if(isset($_POST["IsimSoyisim"])){
	$GelenIsimSoyisim		=	filtrele($_POST["IsimSoyisim"]);
}else{
	$GelenIsimSoyisim		=	"";
}
if(isset($_POST["TelefonNumarasi"])){
	$GelenTelefonNumarasi	=	filtrele($_POST["TelefonNumarasi"]);
}else{
	$GelenTelefonNumarasi	=	"";
}
if(isset($_POST["Cinsiyet"])){
	$GelenCinsiyet			=	filtrele($_POST["Cinsiyet"]);
}else{
	$GelenCinsiyet			=	"";
}
if(isset($_POST["SozlesmeOnay"])){
	$GelenSozlesmeOnay		=	filtrele($_POST["SozlesmeOnay"]);
}else{
	$GelenSozlesmeOnay		=	"";
}
$MD5liSifre					=	md5($GelenSifre);

if(($GelenEmailAdresi!="") and ($GelenSifre!="") and ($GelenSifreTekrar!="") and ($GelenIsimSoyisim!="") and ($GelenTelefonNumarasi!="") and ($GelenCinsiyet!="")){
	if($GelenSozlesmeOnay==0){
		header("Location:index.php?sk=29");
		exit();
	}else{
		if($GelenSifre!=$GelenSifreTekrar){
			header("Location:index.php?sk=28");
			exit();
		}else{
			$KontrolSorgusu		=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ?");
			$KontrolSorgusu->execute([$GelenEmailAdresi]);
			$KullaniciSayisi	=	$KontrolSorgusu->rowCount();

			if($KullaniciSayisi>0){
				header("Location:index.php?sk=27");
				exit();
			}else{
				$UyeEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO uyeler (EmailAdresi, Sifre, IsimSoyisim, TelefonNumarasi, Cinsiyet, Durumu, KayitTarihi, KayitIpAdresi) values (?, ?, ?, ?, ?, ?, ?, ?)");
				$UyeEklemeSorgusu->execute([$GelenEmailAdresi, $MD5liSifre, $GelenIsimSoyisim, $GelenTelefonNumarasi, $GelenCinsiyet, 1, $TS ,$IP]);

        $KayitKontrol		=	$UyeEklemeSorgusu->rowCount();

				if($KayitKontrol>0){
          header("Location:index.php?sk=24");
          die();
        }else {
          header("Location:index.php?sk=25");
          die();
        }
      }
    }
  }
}else {
  header("Location:index.php?sk=26");
  die();
}

?>
