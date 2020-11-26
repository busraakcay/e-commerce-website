<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID					=	filtrele($_GET["ID"]);
	}else{
		$GelenID					=	"";
	}
	$GelenKargoFirmasiLogosu		=	$_FILES["KargoFirmasiLogosu"];
	if(isset($_POST["KargoFirmasiAdi"])){
		$GelenKargoFirmasiAdi		=	filtrele($_POST["KargoFirmasiAdi"]);
	}else{
		$GelenKargoFirmasiAdi		=	"";
	}

	if(($GelenID!="") and ($GelenKargoFirmasiAdi!="")){
		$KargoGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE kargofirmalari SET KargoFirmasiAdi = ? WHERE id = ? LIMIT 1");
		$KargoGuncellemeSorgusu->execute([$GelenKargoFirmasiAdi, $GelenID]);
		$KargoGuncellemeKontrol		=	$KargoGuncellemeSorgusu->rowCount();

  }

		if(($GelenKargoFirmasiLogosu["name"]!="") and ($GelenKargoFirmasiLogosu["type"]!="") and ($GelenKargoFirmasiLogosu["tmp_name"]!="") and ($GelenKargoFirmasiLogosu["error"]==0) and ($GelenKargoFirmasiLogosu["size"]>0)){
			$KargoResmiSorgusu		=	$db_baglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
			$KargoResmiSorgusu->execute([$GelenID]);
			$ResimKontrol			=	$KargoResmiSorgusu->rowCount();
			$ResimBilgisi			=	$KargoResmiSorgusu->fetch(PDO::FETCH_ASSOC);


			$ResimIcinDosyaAdi		=	$GelenKargoFirmasiLogosu["name"];

						$KargoResmiGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE kargofirmalari SET KargoFirmasiLogosu = ? WHERE id = ? LIMIT 1");
						$KargoResmiGuncellemeSorgusu->execute([$ResimIcinDosyaAdi, $GelenID]);
						$KargoResmiGuncellemeKontrol	=	$KargoResmiGuncellemeSorgusu->rowCount();
        }
		if(($KargoGuncellemeKontrol>0) or ($KargoResmiGuncellemeKontrol>0)){
			header("Location:index.php?skd=0&ski=28");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=29");
			exit();
		}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
