<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["SiparisNo"])){
		$GelenSiparisNo		=	filtrele($_GET["SiparisNo"]);
	}else{
		$GelenSiparisNo		=	"";
	}

	if($GelenSiparisNo!=""){
		$SiparislerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi = ?");
		$SiparislerSorgusu->execute([$GelenSiparisNo]);
		$SiparisKayitlari		=	$SiparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);
		$SiparisKontrol			=	$SiparislerSorgusu->rowCount();

		if($SiparisKontrol>0){
			foreach($SiparisKayitlari as $Satirlar){
				$SiparistekiId				=	$Satirlar["id"];
				$SiparistekiUrununIDsi		=	$Satirlar["UrunId"];
				$SiparistekiUrununAdedi		=	$Satirlar["UrunAdedi"];

				$SiparisSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM siparisler WHERE id = ? LIMIT 1");
				$SiparisSilmeSorgusu->execute([$SiparistekiId]);
				$SilmeKontrol			=	$SiparisSilmeSorgusu->rowCount();

				if($SilmeKontrol>0){
					$UrunGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi+?, StokSayisi=StokSayisi+? WHERE id = ? LIMIT 1");
					$UrunGuncellemeSorgusu->execute([$SiparistekiUrununAdedi, $SiparistekiUrununAdedi, $SiparistekiUrununIDsi,]);
					$UrunGuncellemeKontrol	=	$UrunGuncellemeSorgusu->rowCount();

				}else{
					header("Location:index.php?skd=0&ski=104");
					exit();
				}
			}

			header("Location:index.php?skd=0&ski=103");
			exit();
		}else{
			header("Location:index.php?skd=0&ski=104");
			exit();
		}
	}else{
		header("Location:index.php?skd=0&ski=104");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
