<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["SiparisNo"])){
		$GelenSiparisNo		=	filtrele($_GET["SiparisNo"]);
	}else{
		$GelenSiparisNo		=	"";
	}
	if(isset($_POST["GonderiKodu"])){
		$GelenGonderiKodu	=	filtrele($_POST["GonderiKodu"]);
	}else{
		$GelenGonderiKodu	=	"";
	}

	if(($GelenSiparisNo!="") and ($GelenGonderiKodu!="")){
		$SiparisGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE siparisler SET OnayDurumu = ?, KargoDurumu = ?, KargoGonderiKodu = ? WHERE SiparisNumarasi = ?");
		$SiparisGuncellemeSorgusu->execute([1, 1, $GelenGonderiKodu, $GelenSiparisNo]);
		$GuncellemeKontrol			=	$SiparisGuncellemeSorgusu->rowCount();

		if($GuncellemeKontrol>0){
			header("Location:index.php?skd=0&ski=100");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=101");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=101");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
