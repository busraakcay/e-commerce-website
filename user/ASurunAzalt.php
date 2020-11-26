<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}

	if($GelenID!=""){
		$SepetGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE sepet SET UrunAdedi=UrunAdedi-1 WHERE id = ? AND UyeId = ? LIMIT 1");
		$SepetGuncellemeSorgusu->execute([$GelenID, $KullaniciID]);
		$SepetGuncellemeSayisi		=	$SepetGuncellemeSorgusu->rowCount();

		if($SepetGuncellemeSayisi>0){
			header("Location:index.php?sk=93");
			exit();
		}else{
			header("Location:index.php?sk=93");
			exit();
		}
	}else{
		header("Location:index.php?sk=93");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
