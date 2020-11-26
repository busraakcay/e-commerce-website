<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$UrunlerSorgusu			=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ?");
		$UrunlerSorgusu->execute([$GelenID]);
		$UrunlerSorgusuKontrol	=	$UrunlerSorgusu->rowCount();
		$UrunlerSorgusuKaydi	=	$UrunlerSorgusu->fetch(PDO::FETCH_ASSOC);

		if($UrunlerSorgusuKontrol>0){
			$SilinecekUrununMenuIDsi	=	$UrunlerSorgusuKaydi["MenuId"];

			$UrunSilmeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET Durumu = ? WHERE id = ? LIMIT 1");
			$UrunSilmeSorgusu->execute([0, $GelenID]);
			$UrunSilmeKontrol	=	$UrunSilmeSorgusu->rowCount();

			if($UrunSilmeKontrol>0){
				$SepetSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM sepet WHERE UrunId = ?");
				$SepetSilmeSorgusu->execute([$GelenID]);

				$FavorilerSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM favoriler WHERE UrunId = ?");
				$FavorilerSilmeSorgusu->execute([$GelenID]);

				$MenuGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE menuler SET UrunSayisi=UrunSayisi-1 WHERE id = ?");
				$MenuGuncellemeSorgusu->execute([$SilinecekUrununMenuIDsi]);

				header("Location:index.php?skd=0&ski=93");
				exit();
			}else{
				header("Location:index.php?skd=0&ski=94");
				exit();
			}
		}else{
			header("Location:index.php?skd=0&ski=94");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=94");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
