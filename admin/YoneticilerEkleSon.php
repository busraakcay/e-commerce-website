<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_POST["KullaniciAdi"])){
		$GelenKullaniciAdi			=	filtrele($_POST["KullaniciAdi"]);
	}else{
		$GelenKullaniciAdi			=	"";
	}
	if(isset($_POST["Sifre"])){
		$GelenSifre					=	filtrele($_POST["Sifre"]);
	}else{
		$GelenSifre					=	"";
	}
	if(isset($_POST["IsimSoyisim"])){
		$GelenIsimSoyisim			=	filtrele($_POST["IsimSoyisim"]);
	}else{
		$GelenIsimSoyisim			=	"";
	}
	if(isset($_POST["EmailAdresi"])){
		$GelenEmailAdresi			=	filtrele($_POST["EmailAdresi"]);
	}else{
		$GelenEmailAdresi			=	"";
	}
	if(isset($_POST["TelefonNumarasi"])){
		$GelenTelefonNumarasi		=	filtrele($_POST["TelefonNumarasi"]);
	}else{
		$GelenTelefonNumarasi		=	"";
	}

	$MD5liSifre						=	md5($GelenSifre);

	if(($GelenKullaniciAdi!="") and ($GelenSifre!="") and ($GelenIsimSoyisim!="") and ($GelenEmailAdresi!="") and ($GelenTelefonNumarasi!="")){
		$YoneticiKontrolSorgusu		=	$db_baglantisi->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? OR email = ?");
		$YoneticiKontrolSorgusu->execute([$GelenKullaniciAdi, $GelenEmailAdresi]);
		$Kontrol					=	$YoneticiKontrolSorgusu->rowCount();

		if($Kontrol>0){
			header("Location:index.php?skd=0&ski=63");
			exit();
		}else{
			$YoneticiEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO yoneticiler (kullaniciAdi, sifre, isimSoyisim, email, telefon) values (?, ?, ?, ?, ?)");
			$YoneticiEklemeSorgusu->execute([$GelenKullaniciAdi, $MD5liSifre, $GelenIsimSoyisim, $GelenEmailAdresi, $GelenTelefonNumarasi]);
			$YoneticiEklemeKontrol		=	$YoneticiEklemeSorgusu->rowCount();

			if($YoneticiEklemeKontrol>0){
				header("Location:index.php?skd=0&ski=61");
				exit();
			}else{
				header("Location:index.php?skd=0&ski=62");
				exit();
			}
		}
	}else{
		header("Location:index.php?skd=0&ski=62");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
