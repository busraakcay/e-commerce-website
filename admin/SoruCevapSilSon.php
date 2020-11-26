<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$sssSilmeSorgusu		=	$db_baglantisi->prepare("DELETE FROM sorular WHERE id = ? LIMIT 1");
		$sssSilmeSorgusu->execute([$GelenID]);
		$sssSilmeKontrol		=	$sssSilmeSorgusu->rowCount();

		if($sssSilmeKontrol>0){
			header("Location:index.php?skd=0&ski=43");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=44");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=44");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
