<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_POST["OdemeTuruSecimi"])){
		$GelenOdemeTuruSecimi		=	filtrele($_POST["OdemeTuruSecimi"]);
	}else{
		$GelenOdemeTuruSecimi		=	"";
	}
	if(isset($_POST["TaksitSecimi"])){
		$GelenTaksitSecimi		=	filtrele($_POST["TaksitSecimi"]);
	}else{
		$GelenTaksitSecimi		=	"";
	}

	if($GelenOdemeTuruSecimi!=""){
		if($GelenOdemeTuruSecimi=="Banka Havalesi"){
			$AlisverisSepetiSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
			$AlisverisSepetiSorgusu->execute([$KullaniciID]);
			$SepetSayisi				=	$AlisverisSepetiSorgusu->rowCount();
			$SepetUrunleri				=	$AlisverisSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);

			if($SepetSayisi>0){
				$SepettekiToplamUrunSayisi			=	0;
				foreach($SepetUrunleri as $SepetSatirlari){
					$SepetIdsi					=	$SepetSatirlari["id"];
					$SepetSepetNumarasi			=	$SepetSatirlari["SepetNumarasi"];
					$SepettekiUyeId				=	$SepetSatirlari["UyeId"];
					$SepettekiUrunId			=	$SepetSatirlari["UrunId"];
					$SepettekiAdresId			=	$SepetSatirlari["AdresId"];
					$SepettekiKargoId			=	$SepetSatirlari["KargoId"];
					$SepettekiUrunAdedi			=	$SepetSatirlari["UrunAdedi"];
					$SepettekiOdemeSecimi		=	$SepetSatirlari["OdemeSecimi"];
					$SepettekiTaksitSecimi		=	$SepetSatirlari["TaksitSecimi"];

					$UrunBilgileriSorgusu			=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
					$UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
					$UrunKaydi					=	$UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
						$UrununTuru				=	$UrunKaydi["UrunTuru"];
						$UrununAdi				=	$UrunKaydi["UrunAdi"];
						$UrununFiyati			=	$UrunKaydi["UrunFiyati"];
						$UrununParaBirimi		=	$UrunKaydi["ParaBirimi"];
						$UrununKdvOrani			=	$UrunKaydi["KdvOrani"];
						$UrununKargoUcreti		=	$UrunKaydi["KargoUcreti"];
						$UrununResmi			=	$UrunKaydi["UrunResmi"];
						$UrununStokAdedi 	=	$UrunKaydi["StokSayisi"];

					$KargoBilgileriSorgusu		=	$db_baglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
					$KargoBilgileriSorgusu->execute([$SepettekiKargoId]);
					$KargoKaydi					=	$KargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
						$KargonunAdi			=	$KargoKaydi["KargoFirmasiAdi"];

					$AdresBilgileriSorgusu		=	$db_baglantisi->prepare("SELECT * FROM adresler WHERE id = ? LIMIT 1");
					$AdresBilgileriSorgusu->execute([$SepettekiAdresId]);
					$AdresKaydi					=	$AdresBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
						$AdresAdiSoyadi			=	$AdresKaydi["adiSoyadi"];
						$AdresAdres				=	$AdresKaydi["adres"];
						$AdresSehir				=	$AdresKaydi["Sehir"];
						$AdresIlce				=	$AdresKaydi["Ilce"];
						$AdresToparla			=	$AdresAdres . " " . $AdresSehir . " " . $AdresIlce;
						$AdresTelefonNumarasi	=	$AdresKaydi["telefon"];


					$UrunFiyatiHesapla				=	$UrununFiyati;
					$SepettekiToplamUrunSayisi				+= $SepettekiUrunAdedi;

					$UrununToplamFiyati			=	($UrunFiyatiHesapla*$SepettekiUrunAdedi);
					$UrununToplamKargoFiyati	=	($UrununKargoUcreti*$SepettekiUrunAdedi);

					$SiparisEkle	=	$db_baglantisi->prepare("INSERT INTO siparisler (UyeId, SiparisNumarasi, UrunId, UrunTuru, UrunAdi, UrunFiyati, KdvOrani, UrunAdedi, ToplamUrunFiyati, KargoFirmasiSecimi, KargoUcreti, UrunResmi, AdresAdiSoyadi, AdresDetay, AdresTelefon, OdemeSecimi, TaksitSecimi, SiparisTarihi, SiparisIpAdresi) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
					$SiparisEkle->execute([$SepettekiUyeId, $SepetSepetNumarasi, $SepettekiUrunId, $UrununTuru, $UrununAdi, $UrunFiyatiHesapla, $UrununKdvOrani, $SepettekiUrunAdedi, $UrununToplamFiyati, $KargonunAdi, $UrununToplamKargoFiyati, $UrununResmi, $AdresAdiSoyadi, $AdresToparla, $AdresTelefonNumarasi, $GelenOdemeTuruSecimi, 0, $TS, $IP]);
					$EklemeKontrol	=	$SiparisEkle->rowCount();

					if($EklemeKontrol>0){
						$SepettenSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
						$SepettenSilmeSorgusu->execute([$SepetIdsi, $SepettekiUyeId]);

						$UrunSatisiArttirmaSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi + ? WHERE id = ?");
						$UrunSatisiArttirmaSorgusu->execute([$SepettekiUrunAdedi, $SepettekiUrunId]);

						$StokGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET StokSayisi=StokSayisi - ? WHERE id = ? LIMIT 1");
						$StokGuncellemeSorgusu->execute([$SepettekiUrunAdedi, $SepettekiUrunId]);
					}else{
						header("Location:index.php?sk=102");
						exit();
					}
				}

				$KargoFiyatiIcinSiparislerSorgusu	=	$db_baglantisi->prepare("SELECT SUM(ToplamUrunFiyati) AS ToplamUcret FROM siparisler WHERE UyeId = ? AND SiparisNumarasi = ?");
				$KargoFiyatiIcinSiparislerSorgusu->execute([$KullaniciID, $SepetSepetNumarasi]);
				$KargoFiyatiKaydi					=	$KargoFiyatiIcinSiparislerSorgusu->fetch(PDO::FETCH_ASSOC);
					$ToplamUcretimiz	=	$KargoFiyatiKaydi["ToplamUcret"];

					if($ToplamUcretimiz>=$ucretsizKargo){
						$SiparisiGuncelle	=	$db_baglantisi->prepare("UPDATE siparisler SET KargoUcreti = ? WHERE UyeId = ? AND SiparisNumarasi = ?");
						$SiparisiGuncelle->execute([0, $SepettekiUyeId, $SepetSepetNumarasi]);
					}
				header("Location:index.php?sk=101");
				exit();
			}else{
				header("Location:index.php");
				exit();
			}
		}else{
			if($GelenTaksitSecimi!=""){
				$SepetiGuncelle		=	$db_baglantisi->prepare("UPDATE sepet SET OdemeSecimi = ?, TaksitSecimi = ? WHERE UyeId = ?");
				$SepetiGuncelle->execute([$GelenOdemeTuruSecimi, $GelenTaksitSecimi, $KullaniciID]);
				$SepetKontrol		=	$SepetiGuncelle->rowCount();

				if($SepetKontrol>0){
					header("Location:index.php?sk=103");
					exit();
				}else{
					header("Location:index.php");
					exit();
				}
			}else{
				header("Location:index.php");
				exit();
			}

		}
	}else{
		header("Location:index.php");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
