<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_POST["SiteAdi"])){
		$GelenSiteAdi				=	filtrele($_POST["SiteAdi"]);
	}else{
		$GelenSiteAdi				=	"";
	}
	if(isset($_POST["SiteTitle"])){
		$GelenSiteTitle				=	filtrele($_POST["SiteTitle"]);
	}else{
		$GelenSiteTitle				=	"";
	}
	if(isset($_POST["SiteDescription"])){
		$GelenSiteDescription		=	filtrele($_POST["SiteDescription"]);
	}else{
		$GelenSiteDescription		=	"";
	}
	if(isset($_POST["SiteKeywords"])){
		$GelenSiteKeywords			=	filtrele($_POST["SiteKeywords"]);
	}else{
		$GelenSiteKeywords			=	"";
	}
	if(isset($_POST["siteCR"])){
		$GelenSiteCR	=	filtrele($_POST["siteCR"]);
	}else{
		$GelenSiteCR	=	"";
	}
	if(isset($_POST["SiteLinki"])){
		$GelenSiteLinki				=	filtrele($_POST["SiteLinki"]);
	}else{
		$GelenSiteLinki				=	"";
	}
	if(isset($_POST["SiteEmailAdresi"])){
		$GelenSiteEmailAdresi		=	filtrele($_POST["SiteEmailAdresi"]);
	}else{
		$GelenSiteEmailAdresi		=	"";
	}
	if(isset($_POST["SiteEmailSifresi"])){
		$GelenSiteEmailSifresi		=	filtrele($_POST["SiteEmailSifresi"]);
	}else{
		$GelenSiteEmailSifresi		=	"";
	}
	if(isset($_POST["SiteEmailHostAdresi"])){
		$GelenSiteEmailHostAdresi	=	filtrele($_POST["SiteEmailHostAdresi"]);
	}else{
		$GelenSiteEmailHostAdresi	=	"";
	}
	if(isset($_POST["facebook"])){
		$Facebook	=	filtrele($_POST["facebook"]);
	}else{
		$Facebook	=	"";
	}
	if(isset($_POST["twitter"])){
		$Twitter		=	filtrele($_POST["twitter"]);
	}else{
		$Twitter		=	"";
	}
	if(isset($_POST["instagram"])){
		$Instagram	=	filtrele($_POST["instagram"]);
	}else{
		$Instagram	=	"";
	}
	if(isset($_POST["ucretsizKargo"])){
		$GelenUcretsizKargo	=	filtrele($_POST["ucretsizKargo"]);
	}else{
		$GelenUcretsizKargo	=	"";
	}
	$GelenSiteLogosu				=	$_FILES["SiteLogosu"];

	if(($GelenSiteAdi!="") and ($GelenSiteTitle!="") and ($GelenSiteDescription!="") and ($GelenSiteKeywords!="") and ($GelenSiteCR!="") and ($GelenSiteLinki!="") and ($GelenSiteEmailAdresi!="") and ($GelenSiteEmailSifresi!="") and ($GelenSiteEmailHostAdresi!="") and ($Facebook!="") and ($Twitter!="") and ($Instagram!="") and ($GelenUcretsizKargo!="")){
		$AyarlariGuncelle			=	$db_baglantisi->prepare("UPDATE ayarlar SET site_adi = ?, site_baslik = ?, site_aciklama = ?, site_keywords = ?, site_copyright = ?, siteLinki = ?, site_emailAdresi = ?, site_emailSifresi = ?, siteHostu = ?, facebook = ?, twitter = ?, instagram = ?, ucretsizKargo = ?");
		$AyarlariGuncelle->execute([$GelenSiteAdi, $GelenSiteTitle, $GelenSiteDescription, $GelenSiteKeywords, $GelenSiteCR, $GelenSiteLinki, $GelenSiteEmailAdresi, $GelenSiteEmailSifresi, $GelenSiteEmailHostAdresi, $Facebook, $Twitter, $Instagram, $GelenUcretsizKargo]);

		header("Location:index.php?skd=0&ski=3");
		exit();
	}else {
		header("Location:index.php?skd=0&ski=4");
		exit();

		if(($GelenSiteLogosu["name"]!="") and ($GelenSiteLogosu["type"]!="") and ($GelenSiteLogosu["tmp_name"]!="") and ($GelenSiteLogosu["error"]==0) and ($GelenSiteLogosu["size"]>0)){

			$ResimIcinDosyaAdi		=	$GelenSiteLogosu["name"];
			$ResimGuncelle = $db_baglantisi->prepare("UPDATE ayarlar SET site_logo = ?");
			$ResimGuncelle->execute([$ResimIcinDosyaAdi]);
				header("Location:index.php?skd=0&ski=3");
				exit();
		}else{
			header("Location:index.php?skd=0&ski=4");
			exit();
		}
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
