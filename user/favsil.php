<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}

	if($GelenID!=""){
		$FavoriSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM favoriler WHERE id = ? AND UyeId = ? LIMIT 1");
		$FavoriSilmeSorgusu->execute([$GelenID, $KullaniciID]);
		$FavoriSilmeSayisi		=	$FavoriSilmeSorgusu->rowCount();

		if($FavoriSilmeSayisi>0){
			header("Location:index.php?sk=55");
			exit();
		}else{
			header("Location:index.php?sk=78");
			exit();
		}
	}else{
		header("Location:index.php?sk=78");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
