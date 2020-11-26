<?php
if(isset($_SESSION["Yonetici"])){
	$GelenBankaLogosu			=	$_FILES["BankaLogosu"];
	if(isset($_POST["BankaAdi"])){
		$GelenBankaAdi			=	filtrele($_POST["BankaAdi"]);
	}else{
		$GelenBankaAdi			=	"";
	}
	if(isset($_POST["SubeAdi"])){
		$GelenSubeAdi			=	filtrele($_POST["SubeAdi"]);
	}else{
		$GelenSubeAdi			=	"";
	}
	if(isset($_POST["SubeKodu"])){
		$GelenSubeKodu			=	filtrele($_POST["SubeKodu"]);
	}else{
		$GelenSubeKodu			=	"";
	}
	if(isset($_POST["KonumSehir"])){
		$GelenKonumSehir		=	filtrele($_POST["KonumSehir"]);
	}else{
		$GelenKonumSehir		=	"";
	}
	if(isset($_POST["KonumUlke"])){
		$GelenKonumUlke			=	filtrele($_POST["KonumUlke"]);
	}else{
		$GelenKonumUlke			=	"";
	}
	if(isset($_POST["ParaBirimi"])){
		$GelenParaBirimi		=	filtrele($_POST["ParaBirimi"]);
	}else{
		$GelenParaBirimi		=	"";
	}
	if(isset($_POST["HesapSahibi"])){
		$GelenHesapSahibi		=	filtrele($_POST["HesapSahibi"]);
	}else{
		$GelenHesapSahibi		=	"";
	}
	if(isset($_POST["HesapNumarasi"])){
		$GelenHesapNumarasi		=	filtrele($_POST["HesapNumarasi"]);
	}else{
		$GelenHesapNumarasi		=	"";
	}
	if(isset($_POST["IbanNumarasi"])){
		$GelenIbanNumarasi		=	filtrele($_POST["IbanNumarasi"]);
	}else{
		$GelenIbanNumarasi		=	"";
	}

	if(($GelenBankaLogosu["name"]!="") and ($GelenBankaLogosu["type"]!="") and ($GelenBankaLogosu["tmp_name"]!="") and ($GelenBankaLogosu["error"]==0) and ($GelenBankaLogosu["size"]>0) and ($GelenBankaAdi!="") and ($GelenSubeAdi!="") and ($GelenSubeKodu!="") and ($GelenKonumSehir!="") and ($GelenKonumUlke!="") and ($GelenParaBirimi!="") and ($GelenHesapSahibi!="") and ($GelenHesapNumarasi!="") and ($GelenIbanNumarasi!="")){


		$ResimIcinDosyaAdi		=	$GelenBankaLogosu["name"];

		$HesapEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO bankahesaplari (bankaLogo, bankaAdi, konumSehir, konumUlke, subeAdi, subeKodu, paraBirimi, hesapSahibi, hesapNum, ibanNum) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$HesapEklemeSorgusu->execute([$ResimIcinDosyaAdi, $GelenBankaAdi, $GelenKonumSehir, $GelenKonumUlke, $GelenSubeAdi, $GelenSubeKodu, $GelenParaBirimi, $GelenHesapSahibi, $GelenHesapNumarasi, $GelenIbanNumarasi]);
		$HesapEklemeKontrol		=	$HesapEklemeSorgusu->rowCount();

    if ($HesapEklemeKontrol>0) {
      header("Location:index.php?skd=0&ski=12");
      exit();
    }

	}else{
		header("Location:index.php?skd=0&ski=13");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
