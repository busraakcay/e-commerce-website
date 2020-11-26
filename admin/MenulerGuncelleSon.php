<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}
	if(isset($_POST["MenuAdi"])){
		$GelenMenuAdi	=	filtrele($_POST["MenuAdi"]);
	}else{
		$GelenMenuAdi	=	"";
	}
  if(isset($_POST["UrunAdedi"])){
    $GelenUrunAdedi	=	filtrele($_POST["UrunAdedi"]);
  }else{
    $GelenUrunAdedi	=	"";
  }

	if(($GelenID!="") and ($GelenMenuAdi!="")){
		$MenuGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE menuler SET MenuAdi = ?, UrunSayisi = ? WHERE id = ? LIMIT 1");
		$MenuGuncellemeSorgusu->execute([$GelenMenuAdi, $GelenUrunAdedi, $GelenID]);
		$MenuGuncellemeKontrol	=	$MenuGuncellemeSorgusu->rowCount();

		if($MenuGuncellemeKontrol>0){
			header("Location:index.php?skd=0&ski=52");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=53");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=53");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
