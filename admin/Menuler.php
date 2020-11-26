<?php
if(isset($_SESSION["Yonetici"])){
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
	<tr height="90">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<tr height="70">
		<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Modeller</h3></td>
		<td width="200" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=46" style="color: #262626; text-decoration: none;">+ Yeni Model Ekle&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$MenulerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM menuler ORDER BY UrunTuru ASC");
	$MenulerSorgusu->execute();
	$MenulerSayisi		=	$MenulerSorgusu->rowCount();
	$MenulerKayitlari	=	$MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($MenulerSayisi>0){
		foreach($MenulerKayitlari as $Menu){
	?>
	<tr>
		<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr height="30">
				<td align="left" width="200"><b><?php echo $Menu["UrunTuru"]; ?></b></td>
				<td align="left" width="400"><?php echo $Menu["MenuAdi"]; ?> (<?php echo $Menu["UrunSayisi"]; ?>)</td>
				<td align="right" width="150"><table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=50&ID=<?php echo geriDondur($Menu["id"]); ?>"><img src="../resimler/guncelle.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="70" align="left"><a href="index.php?skd=0&ski=50&ID=<?php echo geriDondur($Menu["id"]); ?>" style="color: #646464; text-decoration: none;">Güncelle</a></td>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=54&ID=<?php echo geriDondur($Menu["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="30" align="left"><a href="index.php?skd=0&ski=54&ID=<?php echo geriDondur($Menu["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
				<td width="750">Kayıtlı model bulunmamaktadır.</td>
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
