<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}
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

	if(($GelenID!="") and ($GelenSoru!="") and ($GelenCevap!="")){
		$sssGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE sorular SET soru = ?, cevap = ? WHERE id = ? LIMIT 1");
		$sssGuncellemeSorgusu->execute([$GelenSoru, $GelenCevap, $GelenID]);
		$sssGuncellemeKontrol	=	$sssGuncellemeSorgusu->rowCount();

		if($sssGuncellemeKontrol>0){
			header("Location:index.php?skd=0&ski=40");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=41");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=41s");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
