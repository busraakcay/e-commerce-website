<?php
if(isset($_SESSION["Kullanici"])){

$StokIcinSepettekiUrunlerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
$StokIcinSepettekiUrunlerSorgusu->execute([$KullaniciID]);
$StokIcinSepettekiUrunSayisi		=	$StokIcinSepettekiUrunlerSorgusu->rowCount();
$StokIcinSepettiKayitlar			=	$StokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

if($StokIcinSepettekiUrunSayisi>0){
	foreach($StokIcinSepettiKayitlar as $StokIcinSepettekiSatirlar){
		$StokIcinSepetIdsi						=	$StokIcinSepettekiSatirlar["id"];
		$StokIcinSepettekiUrunIdsi		=	$StokIcinSepettekiSatirlar["UrunId"];
		$StokIcinSepettekiUrununAdedi			=	$StokIcinSepettekiSatirlar["UrunAdedi"];

		$StokIcinUrunBilgileriSorgusu	=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
		$StokIcinUrunBilgileriSorgusu->execute([$StokIcinSepettekiUrunIdsi]);
		$StokKaydi					=	$StokIcinUrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
		$StokIcinUrununStokAdedi	=	$StokKaydi["StokSayisi"];

		if($StokIcinUrununStokAdedi==0){
			$SepetSilSorgusu		=	$db_baglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
			$SepetSilSorgusu->execute([$StokIcinSepetIdsi, $KullaniciID]);
		}elseif($StokIcinSepettekiUrununAdedi>$StokIcinUrununStokAdedi){
			$SepetGuncellemeSorgusu		=	$db_baglantisi->prepare("UPDATE sepet SET UrunAdedi= ? WHERE id = ? AND UyeId = ? LIMIT 1");
			$SepetGuncellemeSorgusu->execute([$StokIcinUrununStokAdedi, $StokIcinSepetIdsi, $KullaniciID]);
		}
	}
}
?>
<form action="index.php?sk=99" method="post">
	<table width=100% align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="1065" valign="top">
				<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td colspan="2" style="color:#ff6666"><h3>Alışveriş Sepeti</h3></td>
					</tr>
					<tr height="30">
						<td colspan="2" valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Adres ve Kargo Seçimini Belirtiniz.</i></td>
					</tr>
					<tr height="10">
						<td colspan="2" style="font-size: 10px;">&nbsp;</td>
					</tr>
					<tr height="40">
						<td align="left" style="background: #ff9999; font-weight: bold; color: black;">&nbsp;Adres Seçimi</td>
						<td align="right" style="background: #ff9999; font-weight: bold; color: black;"><a href="index.php?sk=67" style="color: black; text-decoration: none; font-weight: bold;">+ Yeni Adres Ekle&nbsp;</a></td>
					</tr>
					<?php
					$SepettekiUrunlerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC");
					$SepettekiUrunlerSorgusu->execute([$KullaniciID]);
					$SepettekiUrunSayisi		=	$SepettekiUrunlerSorgusu->rowCount();
					$SepettiKayitlar			=	$SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

					if($SepettekiUrunSayisi>0){
						$SepettekiToplamUrunSayisi			=	0;
						$SepettekiToplamFiyat				=	0;
						$SepettekiToplamKargoFiyati			=	0;
						$SepettekiToplamKargoFiyatiHesapla	=	0;

						foreach($SepettiKayitlar as $SepetSatirlari){
							$SepetIdsi						=	$SepetSatirlari["id"];
							$SepettekiUrununIdsi			=	$SepetSatirlari["UrunId"];
							$SepettekiUrununAdedi			=	$SepetSatirlari["UrunAdedi"];

							$UrunBilgileriSorgusu			=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
							$UrunBilgileriSorgusu->execute([$SepettekiUrununIdsi]);
							$UrunKaydi						=	$UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
								$UrununFiyati			=	$UrunKaydi["UrunFiyati"];
								$UrununParaBirimi		=	$UrunKaydi["ParaBirimi"];
								$UrununKargoUcreti		=	$UrunKaydi["KargoUcreti"];

								$UrunFiyatiHesapla				=	$UrununFiyati;
								$UrunFiyatiBicimlendir			=	fiyatYaz($UrununFiyati);


							$UrunToplamFiyatiHesapla				=	($UrunFiyatiHesapla*$SepettekiUrununAdedi);
							$UrunToplamFiyatiBicimlendir			=	fiyatYaz($UrunToplamFiyatiHesapla);

							$SepettekiToplamUrunSayisi				+=	$SepettekiUrununAdedi;
							$SepettekiToplamFiyat					+=	($UrunFiyatiHesapla*$SepettekiUrununAdedi);

							$SepettekiToplamKargoFiyatiHesapla		+=	($UrununKargoUcreti*$SepettekiUrununAdedi);
							$SepettekiToplamKargoFiyatiBicimlendir	=	fiyatYaz($SepettekiToplamKargoFiyatiHesapla);
						}

						if($SepettekiToplamFiyat>=$ucretsizKargo){
							$SepettekiToplamKargoFiyatiHesapla		=	0;
							$SepettekiToplamKargoFiyatiBicimlendir	=	fiyatYaz($SepettekiToplamKargoFiyatiHesapla);

							$OdenecekToplamTutariBicimlendir		=	fiyatYaz($SepettekiToplamFiyat);
						}else{
							$OdenecekToplamTutariHesapla			=	($SepettekiToplamFiyat+$SepettekiToplamKargoFiyatiHesapla);
							$OdenecekToplamTutariBicimlendir		=	fiyatYaz($OdenecekToplamTutariHesapla);
						}

					$AdreslerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM adresler WHERE UyeId = ? ORDER BY id DESC");
					$AdreslerSorgusu->execute([$KullaniciID]);
					$AdresSayisi		=	$AdreslerSorgusu->rowCount();
					$AdresKayitlari		=	$AdreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);

					if($AdresSayisi>0){
						foreach($AdresKayitlari as $AdresSatirlari){
					?>
					<tr>
						<td colspan="2" align="left">
							<table width=100% align="center" border="0" cellpadding="0" cellspacing="0">
								<tr height="50">
									<td width="25" style="border-bottom: 1px dashed #ff00aa;" align="left"><input type="radio" name="AdresSecimi" checked="checked" value="<?php echo geriDondur($AdresSatirlari["id"]); ?>"></td>
									<td width="775" style="border-bottom: 1px dashed #ff00aa;" align="left"><?php echo geriDondur($AdresSatirlari["adiSoyadi"]); ?> - <?php echo geriDondur($AdresSatirlari["adres"]); ?> <?php echo geriDondur($AdresSatirlari["Sehir"]); ?> / <?php echo geriDondur($AdresSatirlari["Ilce"]); ?> - <?php echo geriDondur($AdresSatirlari["telefon"]); ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<?php
						}
					}else{
					?>
					<tr height="50">
						<td colspan="2" align="left">Sisteme kayıtlı adresiniz bulunmamaktadır. Lütfen öncelikle "Hesabım" alanından "Adres" ekleyiniz. Adres eklemek için lütfen <a href="index.php?sk=67" style="color: #646464; text-decoration: none; font-weight: bold;">buraya tıklayınız</a>.</td>
					</tr>
					<?php
					}
					?>
					<tr height="10">
						<td colspan="2" style="font-size: 10px;">&nbsp;</td>
					</tr>
					<tr height="40">
						<td colspan="2" align="left" style="background: #ff9999; font-weight: bold; color: black;">&nbsp;Kargo Firması Seçimi</td>
					</tr>
					<tr height="10">
						<td colspan="2" style="font-size: 10px;">&nbsp;</td>
					</tr>
					<tr height="40">
						<td colspan="2" align="left"><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr><?php
								$KargolarSorgusu		=	$db_baglantisi->prepare("SELECT * FROM kargofirmalari");
								$KargolarSorgusu->execute();
								$KargoSayisi			=	$KargolarSorgusu->rowCount();
								$KargoKayitlari			=	$KargolarSorgusu->fetchAll(PDO::FETCH_ASSOC);

								$DonguSayisi			=	1;
								$SutunAdetSayisi		=	3;
								$SecimIcinSayi			=	1;

								foreach($KargoKayitlari as $KargoKaydi){
								?>
									<td width="400">
										<table width="400" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr height="40">
												<td align="center"><img src="resimler/<?php echo geriDondur($KargoKaydi["KargoFirmasiLogosu"]); ?>" border="0"></td>
											</tr>
											<tr>
												<td align="center"><input type="radio" name="KargoSecimi" <?php if($SecimIcinSayi==1){ ?>checked="checked" <?php } ?> value="<?php echo geriDondur($KargoKaydi["id"]); ?>"></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
										</table>
									</td>
									<?php
									$SecimIcinSayi++;

									if($DonguSayisi<$SutunAdetSayisi){
									?>
										<td width="10">&nbsp;</td>
									<?php
									}
									?>
								<?php
									$DonguSayisi++;

									if($DonguSayisi>$SutunAdetSayisi){
										echo "</tr><tr>";
										$DonguSayisi	=	1;
									}
								}
								?>
							</tr>
						</table></td>
					</tr>
					<?php
					}else{
						header("Location:index.php?sk=93");
						exit();
					}
					?>
				</table>
			</td>

			<td width="15">&nbsp;</td>

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
					<td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
				</tr>
				<tr height="10">
					<td style="font-size: 10px;">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">Ürünler Toplam Tutarı (KDV Dahil)</td>
				</tr>
				<tr>
					<td align="right" style="font-size: 25px; font-weight: bold;"><?php echo fiyatYaz($SepettekiToplamFiyat); ?> TL</td>
				</tr>
				<tr height="10">
					<td style="font-size: 10px;">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">Kargo Tutarı (KDV Dahil)</td>
				</tr>
				<tr>
					<td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $SepettekiToplamKargoFiyatiBicimlendir; ?> TL</td>
				</tr>
				<tr height="10">
					<td style="font-size: 10px;">&nbsp;</td>
				</tr>
				<tr>
					<td align="right"><input type="submit" value="Devam Et" class="OdemeSecimiButonu"></td>
				</tr>
        <tr>
          <td><img src="resimler/kargoucretsiz.jpg"></td>
        </tr>
			</table></td>
		</tr>
	</table>
</form>
<?php
}else{
	header("Location:index.php");
	exit();
}
?>
