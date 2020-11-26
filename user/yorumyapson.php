<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["UrunID"])){
		$GelenUrunID	=	filtrele($_GET["UrunID"]);
	}else{
		$GelenUrunID	=	"";
	}
	if(isset($_POST["Puan"])){
		$GelenPuan		=	filtrele($_POST["Puan"]);
	}else{
		$GelenPuan		=	"";
	}
	if(isset($_POST["Yorum"])){
		$GelenYorum		=	filtrele($_POST["Yorum"]);
	}else{
		$GelenYorum		=	"";
	}

	if(($GelenUrunID!="") and ($GelenPuan!="") and ($GelenYorum!="")){
		$YorumKayitSorgusu		=	$db_baglantisi->prepare("INSERT INTO yorumlar (UrunId, UyeId, Puan, YorumMetni, YorumTarihi, YorumIpAdresi) values (?, ?, ?, ?, ?, ?)");
		$YorumKayitSorgusu->execute([$GelenUrunID, $KullaniciID, $GelenPuan, $GelenYorum, $TS, $IP]);
		$YorumKayitKontrol		=	$YorumKayitSorgusu->rowCount();

		if($YorumKayitKontrol>0){
			$UrunGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE urunler SET YorumSayisi=YorumSayisi+1, ToplamYorumPuani=ToplamYorumPuani+? WHERE id = ? LIMIT 1");
			$UrunGuncellemeSorgusu->execute([$GelenPuan, $GelenUrunID]);
			$UrunGuncellemeKontrol		=	$UrunGuncellemeSorgusu->rowCount();

			if($UrunGuncellemeKontrol>0){
				header("Location:index.php?sk=74");
				exit();
			}else{
				header("Location:index.php?sk=75");
				exit();
			}
		}else{
			header("Location:index.php?sk=75");
			exit();
		}
	}else{
		header("Location:index.php?sk=76");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
