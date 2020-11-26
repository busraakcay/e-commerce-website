<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_POST["Hakkimizda"])){
		$GelenHakkimizda				=	filtrele($_POST["Hakkimizda"]);
	}else{
		$GelenHakkimizda				=	"";
	}
	if(isset($_POST["UyelikSozlesmesi"])){
		$GelenUyelikSozlesmesi			=	filtrele($_POST["UyelikSozlesmesi"]);
	}else{
		$GelenUyelikSozlesmesi			=	"";
	}
	if(isset($_POST["KullanimKosullari"])){
		$GelenKullanimKosullari		=	filtrele($_POST["KullanimKosullari"]);
	}else{
		$GelenKullanimKosullari		=	"";
	}
	if(isset($_POST["GizlilikSozlesmesi"])){
		$GelenGizlilikSozlesmesi		=	filtrele($_POST["GizlilikSozlesmesi"]);
	}else{
		$GelenGizlilikSozlesmesi		=	"";
	}
	if(isset($_POST["MesafeliSatisSozlesmesi"])){
		$GelenMesafeliSatisSozlesmesi	=	filtrele($_POST["MesafeliSatisSozlesmesi"]);
	}else{
		$GelenMesafeliSatisSozlesmesi	=	"";
	}
	if(isset($_POST["Teslimat"])){
		$GelenTeslimat					=	filtrele($_POST["Teslimat"]);
	}else{
		$GelenTeslimat					=	"";
	}
	if(isset($_POST["IptalIadeDegisim"])){
		$GelenIptalIadeDegisim			=	filtrele($_POST["IptalIadeDegisim"]);
	}else{
		$GelenIptalIadeDegisim			=	"";
	}

	if(($GelenHakkimizda!="") and ($GelenUyelikSozlesmesi!="") and ($GelenKullanimKosullari!="") and ($GelenGizlilikSozlesmesi!="") and ($GelenMesafeliSatisSozlesmesi!="") and ($GelenTeslimat!="")){
		$MetinleriGuncelle			=	$db_baglantisi->prepare("UPDATE hakkimizdavesozlesmeler SET hakkimizda = ?, uyelikSozlesmesi = ?, kullanimKosullari = ?, gizlilikSozlesmesi = ?, mesafeliSatisSozlesmesi = ?, teslimat = ?, iptalIadeDegisim = ?");
		$MetinleriGuncelle->execute([$GelenHakkimizda, $GelenUyelikSozlesmesi, $GelenKullanimKosullari, $GelenGizlilikSozlesmesi, $GelenMesafeliSatisSozlesmesi, $GelenTeslimat, $GelenIptalIadeDegisim]);

		header("Location:index.php?skd=0&ski=7");
		exit();
	}else{
		header("Location:index.php?skd=0&ski=8");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
