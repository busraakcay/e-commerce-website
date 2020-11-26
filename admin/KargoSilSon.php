<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$KargoSorgusu	=	$db_baglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ?");
		$KargoSorgusu->execute([$GelenID]);
		$KargoSayisi	=	$KargoSorgusu->rowCount();
		$KargoKaydi		=	$KargoSorgusu->fetch(PDO::FETCH_ASSOC);

		$KargoSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM kargofirmalari WHERE id = ? LIMIT 1");
		$KargoSilmeSorgusu->execute([$GelenID]);
		$KargoSilmeKontrol	=	$KargoSilmeSorgusu->rowCount();

		if($KargoSilmeKontrol>0){
			header("Location:index.php?skd=0&ski=31");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=32");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=32");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
