<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_POST["Soru"])){
		$GelenSoru		=	filtrele($_POST["Soru"]);
	}else{
		$GelenSoru		=	"";
	}
	if(isset($_POST["Cevap"])){
		$GelenCevap		=	filtrele($_POST["Cevap"]);
	}else{
		$GelenCevap		=	"";
	}

	if(($GelenSoru!="") and ($GelenCevap!="")){
		$sssEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO sorular (soru, cevap) values (?, ?)");
		$sssEklemeSorgusu->execute([$GelenSoru, $GelenCevap]);
		$sssEklemeKontrol		=	$sssEklemeSorgusu->rowCount();

		if($sssEklemeKontrol>0){
			header("Location:index.php?skd=0&ski=36");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=37");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=37");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
