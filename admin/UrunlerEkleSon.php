<?php
if(isset($_SESSION["Yonetici"])){
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

	if(($GelenUrunMenusu!="") and ($GelenUrunAdi!="") and ($GelenUrunFiyati!="") and ($GelenParaBirimi!="") and ($GelenStokAdedi!="") and ($GelenKdvOrani!="") and ($GelenKargoUcreti!="") and ($GelenUrunAciklamasi!="")
  and ($GelenResim["name"]!="") and ($GelenResim["type"]!="") and ($GelenResim["tmp_name"]!="") and ($GelenResim["error"]==0) and ($GelenResim["size"]>0)){
		$MenuTuruSorgusu		=	$db_baglantisi->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
		$MenuTuruSorgusu->execute([$GelenUrunMenusu]);
		$MenuTuruKontrol		=	$MenuTuruSorgusu->rowCount();
		$MenuTuruKaydi			=	$MenuTuruSorgusu->fetch(PDO::FETCH_ASSOC);

		if($MenuTuruKontrol>0){
			$ResimIcinDosyaAdi		=	$GelenResim["name"];

			$UrunEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO urunler (MenuId, UrunTuru, UrunAdi, UrunFiyati, ParaBirimi, KdvOrani, UrunAciklamasi, UrunResmi, StokSayisi, KargoUcreti, Durumu) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$UrunEklemeSorgusu->execute([$GelenUrunMenusu, $MenuTuruKaydi["UrunTuru"], $GelenUrunAdi, $GelenUrunFiyati, $GelenParaBirimi, $GelenKdvOrani, $GelenUrunAciklamasi, $ResimIcinDosyaAdi, $GelenStokAdedi, $GelenKargoUcreti, 1]);
			$UrunEklemeKontrol		=	$UrunEklemeSorgusu->rowCount();

				$MenuUrunSayisiGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE menuler SET UrunSayisi=UrunSayisi+1 WHERE id = ? LIMIT 1");
				$MenuUrunSayisiGuncellemeSorgusu->execute([$GelenUrunMenusu]);
				$MenuUrunSayisiGuncellemeKontrol	=	$MenuUrunSayisiGuncellemeSorgusu->rowCount();

						header("Location:index.php?skd=0&ski=86");
						exit();
		}else{
			header("Location:index.php?skd=0&ski=87");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=87");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
