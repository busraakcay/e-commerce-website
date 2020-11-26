<?php
if(empty($_SESSION["Yonetici"])){

	if(isset($_POST["YKullanici"])){
		$GelenYKullanici		=	filtrele($_POST["YKullanici"]);
	}else{
		$GelenYKullanici		=	"";
	}
	if(isset($_POST["YSifre"])){
		$GelenYSifre			=	filtrele($_POST["YSifre"]);
	}else{
		$GelenYSifre			=	"";
	}

	$MD5liSifre					=	md5($GelenYSifre);

	if(($GelenYKullanici!="") and ($GelenYSifre!="")){
		$KontrolSorgusu		=	$db_baglantisi->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? AND sifre = ?");
		$KontrolSorgusu->execute([$GelenYKullanici, $MD5liSifre]);
		$KullaniciSayisi	=	$KontrolSorgusu->rowCount();
		$KullaniciKaydi		=	$KontrolSorgusu->fetch(PDO::FETCH_ASSOC);

		if($KullaniciSayisi>0){
			$_SESSION["Yonetici"]	=	$GelenYKullanici;

			header("Location:index.php?skd=0&ski=0");
			exit();
		}else{
			header("Location:index.php?skd=3");
			exit();
		}
	}else{
		header("Location:index.php?skd=1");
		exit();
	}
}else{
	header("Location:index.php?skd=0");
	exit();
}
?>
