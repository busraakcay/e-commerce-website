<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_POST["IsimSoyisim"])){
		$GelenIsimSoyisim		=	filtrele($_POST["IsimSoyisim"]);
	}else{
		$GelenIsimSoyisim		=	"";
	}
	if(isset($_POST["Adres"])){
		$GelenAdres				=	filtrele($_POST["Adres"]);
	}else{
		$GelenAdres				=	"";
	}
	if(isset($_POST["Sehir"])){
		$GelenSehir				=	filtrele($_POST["Sehir"]);
	}else{
		$GelenSehir				=	"";
	}
	if(isset($_POST["Ilce"])){
		$GelenIlce				=	filtrele($_POST["Ilce"]);
	}else{
		$GelenIlce				=	"";
	}
	if(isset($_POST["TelefonNumarasi"])){
		$GelenTelefonNumarasi	=	filtrele($_POST["TelefonNumarasi"]);
	}else{
		$GelenTelefonNumarasi	=	"";
	}

	if(($GelenIsimSoyisim!="") and ($GelenAdres!="") and ($GelenIlce!="") and ($GelenSehir!="") and ($GelenTelefonNumarasi!="")){
		$AdresEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO adresler (uyeId, adiSoyadi, adres, Sehir, Ilce, telefon) values (?, ?, ?, ?, ?, ?)");
		$AdresEklemeSorgusu->execute([$KullaniciID, $GelenIsimSoyisim, $GelenAdres, $GelenSehir, $GelenIlce, $GelenTelefonNumarasi]);
		$EklemeKontrol			=	$AdresEklemeSorgusu->rowCount();

		if($EklemeKontrol>0){
			header("Location:index.php?sk=69");
			exit();
		}else{
			header("Location:index.php?sk=70");
			exit();
		}
	}else{
		header("Location:index.php?sk=71");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
