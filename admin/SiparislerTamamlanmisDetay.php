<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["SiparisNo"])){
		$GelenSiparisNo		=	filtrele($_GET["SiparisNo"]);
	}else{
		$GelenSiparisNo		=	"";
	}
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="130">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="540" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Sipariş Detay</h3></td>
		<td width="220" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=97" style="color: #262626; text-decoration: none;">Tamamlanan Siparişlere Dön&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$SiparislerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi = ?");
	$SiparislerSorgusu->execute([$GelenSiparisNo]);
	$SiparislerSayisi		=	$SiparislerSorgusu->rowCount();
	$SiparislerKayitlari	=	$SiparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($SiparislerSayisi>0){
		$DonguSayisi	=	0;

		foreach($SiparislerKayitlari as $SiparisBilgileri){
			if($SiparisBilgileri["UrunTuru"] == "Kolye"){
				$ResimKlasoru	=	"kolyeler";
			}elseif($SiparisBilgileri["UrunTuru"] == "Küpe"){
				$ResimKlasoru	=	"kupeler";
			}elseif($SiparisBilgileri["UrunTuru"] == "Bileklik"){
				$ResimKlasoru	=	"bileklikler";
			}elseif($SiparisBilgileri["UrunTuru"] == "Yüzük"){
				$ResimKlasoru	=	"yuzukler";
			}elseif($SiparisBilgileri["UrunTuru"] == "Saat"){
				$ResimKlasoru	=	"saatler";
			}elseif($SiparisBilgileri["UrunTuru"] == "Gözlük"){
				$ResimKlasoru	=	"gozlukler";
			}
			?>
			<tr>
				<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<?php
					if($DonguSayisi==0){
					?>
					<tr>
						<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100"><b>Adı Soyadı</b></td>
								<td width="10"><b>:</b></td>
								<td width="540"><?php echo geriDondur($SiparisBilgileri["AdresAdiSoyadi"]); ?></td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100"><b>Telefon</b></td>
								<td width="10"><b>:</b></td>
								<td width="540"><?php echo geriDondur($SiparisBilgileri["AdresTelefon"]); ?></td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100"><b>Adres</b></td>
								<td width="10"><b>:</b></td>
								<td width="540"><?php echo geriDondur($SiparisBilgileri["AdresDetay"]); ?></td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td colspan="3"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="100"><b>Gönderi Kodu</b></td>
								<td width="10"><b>:</b></td>
								<td width="540"><?php echo geriDondur($SiparisBilgileri["KargoGonderiKodu"]); ?></td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td width="60" valign="top"><img src="../urunler/<?php echo $ResimKlasoru; ?>/<?php echo geriDondur($SiparisBilgileri["UrunResmi"]); ?>" border="0" width="60" height="80"></td>
						<td width="10">&nbsp;</td>
						<td width="680" valign="top"><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr height="25">
								<td width="680"><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="70"><b>Ürün Adı</b></td>
										<td width="10"><b>:</b></td>
										<td width="600" align="left"><?php echo geriDondur($SiparisBilgileri["UrunAdi"]); ?></td>
									</tr>
								</table></td>
							</tr>
							<tr height="25">
								<td width="680"><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="50"><b>Fiyat</b></td>
										<td width="10"><b>:</b></td>
										<td width="138"><?php echo fiyatYaz(geriDondur($SiparisBilgileri["UrunFiyati"])); ?> TL</td>
										<td width="50"><b>Adet</b></td>
										<td width="10"><b>:</b></td>
										<td width="50"><?php echo geriDondur($SiparisBilgileri["UrunAdedi"]); ?></td>
										<td width="115"><b>Toplam Fiyat</b></td>
										<td width="10"><b>:</b></td>
										<td width="125"><?php echo fiyatYaz(geriDondur($SiparisBilgileri["ToplamUrunFiyati"])); ?> TL</td>
										<td width="85"><b>KDV Oranı</b></td>
										<td width="10"><b>:</b></td>
										<td width="27">%<?php echo geriDondur($SiparisBilgileri["KdvOrani"]); ?></td>
									</tr>
								</table></td>
							</tr>
							<tr height="25">
								<td width="680"><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="50"><b>Ödeme</b></td>
										<td width="10"><b>:</b></td>
										<td width="135"><?php echo geriDondur($SiparisBilgileri["OdemeSecimi"]); ?></td>
										<td width="50"><b>Taksit</b></td>
										<td width="10"><b>:</b></td>
										<td width="50"><?php echo geriDondur($SiparisBilgileri["TaksitSecimi"]); ?></td>
										<td width="65"><b>Kargo</b></td>
										<td width="10"><b>:</b></td>
										<td width="125"><?php echo geriDondur($SiparisBilgileri["KargoFirmasiSecimi"]); ?></td>
										<td width="105"><b>Kargo Ücreti</b></td>
										<td width="10"><b>:</b></td>
										<td width="65"><?php echo fiyatYaz(geriDondur($SiparisBilgileri["KargoUcreti"])); ?> TL</td>
									</tr>
								</table></td>
							</tr>
						</table></td>
					</tr>
				</table></td>
			</tr>
	<?php
			$DonguSayisi++;
		}
	?>
	<?php
	}else{
		header("Location:index.php?skd=0&ski=0");
		exit();
	}
	?>
</table>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
