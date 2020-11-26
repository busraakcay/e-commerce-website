<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}

	if($GelenID!=""){
		$AdresSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM adresler WHERE id = ? LIMIT 1");
		$AdresSilmeSorgusu->execute([$GelenID]);
		$AdresSilmeSayisi		=	$AdresSilmeSorgusu->rowCount();

		if($AdresSilmeSayisi>0){
			header("Location:index.php?sk=65");
			exit();
		}else{
			header("Location:index.php?sk=66");
			exit();
		}
	}else{
		header("Location:index.php?sk=66");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
