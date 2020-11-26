<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID			=	filtrele($_GET["ID"]);
	}else{
		$GelenID			=	"";
	}
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

	if(($GelenID!="") and ($GelenBankaAdi!="") and ($GelenSubeAdi!="") and ($GelenSubeKodu!="") and ($GelenKonumSehir!="") and ($GelenKonumUlke!="") and ($GelenParaBirimi!="") and ($GelenHesapSahibi!="") and ($GelenHesapNumarasi!="") and ($GelenIbanNumarasi!="")){

		$HesapGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE bankahesaplari SET bankaAdi = ?, konumSehir = ?, konumUlke = ?, subeAdi = ?, subeKodu = ?, paraBirimi = ?, hesapSahibi = ?, hesapNum = ?, ibanNum = ? WHERE id = ? LIMIT 1");
		$HesapGuncellemeSorgusu->execute([$GelenBankaAdi, $GelenKonumSehir, $GelenKonumUlke, $GelenSubeAdi, $GelenSubeKodu, $GelenParaBirimi, $GelenHesapSahibi, $GelenHesapNumarasi, $GelenIbanNumarasi, $GelenID]);
		$HesapGuncellemeKontrol		=	$HesapGuncellemeSorgusu->rowCount();

		if(($GelenBankaLogosu["name"]!="") and ($GelenBankaLogosu["type"]!="") and ($GelenBankaLogosu["tmp_name"]!="") and ($GelenBankaLogosu["error"]==0) and ($GelenBankaLogosu["size"]>0)){
			$BankaResmiSorgusu		=	$db_baglantisi->prepare("SELECT * FROM bankahesaplari WHERE id = ? LIMIT 1");
			$BankaResmiSorgusu->execute([$GelenID]);
			$ResimKontrol			=	$BankaResmiSorgusu->rowCount();
			$ResimBilgisi			=	$BankaResmiSorgusu->fetch(PDO::FETCH_ASSOC);

			$ResimIcinDosyaAdi		=	$GelenBankaLogosu["name"];

  		$HesapResmiGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE bankahesaplari SET bankaLogo = ? WHERE id = ? LIMIT 1");
    	$HesapResmiGuncellemeSorgusu->execute([$ResimIcinDosyaAdi, $GelenID]);
      $HesapResmiGuncellemeKontrol	=	$HesapResmiGuncellemeSorgusu->rowCount();

    			if($HesapResmiGuncellemeKontrol<1){
    						header("Location:index.php?skd=0&ski=17");
    						exit();
    			}
				}
		if(($HesapGuncellemeKontrol>0) or ($HesapResmiGuncellemeKontrol>0)){
			header("Location:index.php?skd=0&ski=16");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=17");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=17");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
