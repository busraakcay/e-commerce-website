<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$YoneticiSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM yoneticiler WHERE id = ? AND kullaniciAdi != ? AND kaliciAdmin = ? LIMIT 1");
		$YoneticiSilmeSorgusu->execute([$GelenID, $YoneticiKullaniciAdi, 0]);
		$YoneticiSilmeKontrol	=	$YoneticiSilmeSorgusu->rowCount();

		if($YoneticiSilmeKontrol>0){
			header("Location:index.php?skd=0&ski=69");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=70");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=70");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
