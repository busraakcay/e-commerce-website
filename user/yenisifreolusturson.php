<?php
if(isset($_POST["TelefonNumarasi"])){
	$GelenTelefonNumarasi		=	filtrele($_POST["TelefonNumarasi"]);
}else{
	$GelenTelefonNumarasi	=	"";
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

$MD5liSifre					=	md5($GelenSifre);

if(($GelenTelefonNumarasi!="")and ($GelenSifre!="") and ($GelenSifreTekrar!="")){
	if($GelenSifre!=$GelenSifreTekrar){
		header("Location:index.php?sk=43");
		exit();
	}else{
		$UyeGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE uyeler SET Sifre = ? WHERE TelefonNumarasi = ? LIMIT 1");
		$UyeGuncellemeSorgusu->execute([$MD5liSifre, $GelenTelefonNumarasi]);
		$Kontrol				=	$UyeGuncellemeSorgusu->rowCount();

		if($Kontrol>0){
			header("Location:index.php?sk=41");
			exit();
		}else{
			header("Location:index.php?sk=42");
			exit();
		}
	}
}else{
	header("Location:index.php?sk=44");
	exit();
}
?>
