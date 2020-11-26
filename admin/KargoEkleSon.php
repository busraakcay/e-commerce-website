<?php
if(isset($_SESSION["Yonetici"])){
	$GelenKargoFirmasiLogosu			=	$_FILES["KargoFirmasiLogosu"];
	if(isset($_POST["KargoFirmasiAdi"])){
		$GelenKargoFirmasiAdi			=	filtrele($_POST["KargoFirmasiAdi"]);
	}else{
		$GelenKargoFirmasiAdi			=	"";
	}

	if(($GelenKargoFirmasiLogosu["name"]!="") and ($GelenKargoFirmasiLogosu["type"]!="") and ($GelenKargoFirmasiLogosu["tmp_name"]!="") and ($GelenKargoFirmasiLogosu["error"]==0) and ($GelenKargoFirmasiLogosu["size"]>0) and ($GelenKargoFirmasiAdi!="")){


				$GelenResminUzantisi	=	$GelenKargoFirmasiLogosu["name"];


		$KargoEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO kargofirmalari (KargoFirmasiLogosu, KargoFirmasiAdi) values (?, ?)");
		$KargoEklemeSorgusu->execute([$GelenResminUzantisi, $GelenKargoFirmasiAdi]);
		$KargoEklemeKontrol		=	$KargoEklemeSorgusu->rowCount();

		if($KargoEklemeKontrol>0){
						header("Location:index.php?skd=0&ski=24");
						exit();
					}else{
						header("Location:index.php?skd=0&ski=25");
						exit();
					}
	}else{
		header("Location:index.php?skd=0&ski=25");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
