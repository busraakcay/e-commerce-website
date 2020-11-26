<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID	=	filtrele($_GET["ID"]);
	}else{
		$GelenID	=	"";
	}

	if($GelenID!=""){
		$BildirimSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM iletisim WHERE id = ? LIMIT 1");
		$BildirimSilmeSorgusu->execute([$GelenID]);
		$SilmeKontrol			=	$BildirimSilmeSorgusu->rowCount();

		if($SilmeKontrol>0){
			header("Location:index.php?skd=0&ski=111");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=112");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=112");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
