<?php
if(isset($_SESSION["Yonetici"])){
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="160">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Sıkça Sorulan Sorular</h3></td>
		<td width="200" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=34" style="color: #262626; text-decoration: none;">+ Yeni SSS Ekle&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$sssSorgusu		=	$db_baglantisi->prepare("SELECT * FROM sorular ORDER BY soru ASC");
	$sssSorgusu->execute();
	$sssSayisi		=	$sssSorgusu->rowCount();
	$sssKayitlari	=	$sssSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($sssSayisi>0){
		foreach($sssKayitlari as $sss){
	?>
	<tr>
		<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr height="30">
				<td align="left"><b><?php echo $sss["soru"]; ?></b></td>
			</tr>
			<tr>
				<td align="left"><?php echo $sss["cevap"]; ?></td>
			</tr>
			<tr height="20">
				<td align="right"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="20">
						<td width="600">&nbsp;</td>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=38&ID=<?php echo geriDondur($sss["id"]); ?>"><img src="../resimler/guncelle.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="70" align="left"><a href="index.php?skd=0&ski=38&ID=<?php echo geriDondur($sss["id"]); ?>" style="color: #646464; text-decoration: none;">Güncelle</a></td>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=42&ID=<?php echo geriDondur($sss["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="30" align="left"><a href="index.php?skd=0&ski=42&ID=<?php echo geriDondur($sss["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
				<td width="750">Kayıtlı SSS bulunmamaktadır.</td>
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
