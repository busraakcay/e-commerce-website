<?php
if(isset($_SESSION["Kullanici"])){
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

	$MD5liSifre					=	md5($GelenSifre);

	if(($GelenEmailAdresi!="") and ($GelenSifre!="") and ($GelenSifreTekrar!="") and ($GelenIsimSoyisim!="") and ($GelenTelefonNumarasi!="") and ($GelenCinsiyet!="")){
		if($GelenSifre!=$GelenSifreTekrar){
			header("Location:index.php?sk=53");
			exit();
		}else{
			if($GelenSifre == "EskiSifre"){
				$SifreDegistirmeDurumu			=	0;
			}else{
				$SifreDegistirmeDurumu			=	1;
			}

			if($EmailAdresi != $GelenEmailAdresi){
				$KontrolSorgusu		=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ?");
				$KontrolSorgusu->execute([$GelenEmailAdresi]);
				$KullaniciSayisi	=	$KontrolSorgusu->rowCount();

				if($KullaniciSayisi>0){
					header("Location:index.php?sk=51");
					exit();
				}
			}

			if($SifreDegistirmeDurumu == 1){
				$KullaniciGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE uyeler SET EmailAdresi = ?, Sifre = ?, IsimSoyisim = ?, TelefonNumarasi = ?, Cinsiyet = ? WHERE id = ? LIMIT 1");
				$KullaniciGuncellemeSorgusu->execute([$GelenEmailAdresi, $MD5liSifre, $GelenIsimSoyisim, $GelenTelefonNumarasi, $GelenCinsiyet, $KullaniciID]);
			}else{
				$KullaniciGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE uyeler SET EmailAdresi = ?, IsimSoyisim = ?, TelefonNumarasi = ?, Cinsiyet = ? WHERE id = ? LIMIT 1");
				$KullaniciGuncellemeSorgusu->execute([$GelenEmailAdresi, $GelenIsimSoyisim, $GelenTelefonNumarasi, $GelenCinsiyet, $KullaniciID]);
			}

			$KayitKontrol		=	$KullaniciGuncellemeSorgusu->rowCount();

			if($KayitKontrol>0){
				$_SESSION["Kullanici"]	=	$GelenEmailAdresi;

				header("Location:index.php?sk=49");
				exit();
			}else{
				header("Location:index.php?sk=50");
				exit();
			}
		}
	}else{
		header("Location:index.php?sk=52");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
