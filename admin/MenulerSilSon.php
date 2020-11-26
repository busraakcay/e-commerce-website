<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$MenuSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM menuler WHERE id = ? LIMIT 1");
		$MenuSilmeSorgusu->execute([$GelenID]);
		$MenuSilmeKontrol		=	$MenuSilmeSorgusu->rowCount();

		if($MenuSilmeKontrol>0){
			$UrunlerSorgusu			=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE MenuId = ?");
			$UrunlerSorgusu->execute([$GelenID]);
			$UrunlerSorgusuKontrol	=	$UrunlerSorgusu->rowCount();
			$UrunlerKayitlari		=	$UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

			if($UrunlerSorgusuKontrol>0){
				foreach($UrunlerKayitlari as $UrunKaydi){
					$SilinecekUrununIDsi	=	$UrunKaydi["id"];

					$UrunlerGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET Durumu = ? WHERE id = ? AND MenuId = ?");
					$UrunlerGuncellemeSorgusu->execute([0, $SilinecekUrununIDsi, $GelenID]);

					$SepetSilmeSorgusu			=	$db_baglantisi->prepare("DELETE FROM sepet WHERE UrunId = ?");
					$SepetSilmeSorgusu->execute([$SilinecekUrununIDsi]);

					$FavorilerSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM favoriler WHERE UrunId = ?");
					$FavorilerSilmeSorgusu->execute([$SilinecekUrununIDsi]);
				}
			}

			header("Location:index.php?skd=0&ski=55");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=56");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=56");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
