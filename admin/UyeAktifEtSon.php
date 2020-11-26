<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$UyeGeriAcSorgusu	=	$db_baglantisi->prepare("UPDATE uyeler SET SilinmeDurumu = ? WHERE id = ? LIMIT 1");
		$UyeGeriAcSorgusu->execute([0, $GelenID]);
		$Kontrol			=	$UyeGeriAcSorgusu->rowCount();

		if($Kontrol>0){
			header("Location:index.php?skd=0&ski=77");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=78");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=78");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
