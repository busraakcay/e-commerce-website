<?php
if(isset($_SESSION["Yonetici"])){
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="70">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Banka Hesap Ayarları</h3></td>
		<td width="200" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=10" style="color: #262626; text-decoration: none;">+ Yeni Banka Hesabı Ekle&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$HesaplarSorgusu		=	$db_baglantisi->prepare("SELECT * FROM bankahesaplari ORDER BY bankaAdi ASC");
	$HesaplarSorgusu->execute();
	$HesaplarSayisi			=	$HesaplarSorgusu->rowCount();
	$HesaplarKayitlari		=	$HesaplarSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($HesaplarSayisi>0){
		foreach($HesaplarKayitlari as $Hesaplar){
	?>
	<tr height="105">
		<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="200"><table width="200" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="75">
						<td><img src="../resimler/<?php echo geriDondur($Hesaplar["bankaLogo"]); ?>" border="0"></td>
					</tr>
					<tr height="30">
						<td align="left"><table width="200" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="25" valign="top"><a href="index.php?skd=0&ski=14&ID=<?php echo geriDondur($Hesaplar["id"]); ?>"><img src="../resimler/guncelle.png" border="0"></a></td>
								<td width="70" valign="top"><a href="index.php?skd=0&ski=14&ID=<?php echo geriDondur($Hesaplar["id"]); ?>" style="color: #646464; text-decoration: none;">Güncelle</a></td>
								<td width="25" valign="top"><a href="index.php?skd=0&ski=18&ID=<?php echo geriDondur($Hesaplar["id"]); ?>"><img src="../resimler/sil.png" border="0"></a></td>
								<td width="80" valign="top"><a href="index.php?skd=0&ski=18&ID=<?php echo geriDondur($Hesaplar["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
							</tr>
						</table></td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="540"><table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="90">
						<td><table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr height="35">
								<td><table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="100"><b>Banka Adı</b></td>
										<td width="20"><b>:</b></td>
										<td width="140"><?php echo geriDondur($Hesaplar["bankaAdi"]); ?></td>
										<td width="115"><b>Hesap Sahibi</b></td>
										<td width="20"><b>:</b></td>
										<td width="145"><?php echo geriDondur($Hesaplar["hesapSahibi"]); ?></td>
									</tr>
								</table></td>
							</tr>
							<tr height="35">
								<td><table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="200"><b>Şube ve Konum Bilgileri</b></td>
										<td width="20"><b>:</b></td>
										<td width="340"><?php echo geriDondur($Hesaplar["subeAdi"]); ?> (<?php echo geriDondur($Hesaplar["subeKodu"]); ?>) - <?php echo geriDondur($Hesaplar["konumSehir"]); ?> / <?php echo geriDondur($Hesaplar["konumUlke"]); ?></td>
									</tr>
								</table></td>
							</tr>
							<tr height="35">
								<td><table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="140"><b>Hesap Bilgileri</b></td>
										<td width="20"><b>:</b></td>
										<td width="380"><?php echo geriDondur($Hesaplar["paraBirimi"]); ?> / <?php echo geriDondur($Hesaplar["hesapNum"]); ?> / <?php echo geriDondur($Hesaplar["ibanNum"]); ?></td>
									</tr>
                  <tr>
                    <td style="font-size:10px;">&nbsp;</td>
                  </tr>
								</table></td>
							</tr>
						</table></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<?php
		}
	}else{
	?>
	<tr>
		<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="750">Kayıtlı banka hesabı bulunmamaktadır.</td>
			</tr>
		</table></td>
	</tr>
	<?php
	}
	?>
</table>
<table>
  <tr height="120">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
</table>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
