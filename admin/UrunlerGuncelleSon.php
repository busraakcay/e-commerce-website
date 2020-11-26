<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}
	if(isset($_POST["UrunMenusu"])){
		$GelenUrunMenusu			=	filtrele($_POST["UrunMenusu"]);
	}else{
		$GelenUrunMenusu			=	"";
	}
	if(isset($_POST["UrunAdi"])){
		$GelenUrunAdi				=	filtrele($_POST["UrunAdi"]);
	}else{
		$GelenUrunAdi				=	"";
	}
	if(isset($_POST["UrunFiyati"])){
		$GelenUrunFiyati			=	filtrele($_POST["UrunFiyati"]);
	}else{
		$GelenUrunFiyati			=	"";
	}
	if(isset($_POST["ParaBirimi"])){
		$GelenParaBirimi			=	filtrele($_POST["ParaBirimi"]);
	}else{
		$GelenParaBirimi			=	"";
	}
  if(isset($_POST["StokAdedi"])){
    $GelenStokAdedi			=	filtrele($_POST["StokAdedi"]);
  }else{
    $GelenStokAdedi			=	"";
  }
	if(isset($_POST["KdvOrani"])){
		$GelenKdvOrani				=	filtrele($_POST["KdvOrani"]);
	}else{
		$GelenKdvOrani				=	"";
	}
	if(isset($_POST["KargoUcreti"])){
		$GelenKargoUcreti			=	filtrele($_POST["KargoUcreti"]);
	}else{
		$GelenKargoUcreti			=	"";
	}
	if(isset($_POST["UrunAciklamasi"])){
		$GelenUrunAciklamasi		=	filtrele($_POST["UrunAciklamasi"]);
	}else{
		$GelenUrunAciklamasi		=	"";
	}
	$GelenResim					=	$_FILES["Resim"];

	if(($GelenUrunMenusu!="") and ($GelenUrunAdi!="") and ($GelenUrunFiyati!="") and ($GelenParaBirimi!="") and ($GelenStokAdedi!="") and ($GelenKdvOrani!="") and ($GelenKargoUcreti!="") and ($GelenUrunAciklamasi!="")){
		$UrunSorgusu	=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
		$UrunSorgusu->execute([$GelenID]);
		$UrunKontrol	=	$UrunSorgusu->rowCount();
		$UrunBilgisi	=	$UrunSorgusu->fetch(PDO::FETCH_ASSOC);

		if($UrunKontrol>0){
			$MenuTuruSorgusu		=	$db_baglantisi->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
			$MenuTuruSorgusu->execute([$GelenUrunMenusu]);
			$MenuTuruKontrol		=	$MenuTuruSorgusu->rowCount();
			$MenuTuruKaydi			=	$MenuTuruSorgusu->fetch(PDO::FETCH_ASSOC);

			if($MenuTuruKontrol>0){
				$UrunGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE urunler SET MenuId = ?, UrunAdi = ?, UrunFiyati = ?, ParaBirimi = ?, KdvOrani = ?, UrunAciklamasi = ?, StokSayisi = ?, KargoUcreti = ? WHERE id = ? LIMIT 1");
				$UrunGuncellemeSorgusu->execute([$GelenUrunMenusu, $GelenUrunAdi, $GelenUrunFiyati, $GelenParaBirimi, $GelenKdvOrani, $GelenUrunAciklamasi, $GelenStokAdedi, $GelenKargoUcreti, $GelenID]);
				$UrunGuncellemeKontrol		=	$UrunGuncellemeSorgusu->rowCount();

				if(($GelenResim["name"]!="") and ($GelenResim["type"]!="") and ($GelenResim["tmp_name"]!="") and ($GelenResim["error"]==0) and ($GelenResim["size"]>0)){

					$ResimIcinDosyaAdi	=	$GelenResim["name"];

								$BirinciResimGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET UrunResmi = ? WHERE id = ? LIMIT 1");
								$BirinciResimGuncellemeSorgusu->execute([$ResimIcinDosyaAdi, $GelenID]);
								$BirinciResimGuncellemeKontrol	=	$BirinciResimGuncellemeSorgusu->rowCount();

								if($BirinciResimGuncellemeKontrol<1){
									header("Location:index.php?skd=0&ski=91");
									exit();
								}
						}
				}
				header("Location:index.php?skd=0&ski=90");
				exit();
		}else{
			header("Location:index.php?skd=0&ski=91");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=91");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
