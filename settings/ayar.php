<?php
try{
	$db_baglantisi = new PDO("mysql:host=localhost;dbname=site;charset=utf8", "root", "");
}catch(PDOException $e){
	die();
}

$ayar_sorgusu = $db_baglantisi->prepare("SELECT * FROM ayarlar LIMIT 1");
$ayar_sorgusu->execute();
$ayar_num = $ayar_sorgusu->rowCount();
$ayar = $ayar_sorgusu->fetch(PDO::FETCH_ASSOC);
if($ayar_num>0){
	$siteAdi = $ayar["site_adi"];
	$siteBasligi = $ayar["site_baslik"];
	$siteAciklama = $ayar["site_aciklama"];
	$siteKword = $ayar["site_keywords"];
	$siteCR = $ayar["site_copyright"];
	$siteLinki = $ayar["siteLinki"];
	$siteLogo = $ayar["site_logo"];
	$siteEmail = $ayar["site_emailAdresi"];
	$siteEmailPswrd = $ayar["site_emailSifresi"];
	$siteHostu = $ayar["siteHostu"];
	$facebook = $ayar["facebook"];
	$instagram = $ayar["instagram"];
	$twitter = $ayar["twitter"];
	$ucretsizKargo = $ayar["ucretsizKargo"];
}else{
	die();
}

$sozHak_sorgusu = $db_baglantisi->prepare("SELECT * FROM hakkimizdavesozlesmeler LIMIT 1");
$sozHak_sorgusu->execute();
$sozHak_num = $sozHak_sorgusu->rowCount();
$sozHak = $sozHak_sorgusu->fetch(PDO::FETCH_ASSOC);
if($sozHak_num>0){
	$hakkimizda = $sozHak["hakkimizda"];
	$uyelikSozlesmesi = $sozHak["uyelikSozlesmesi"];
	$kullanimKosullari = $sozHak["kullanimKosullari"];
	$gizlilikSozlesmesi = $sozHak["gizlilikSozlesmesi"];
	$mesafeliSatisSozlesmesi = $sozHak["mesafeliSatisSozlesmesi"];
	$teslimat = $sozHak["teslimat"];
	$iptalIadeDegisim = $sozHak["iptalIadeDegisim"];
}else{
	die();
}
if(isset($_SESSION["Kullanici"])){
	$KullaniciSorgusu		=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? LIMIT 1");
	$KullaniciSorgusu->execute([$_SESSION["Kullanici"]]);
	$KullaniciSayisi		=	$KullaniciSorgusu->rowCount();
	$Kullanici				=	$KullaniciSorgusu->fetch(PDO::FETCH_ASSOC);

	if($KullaniciSayisi>0){
		$KullaniciID		=	$Kullanici["id"];
		$EmailAdresi		=	$Kullanici["EmailAdresi"];
		$Sifre				=	$Kullanici["Sifre"];
		$IsimSoyisim		=	$Kullanici["IsimSoyisim"];
		$TelefonNumarasi	=	$Kullanici["TelefonNumarasi"];
		$Cinsiyet			=	$Kullanici["Cinsiyet"];
		$Durumu				=	$Kullanici["Durumu"];
		$KayitTarihi		=	$Kullanici["KayitTarihi"];
		$KayitIpAdresi		=	$Kullanici["KayitIpAdresi"];
	}else{
		die();
	}
}

if(isset($_SESSION["Yonetici"])){
	$YoneticiSorgusu		=	$db_baglantisi->prepare("SELECT * FROM yoneticiler WHERE kullaniciAdi = ? LIMIT 1");
	$YoneticiSorgusu->execute([$_SESSION["Yonetici"]]);
	$YoneticiSayisi			=	$YoneticiSorgusu->rowCount();
	$Yonetici				=	$YoneticiSorgusu->fetch(PDO::FETCH_ASSOC);

	if($YoneticiSayisi>0){
		$YoneticiID					=	$Yonetici["id"];
		$YoneticiKullaniciAdi		=	$Yonetici["kullaniciAdi"];
		$YoneticiSifre				=	$Yonetici["sifre"];
		$YoneticiIsimSoyisim		=	$Yonetici["isimSoyisim"];
		$YoneticiEmailAdresi		=	$Yonetici["email"];
		$YoneticiTelefonNumarasi	=	$Yonetici["telefon"];
	}else{
		die();
	}
}
?>
