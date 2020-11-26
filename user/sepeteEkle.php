<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}
	if ($GelenID!="") {
	$UrununStokKontrolSorgu	=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
	$UrununStokKontrolSorgu->execute([$GelenID]);
	$StokSayisi		=	$UrununStokKontrolSorgu->rowCount();
	$StokSayisiKaydi = $UrununStokKontrolSorgu->fetch(PDO::FETCH_ASSOC);
	if($StokSayisi>0){
		$StokSayisiNeKadar = $StokSayisiKaydi["StokSayisi"];

	if($StokSayisiNeKadar>0){
		$KullanicininSepetKontrolSorgu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC LIMIT 1");
		$KullanicininSepetKontrolSorgu->execute([$KullaniciID]);
		$KullanicininSepetSayisi		=	$KullanicininSepetKontrolSorgu->rowCount();

		if($KullanicininSepetSayisi>0){
			$UrunSepetKontrolSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? AND UrunId = ? LIMIT 1");
			$UrunSepetKontrolSorgusu->execute([$KullaniciID, $GelenID]);
			$UrunSepetSayisi			=	$UrunSepetKontrolSorgusu->rowCount();
			$UrunSepetKaydi				=	$UrunSepetKontrolSorgusu->fetch(PDO::FETCH_ASSOC);

			if($UrunSepetSayisi>0){
				$UrununIDsi						=	$UrunSepetKaydi["id"];
				$UrununSepettekiMevcutAdedi		=	$UrunSepetKaydi["UrunAdedi"];
				$UrununYeniAdedi				=	$UrununSepettekiMevcutAdedi+1;

				$UrunGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE sepet SET UrunAdedi = ? WHERE id = ? AND UyeId = ? AND UrunId = ? LIMIT 1");
				$UrunGuncellemeSorgusu->execute([$UrununYeniAdedi, $UrununIDsi, $KullaniciID, $GelenID]);
				$UrunGuncellemeSayisi		=	$UrunGuncellemeSorgusu->rowCount();

					if($UrunGuncellemeSayisi>0){
						header("Location:index.php?sk=93");
						exit();
					}else{
						header("Location:index.php?sk=91");
						exit();
					}
			}else{
				$UrunEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO sepet (UyeId, UrunId, UrunAdedi) values (?, ?, ?)");
				$UrunEklemeSorgusu->execute([$KullaniciID, $GelenID, 1]);
				$UrunEklemeSayisi		=	$UrunEklemeSorgusu->rowCount();
				$SonIdDegeri			=	$db_baglantisi->lastInsertId();

					if($UrunEklemeSayisi>0){
						$SiparisNumarasiniGuncelleSorgusu		=	$db_baglantisi->prepare("UPDATE sepet SET SepetNumarasi = ? WHERE UyeId = ?");
						$SiparisNumarasiniGuncelleSorgusu->execute([$SonIdDegeri, $KullaniciID]);
						$SiparisNumarasiniGuncelleSayisi		=	$SiparisNumarasiniGuncelleSorgusu->rowCount();
							if($SiparisNumarasiniGuncelleSayisi>0){
								header("Location:index.php?sk=93");
								exit();
							}else{
								header("Location:index.php?sk=91");
								exit();
							}
					}else{
						header("Location:index.php?sk=91");
						exit();
					}
			}
		}else{
			$UrunEklemeSorgusu		=	$db_baglantisi->prepare("INSERT INTO sepet (UyeId, UrunId, UrunAdedi) values (?, ?, ?)");
			$UrunEklemeSorgusu->execute([$KullaniciID, $GelenID, 1]);
			$UrunEklemeSayisi		=	$UrunEklemeSorgusu->rowCount();
			$SonIdDegeri			=	$db_baglantisi->lastInsertId();

				if($UrunEklemeSayisi>0){
					$SiparisNumarasiniGuncelleSorgusu		=	$db_baglantisi->prepare("UPDATE sepet SET SepetNumarasi = ? WHERE UyeId = ?");
					$SiparisNumarasiniGuncelleSorgusu->execute([$SonIdDegeri, $KullaniciID]);
					$SiparisNumarasiniGuncelleSayisi		=	$SiparisNumarasiniGuncelleSorgusu->rowCount();
						if($SiparisNumarasiniGuncelleSayisi>0){
							header("Location:index.php?sk=93");
							exit();
						}else{
							header("Location:index.php?sk=91");
							exit();
						}
				}else{
					header("Location:index.php?sk=91");
					exit();
				}
		}
	}else{
		header("Location:index.php?sk=94");
		exit();
	}
}else{
	header("Location:index.php?sk=94");
	exit();
}
}else {
	header("Location:index.php");
	exit();
}
}else{
	header("Location:index.php?sk=92");
	exit();
}
?>
