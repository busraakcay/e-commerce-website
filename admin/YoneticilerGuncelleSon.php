<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID				=	filtrele($_GET["ID"]);
	}else{
		$GelenID				=	"";
	}
	if(isset($_POST["Sifre"])){
		$GelenSifre				=	filtrele($_POST["Sifre"]);
	}else{
		$GelenSifre				=	"";
	}
	if(isset($_POST["IsimSoyisim"])){
		$GelenIsimSoyisim		=	filtrele($_POST["IsimSoyisim"]);
	}else{
		$GelenIsimSoyisim		=	"";
	}
	if(isset($_POST["EmailAdresi"])){
		$GelenEmailAdresi		=	filtrele($_POST["EmailAdresi"]);
	}else{
		$GelenEmailAdresi		=	"";
	}
	if(isset($_POST["TelefonNumarasi"])){
		$GelenTelefonNumarasi	=	filtrele($_POST["TelefonNumarasi"]);
	}else{
		$GelenTelefonNumarasi	=	"";
	}

	if(($GelenID!="") and ($GelenIsimSoyisim!="") and ($GelenEmailAdresi!="") and ($GelenTelefonNumarasi!="")){
		$YoneticininMevcutSifreSorgusu		=	$db_baglantisi->prepare("SELECT * FROM yoneticiler WHERE id = ? LIMIT 1");
		$YoneticininMevcutSifreSorgusu->execute([$GelenID]);
		$YoneticininMevcutSifreKaydi		=	$YoneticininMevcutSifreSorgusu->fetch(PDO::FETCH_ASSOC);
		$YoneticininMevcutSifreKontrolu		=	$YoneticininMevcutSifreSorgusu->rowCount();

		if($YoneticininMevcutSifreKontrolu>0){
			$YoneticininMevcutSifresi	=	$YoneticininMevcutSifreKaydi["sifre"];

			if($GelenSifre==""){
				$YonetiIcinKaydedilecekSifre	=	$YoneticininMevcutSifresi;
			}else{
				$YonetiIcinKaydedilecekSifre	=	md5($GelenSifre);
			}

			$YoneticiGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE yoneticiler SET isimSoyisim = ?, sifre = ?, email = ?, telefon = ? WHERE id = ? LIMIT 1");
			$YoneticiGuncellemeSorgusu->execute([$GelenIsimSoyisim, $YonetiIcinKaydedilecekSifre, $GelenEmailAdresi, $GelenTelefonNumarasi, $GelenID]);
			$YoneticiGuncellemeKontrol	=	$YoneticiGuncellemeSorgusu->rowCount();

			if($YoneticiGuncellemeKontrol>0){
				header("Location:index.php?skd=0&ski=66");
				exit();
			}else{
				header("Location:index.php?skd=0&ski=67");
				exit();
			}
		}else{
			header("Location:index.php?skd=0&ski=67");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=67");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
