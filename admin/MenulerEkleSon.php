<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_POST["UrunTuru"])){
		$GelenUrunTuru		=	filtrele($_POST["UrunTuru"]);
	}else{
		$GelenUrunTuru		=	"";
	}
	if(isset($_POST["MenuAdi"])){
		$GelenMenuAdi		=	filtrele($_POST["MenuAdi"]);
	}else{
		$GelenMenuAdi		=	"";
	}
  if(isset($_POST["UrunAdedi"])){
    $GelenUrunAdedi		=	filtrele($_POST["UrunAdedi"]);
  }else{
    $GelenUrunAdedi	=	"";
  }

	if(($GelenUrunTuru!="") and ($GelenMenuAdi!="")){
		$MenuEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO menuler (UrunTuru, MenuAdi, UrunSayisi) values (?, ?, ?)");
		$MenuEklemeSorgusu->execute([$GelenUrunTuru, $GelenMenuAdi, $GelenUrunAdedi]);
		$MenuEklemeKontrol		=	$MenuEklemeSorgusu->rowCount();

		if($MenuEklemeKontrol>0){
			header("Location:index.php?skd=0&ski=48");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=49");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=49");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
