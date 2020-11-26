<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$UyeSilmeSorgusu	=	$db_baglantisi->prepare("UPDATE uyeler SET SilinmeDurumu = ? WHERE id = ? LIMIT 1");
		$UyeSilmeSorgusu->execute([1, $GelenID]);
		$UyeSilmeKontrol	=	$UyeSilmeSorgusu->rowCount();

		if($UyeSilmeKontrol>0){
			$SepetSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM sepet WHERE UyeId = ?");
			$SepetSilmeSorgusu->execute([$GelenID]);

			$YorumlarSorgusu	=	$db_baglantisi->prepare("SELECT * FROM yorumlar WHERE UyeId = ?");
			$YorumlarSorgusu->execute([$GelenID]);
			$YorumlarSayisi		=	$YorumlarSorgusu->rowCount();
			$YorumlarKayitlari	=	$YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

			if($YorumlarSayisi>0){
				foreach($YorumlarKayitlari as $YorumSatirlari){
					$YorumId							=	$YorumSatirlari["id"];
					$GuncellenecekUrununIdsi			=	$YorumSatirlari["UrunId"];
					$GuncellenecekUrununDusulecekPuani	=	$YorumSatirlari["Puan"];

					$UrunGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET YorumSayisi=YorumSayisi-1, ToplamYorumPuani=ToplamYorumPuani-? WHERE id = ? LIMIT 1");
					$UrunGuncellemeSorgusu->execute([$GuncellenecekUrununDusulecekPuani, $GuncellenecekUrununIdsi]);
					$UrunGuncellemeKontrol	=	$UrunGuncellemeSorgusu->rowCount();

					if($UrunGuncellemeKontrol<1){
						header("Location:index.php?skd=0&ski=75");
						exit();
					}

					$YorumSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM yorumlar WHERE id = ? LIMIT 1");
					$YorumSilmeSorgusu->execute([$YorumId]);
					$YorumSilmeKontrol		=	$YorumSilmeSorgusu->rowCount();

					if($YorumSilmeKontrol<1){
						header("Location:index.php?skd=0&ski=75");
						exit();
					}
				}
			}
			header("Location:index.php?skd=0&ski=74");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=75");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=75");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
