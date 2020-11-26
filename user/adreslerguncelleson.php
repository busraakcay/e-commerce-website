<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}
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

	if(($GelenID!="") and ($GelenIsimSoyisim!="") and ($GelenAdres!="") and ($GelenSehir!="") and ($GelenIlce!="") and ($GelenTelefonNumarasi!="")){
		$AdresGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE adresler SET adiSoyadi = ?, adres = ?, Sehir = ?, Ilce = ?, telefon = ?  WHERE id = ? AND uyeID = ? LIMIT 1");
		$AdresGuncellemeSorgusu->execute([$GelenIsimSoyisim, $GelenAdres, $GelenSehir, $GelenIlce, $GelenTelefonNumarasi, $GelenID, $KullaniciID]);
		$GuncellemeKontrol			=	$AdresGuncellemeSorgusu->rowCount();

		if($GuncellemeKontrol>0){
			header("Location:index.php?sk=61");
			exit();
		}else{
			header("Location:index.php?sk=62");
			exit();
		}
	}else{
		header("Location:index.php?sk=63");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
