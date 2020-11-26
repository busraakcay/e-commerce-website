<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$HavaleBildirimleriSorgusu	=	$db_baglantisi->prepare("SELECT * FROM havalebildirimleri WHERE bankaID = ?");
		$HavaleBildirimleriSorgusu->execute([$GelenID]);
		$BildirimSayisi				=	$HavaleBildirimleriSorgusu->rowCount();

		if($BildirimSayisi>0){
			header("Location:index.php?skd=0&ski=20");
			exit();
		}else{
			$HesapSorgusu	=	$db_baglantisi->prepare("SELECT * FROM bankahesaplari WHERE id = ?");
			$HesapSorgusu->execute([$GelenID]);
			$HesapSayisi	=	$HesapSorgusu->rowCount();
			$HesapKaydi		=	$HesapSorgusu->fetch(PDO::FETCH_ASSOC);

			$HesapSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM bankahesaplari WHERE id = ? LIMIT 1");
			$HesapSilmeSorgusu->execute([$GelenID]);
			$HesapSilmeKontrol	=	$HesapSilmeSorgusu->rowCount();

			if($HesapSilmeKontrol>0){
				header("Location:index.php?skd=0&ski=19");
				exit();
			}else{
				header("Location:index.php?skd=0&ski=20");
				exit();
			}
		}
	}else{
		header("Location:index.php?skd=0&ski=20");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
