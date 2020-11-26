<?php
if(isset($_SESSION["Yonetici"])){
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="120">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Havale Bildirimleri</h3></td>
	</tr>
	<tr height="10">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$BildirimSorgusu		=	$db_baglantisi->prepare("SELECT * FROM havalebildirimleri ORDER BY IslemTarihi ASC");
	$BildirimSorgusu->execute();
	$BildirimSayisi		=	$BildirimSorgusu->rowCount();
	$BildirimKayitlari	=	$BildirimSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($BildirimSayisi>0){
		foreach($BildirimKayitlari as $Bildirimler){
			$BankaSorgusu		=	$db_baglantisi->prepare("SELECT * FROM bankahesaplari WHERE id = ? LIMIT 1");
			$BankaSorgusu->execute([$Bildirimler["bankaID"]]);
			$BankaKayitlari		=	$BankaSorgusu->fetch(PDO::FETCH_ASSOC);
	?>
	<tr>
		<td style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr height="40">
				<td align="left" width="250"><b>Adı Soyadı</b></td>
        <td width="10"><b>:</b></td>
        <td width="700"><?php echo geriDondur($Bildirimler["adiSoyadi"]); ?></td>
				<td align="right" width="350"><?php echo tarihYaz($Bildirimler["islemTarihi"]); ?></td>
			</tr>
      <tr height="30">
        <td width="150"><b>E-Mail</b></td>
        <td width="10"><b>:</b></td>
        <td width="500"><?php echo geriDondur($Bildirimler["email"]); ?></td>
      </tr>
      <tr  height="30">
        <td width="150"><b>Telefon</b></td>
        <td width="10"><b>:</b></td>
        <td width="500"><?php echo geriDondur($Bildirimler["telefon"]); ?></td>
      </tr>
      <tr  height="30">
        <td width="150"><b>Banka Adı</b></td>
        <td width="10"><b>:</b></td>
        <td width="500"><?php echo geriDondur($BankaKayitlari["bankaAdi"]); ?></td>
      </tr>
			<tr  height="30">
				<td align="left" width="160"><b>Açıklama Notu</b></td>
        <td width="10"><b>:</b></td>
        <td width="490"><?php echo geriDondur($Bildirimler["aciklama"]); ?></td>
			</tr>
			<tr height="20">
				<td colspan="4" align="right"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="20">
						<td width="750">&nbsp;</td>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=106&ID=<?php echo geriDondur($Bildirimler["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 2px;"></a></td>
						<td width="25" align="left"><a href="index.php?skd=0&ski=106&ID=<?php echo geriDondur($Bildirimler["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
				<td width="750">Kayıtlı havale bildirimi bulunmamaktadır.</td>
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
