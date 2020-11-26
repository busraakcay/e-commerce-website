<?php
if(isset($_SESSION["Kullanici"])){

$StokIcinSepettekiUrunlerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
$StokIcinSepettekiUrunlerSorgusu->execute([$KullaniciID]);
$StokIcinSepettekiUrunSayisi		=	$StokIcinSepettekiUrunlerSorgusu->rowCount();
$StokIcinSepettiKayitlar			=	$StokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

if($StokIcinSepettekiUrunSayisi>0){
	foreach($StokIcinSepettiKayitlar as $StokIcinSepettekiSatirlar){
		$StokIcinSepetIdsi						=	$StokIcinSepettekiSatirlar["id"];
		$StokIcinSepettekiUrununIdsi		=	$StokIcinSepettekiSatirlar["UrunId"];
		$StokIcinSepettekiUrununAdedi			=	$StokIcinSepettekiSatirlar["UrunAdedi"];

		$StokIcinUrunBilgileriSorgusu	=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
		$StokIcinUrunBilgileriSorgusu->execute([$StokIcinSepettekiUrununIdsi]);
		$StokIcinUrunKaydi					=	$StokIcinUrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
		$StokIcinUrununStokSayisi	=	$StokIcinUrunKaydi["StokSayisi"];

		if($StokIcinUrununStokSayisi==0){
			$SepetSilSorgusu		=	$db_baglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
			$SepetSilSorgusu->execute([$StokIcinSepetIdsi, $KullaniciID]);
		}elseif($StokIcinSepettekiUrununAdedi>$StokIcinUrununStokSayisi){
			$SepetGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE sepet SET UrunAdedi= ? WHERE id = ? AND UyeId = ? LIMIT 1");
			$SepetGuncellemeSorgusu->execute([$StokIcinUrununStokSayisi, $StokIcinSepetIdsi, $KullaniciID]);
		}
	}
}

$SepetSifirlamaSorgusu		=	$db_baglantisi->prepare("UPDATE sepet SET AdresId= ?, KargoId = ?, OdemeSecimi = ?, TaksitSecimi = ? WHERE UyeId = ?");
$SepetSifirlamaSorgusu->execute([0, 0, "", 0, $KullaniciID]);
?>
<table width=100% align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="1065" valign="top">
			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td style="color:#ff6666"><h3>Alışveriş Sepeti</h3></td>
				</tr>
				<tr height="30">
					<td valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Alışveriş Sepetine Eklemiş Olduğunuz Tüm Ürünler Aşağıdadır.</i></td>
				</tr>
				<?php
				$SepettekiUrunlerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC");
				$SepettekiUrunlerSorgusu->execute([$KullaniciID]);
				$SepettekiUrunSayisi		=	$SepettekiUrunlerSorgusu->rowCount();
				$SepettiKayitlar			=	$SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

				if($SepettekiUrunSayisi>0){
					$SepettekiToplamUrunSayisi		=	0;
					$SepettekiToplamFiyat			=	0;

					foreach($SepettiKayitlar as $SepetSatirlari){
						$SepetIdsi						=	$SepetSatirlari["id"];
						$SepettekiUrununIdsi			=	$SepetSatirlari["UrunId"];
						$SepettekiUrununAdedi			=	$SepetSatirlari["UrunAdedi"];

						$UrunBilgileriSorgusu			=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
						$UrunBilgileriSorgusu->execute([$SepettekiUrununIdsi]);
						$UrunKaydi						=	$UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
							$UrununTuru				=	$UrunKaydi["UrunTuru"];
							$UrununResmi			=	$UrunKaydi["UrunResmi"];
							$UrununAdi				=	$UrunKaydi["UrunAdi"];
							$UrununFiyati			=	$UrunKaydi["UrunFiyati"];
							$UrununParaBirimi		=	$UrunKaydi["ParaBirimi"];

						$UrunSorgusu	=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
						$UrunSorgusu->execute([$SepettekiUrununIdsi]);
						$Kayit				=	$UrunSorgusu->fetch(PDO::FETCH_ASSOC);

							$UrununStokAdedi		=	$Kayit["StokSayisi"];

            if($UrununTuru == "Kolye"){
              $UrunResimleriKlasoru	=	"kolyeler";
            }elseif($UrununTuru == "Küpe"){
              $UrunResimleriKlasoru	=	"kupeler";
            }elseif($UrununTuru == "Bileklik"){
              $UrunResimleriKlasoru	=	"bileklikler";
            }elseif($UrununTuru == "Yüzük"){
              $UrunResimleriKlasoru	=	"yuzukler";
            }elseif($UrununTuru == "Saat"){
              $UrunResimleriKlasoru	=	"saatler";
            }elseif($UrununTuru == "Gözlük"){
              $UrunResimleriKlasoru	=	"gozlukler";
            }

							$UrunFiyatiHesapla				=	$UrununFiyati;
							$UrunFiyatiBicimlendir			=	fiyatYaz($UrununFiyati);

						$UrunToplamFiyatiHesapla		=	($UrunFiyatiHesapla*$SepettekiUrununAdedi);
						$UrunToplamFiyatiBicimlendir	=	fiyatYaz($UrunToplamFiyatiHesapla);

						$SepettekiToplamUrunSayisi		+=	$SepettekiUrununAdedi;
						$SepettekiToplamFiyat			+=	($UrunFiyatiHesapla*$SepettekiUrununAdedi);
				?>

				<tr height="100">
					<td valign="bottom" align="left"><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="80" style="border-bottom: 1px dashed #ff00aa;" align="left"><img src="urunler/<?php echo $UrunResimleriKlasoru; ?>/<?php echo geriDondur($UrununResmi); ?>" border="0" width="60" height="80"></td>
							<td width="120" style="border-bottom: 1px dashed #ff00aa;" align="left"><a href="index.php?sk=95&ID=<?php echo geriDondur($SepetIdsi); ?>"><img src="resimler/sil.png" border="0" title="Sil"></a></td>
							<td width="90" style="border-bottom: 1px dashed #ff00aa;" align="left"><table width="90" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="30" align="center"><?php if($SepettekiUrununAdedi>1){ ?><a href="index.php?sk=96&ID=<?php echo geriDondur($SepetIdsi); ?>" style="text-decoration: none; color: #646464;">
										<img src="resimler/azalt.png" border="0" style="margin-top: 5px;"></a><?php }else{?><img src="resimler/azalt.png" border="0" style="margin-top: 5px;"> <?php }?></td>
									<td width="30" align="center" style="line-height: 20px;"><?php echo geriDondur($SepettekiUrununAdedi); ?></td>
									<td width="30" align="center"><a href="index.php?sk=97&ID=<?php echo geriDondur($SepetIdsi); ?>"><img src="resimler/arttir.png" border="0" style="margin-top: 5px;"></a></td>
								</tr>
							</table></td>
							<td width="100" style="border-bottom: 1px dashed #ff00aa;" align="right"><?php echo $UrunFiyatiBicimlendir; ?> TL<br /><?php echo $UrunToplamFiyatiBicimlendir; ?> TL</td>
						</tr>
					</table></td>
				</tr>
				<?php
					}
				}else{
					$SepettekiToplamUrunSayisi	=	0;
					$SepettekiToplamFiyat		=	0;
				?>
				<tr height="30">
					<td valign="bottom" align="left">Alışveriş sepetinizde ürün bulunmamaktadır.</td>
				</tr>
				<?php
				}
				?>
			</table>
		</td>
		<td width="250" valign="top"><table width="250" align="left" border="0" cellpadding="0" cellspacing="0">
			<tr height="40">
				<td  style="color:#ff6666" align="right"><h3>Sipariş Özeti</h3></td>
			</tr>
			<tr height="30">
				<td valign="top" style="border-bottom: 1px dashed #ff00aa;" align="right">Toplam <b style="color: #800080; font-size: 18px;"><?php echo $SepettekiToplamUrunSayisi; ?></b> Adet Ürün</td>
			</tr>
			<tr height="5">
				<td height="5" style="font-size: 5px;">&nbsp;</td>
			</tr>
			<tr>
				<td align="right">Ödenecek Tutar (KDV Dahil)</td>
			</tr>
			<tr>
				<td align="right" style="font-size: 25px; font-weight: bold;"><?php echo fiyatYaz($SepettekiToplamFiyat); ?> TL</td>
			</tr>
			<tr height="10">
				<td style="font-size: 10px;">&nbsp;</td>
			</tr>
			<tr>
				<td align="right"><div class="SepetDevamEtButonu"><a href="index.php?sk=98"><div>Devam Et</div></a></div></td>
			</tr>
		</table></td>
	</tr>
</table>
<?php
}else{
	header("Location:index.php");
	exit();
}
?>
