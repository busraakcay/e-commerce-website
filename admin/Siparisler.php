<?php
if(isset($_SESSION["Yonetici"])){
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="130">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="550" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Bekleyen Siparişler</h3></td>
		<td width="210" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=97" style="color: #262626; text-decoration: none;">Tamamlanan Siparişlere Git&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$SiparisNumaralariSorgusu		=	$db_baglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE OnayDurumu = ? AND KargoDurumu = ? ORDER BY id ASC");
	$SiparisNumaralariSorgusu->execute([0, 0]);
	$SiparisNumaralariSayisi		=	$SiparisNumaralariSorgusu->rowCount();
	$SiparisNumaralariKayitlari		=	$SiparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($SiparisNumaralariSayisi>0){
		foreach($SiparisNumaralariKayitlari as $SiparisNumaralariSatirlar){
			$SiparislerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi = ? AND OnayDurumu = ? AND KargoDurumu = ?");
			$SiparislerSorgusu->execute([$SiparisNumaralariSatirlar["SiparisNumarasi"], 0, 0]);
			$SiparisSayisi		=	$SiparislerSorgusu->rowCount();
			$SiparisKayitlari	=	$SiparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);

			if($SiparisSayisi>0){
				$ToplamFiyat		=	0;
				foreach($SiparisKayitlari as $Siparisler){
					$SiparisTarihi			=	 tarihYaz($Siparisler["SiparisTarihi"]);
					$UrunToplamFiyati		=	$Siparisler["ToplamUrunFiyati"];

					$ToplamFiyat			+=	$UrunToplamFiyati;
				}
			?>
			<tr>
				<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="30">
						<td align="left" width="120"><b>Sipariş Tarihi</b></td>
						<td align="left" width="20"><b>:</b></td>
						<td align="left" width="200"><?php echo $SiparisTarihi; ?></td>
						<td align="left" width="120"><b>Sipariş Tutarı</b></td>
						<td align="left" width="20"><b>:</b></td>
						<td align="left" width="140"><?php echo fiyatYaz($ToplamFiyat); ?> TL</td>
						<td align="left" width="130"><table width="130" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="25"><a href="index.php?skd=0&ski=102&SiparisNo=<?php echo geriDondur($SiparisNumaralariSatirlar["SiparisNumarasi"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 5px;"></a></td>
								<td width="30"><a href="index.php?skd=0&ski=102&SiparisNo=<?php echo geriDondur($SiparisNumaralariSatirlar["SiparisNumarasi"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
								<td width="25"><a href="index.php?skd=0&ski=96&SiparisNo=<?php echo geriDondur($SiparisNumaralariSatirlar["SiparisNumarasi"]); ?>"><img src="../resimler/detay.png" border="0" style="margin-top: 5px;"></a></td>
								<td width="50"><a href="index.php?skd=0&ski=96&SiparisNo=<?php echo geriDondur($SiparisNumaralariSatirlar["SiparisNumarasi"]); ?>" style="color: #646464; text-decoration: none;">Detay</a></td>
							</tr>
						</table></td>
					</tr>
				</table></td>
			</tr>
			<?php

			}else{
				header("Location:index.php?skd=0&ski=0");
				exit();
			}
		}
	}else{
	?>
	<tr>
		<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="750">Kayıtlı yeni sipariş bulunmamaktadır.</td>
			</tr>
		</table></td>
	</tr>
	<?php
	}
	?>
</table>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
