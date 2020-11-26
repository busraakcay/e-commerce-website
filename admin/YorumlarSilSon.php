<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$YorumlarSorgusu	=	$db_baglantisi->prepare("SELECT * FROM yorumlar WHERE id = ? LIMIT 1");
		$YorumlarSorgusu->execute([$GelenID]);
		$YorumlarSayisi		=	$YorumlarSorgusu->rowCount();
		$YorumlarKaydi		=	$YorumlarSorgusu->fetch(PDO::FETCH_ASSOC);

		if($YorumlarSayisi>0){
			$GuncellenecekUrununIdsi			=	$YorumlarKaydi["UrunId"];
			$GuncellenecekUrununDusulecekPuani	=	$YorumlarKaydi["Puan"];

			$YorumSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM yorumlar WHERE id = ? LIMIT 1");
			$YorumSilmeSorgusu->execute([$GelenID]);
			$YorumSilmeKontrol		=	$YorumSilmeSorgusu->rowCount();

			if($YorumSilmeKontrol>0){
				$UrunGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET YorumSayisi=YorumSayisi-1, ToplamYorumPuani=ToplamYorumPuani-? WHERE id = ? LIMIT 1");
				$UrunGuncellemeSorgusu->execute([$GuncellenecekUrununDusulecekPuani, $GuncellenecekUrununIdsi]);
				$UrunGuncellemeKontrol	=	$UrunGuncellemeSorgusu->rowCount();

				if($UrunGuncellemeKontrol>0){
					header("Location:index.php?skd=0&ski=81");
					exit();
				}else{
					header("Location:index.php?skd=0&ski=82");
					exit();
				}
			}else{
				header("Location:index.php?skd=0&ski=82");
				exit();
			}
		}else{
			header("Location:index.php?skd=0&ski=82");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=82");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
