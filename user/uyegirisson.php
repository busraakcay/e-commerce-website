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

$MD5liSifre					=	md5($GelenSifre);

if(($GelenEmailAdresi!="") and ($GelenSifre!="")){
	$KontrolSorgusu		=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? AND Sifre = ? AND SilinmeDurumu = ?");
	$KontrolSorgusu->execute([$GelenEmailAdresi, $MD5liSifre, 0]);
	$KullaniciSayisi	=	$KontrolSorgusu->rowCount();
	$KullaniciKaydi		=	$KontrolSorgusu->fetch(PDO::FETCH_ASSOC);

	if($KullaniciSayisi>0){
		if($KullaniciKaydi["Durumu"]==1){
			$_SESSION["Kullanici"]	=	$GelenEmailAdresi;

			if($_SESSION["Kullanici"]==$GelenEmailAdresi){
				header("Location:index.php");
				exit();
			}else{
        header("Location:index.php?sk=32");
        exit();
      }
  }else{
    header("Location:index.php?sk=32");
    exit();
  }
}else {  header("Location:index.php?sk=33");
  exit();
}
}else {
  header("Location:index.php?sk=34");
  exit();
}
?>
