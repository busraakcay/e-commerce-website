<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_POST["kartnum"])){
		$Gelenkartnum		=	filtrele($_POST["kartnum"]);
	}else{
		$Gelenkartnum	=	"";
	}
	if(isset($_POST["skt"])){
		$Gelenskt		=	filtrele($_POST["skt"]);
	}else{
		$Gelenskt		=	"";
	}
  if(isset($_POST["yil"])){
		$Gelenyil		=	filtrele($_POST["yil"]);
	}else{
		$Gelenyil		=	"";
	}
  if(isset($_POST["kartturu"])){
		$Gelenkartturu		=	filtrele($_POST["kartturu"]);
	}else{
		$Gelenkartturu		=	"";
	}
  if(isset($_POST["guvenlikkodu"])){
		$Gelenguvenlikkodu		=	filtrele($_POST["guvenlikkodu"]);
	}else{
		$Gelenguvenlikkodu		=	"";
	}

		if($Gelenkartnum!="" AND $Gelenskt!="" AND $Gelenyil!="" AND $Gelenkartturu!="" AND $Gelenguvenlikkodu!=""){
			$SepettekiUrunlerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? LIMIT 1");
			$SepettekiUrunlerSorgusu->execute([$KullaniciID]);
			$SepettekiUrunSayisi		=	$SepettekiUrunlerSorgusu->rowCount();
			$SepettiKayitlar			=	$SepettekiUrunlerSorgusu->fetch(PDO::FETCH_ASSOC);

			$SepettekiSepetNumarasi			=	$SepettiKayitlar["SepetNumarasi"];

			$AlisverisSepetiSorgusu		=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE SepetNumarasi = ?");
			$AlisverisSepetiSorgusu->execute([$SepettekiSepetNumarasi]);
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

            $UrunFiyatiHesapla =	$UrununFiyati;
	          $SepettekiToplamUrunSayisi	+= $SepettekiUrunAdedi;

  					$UrununToplamFiyati			=	($UrunFiyatiHesapla*$SepettekiUrunAdedi);
  					$UrununToplamKargoFiyati	=	($UrununKargoUcreti*$SepettekiUrunAdedi);

            $SiparisEkle	=	$db_baglantisi->prepare("INSERT INTO siparisler (UyeId, SiparisNumarasi, UrunId, UrunTuru, UrunAdi, UrunFiyati, KdvOrani, UrunAdedi, ToplamUrunFiyati, KargoFirmasiSecimi, KargoUcreti, UrunResmi, AdresAdiSoyadi, AdresDetay, AdresTelefon, OdemeSecimi, TaksitSecimi, SiparisTarihi, SiparisIpAdresi) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  					$SiparisEkle->execute([$SepettekiUyeId, $SepetSepetNumarasi, $SepettekiUrunId, $UrununTuru, $UrununAdi, $UrunFiyatiHesapla, $UrununKdvOrani, $SepettekiUrunAdedi, $UrununToplamFiyati, $KargonunAdi, $UrununToplamKargoFiyati, $UrununResmi, $AdresAdiSoyadi, $AdresToparla, $AdresTelefonNumarasi, $SepettekiOdemeSecimi, $SepettekiTaksitSecimi, $TS, $IP]);
  					$EklemeKontrol	=	$SiparisEkle->rowCount();

					if($EklemeKontrol>0){
              $SepettenSilmeSorgusu	=	$db_baglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
              $SepettenSilmeSorgusu->execute([$SepetIdsi, $SepettekiUyeId]);

              $UrunSatisiArttirmaSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi + ? WHERE id = ?");
              $UrunSatisiArttirmaSorgusu->execute([$SepettekiUrunAdedi, $SepettekiUrunId]);

              $StokGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET StokSayisi=StokSayisi - ? WHERE id = ? LIMIT 1");
              $StokGuncellemeSorgusu->execute([$SepettekiUrunAdedi, $SepettekiUrunId]);
				}else {
          header("Location:index.php"); //hataya attir
          exit();
        }
      }
				$KargoFiyatiIcinSiparislerSorgusu	=	$db_baglantisi->prepare("SELECT SUM(ToplamUrunFiyati) AS ToplamUcret FROM siparisler WHERE UyeId = ? AND SiparisNumarasi = ?");
				$KargoFiyatiIcinSiparislerSorgusu->execute([$SepettekiUyeId, $SepetSepetNumarasi]);
				$KargoFiyatiKaydi					=	$KargoFiyatiIcinSiparislerSorgusu->fetch(PDO::FETCH_ASSOC);
					$ToplamUcretimiz	=	$KargoFiyatiKaydi["ToplamUcret"];

					if($ToplamUcretimiz>=$ucretsizKargo){
						$SiparisiGuncelle	=	$db_baglantisi->prepare("UPDATE siparisler SET KargoUcreti = ? WHERE UyeId = ? AND SiparisNumarasi = ?");
						$SiparisiGuncelle->execute([0, $SepettekiUyeId, $SepetSepetNumarasi]);
					}
          header("Location:index.php?sk=105");
  				exit();
      }else{
        header("Location:index.php?sk=106");
      	exit();
      }











}else{
  header("Location:index.php"); //hataya attir
  exit();
}
}else {
  header("Location:index.php");
  exit();
}
?>
