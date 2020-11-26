<?php
if(isset($_SESSION["Yonetici"])){
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="180">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yöneticiler</h3></td>
		<td width="200" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=58" style="color: #262626; text-decoration: none;">+ Yeni Yönetici Ekle&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$YoneticilerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM yoneticiler ORDER BY isimSoyisim ASC");
	$YoneticilerSorgusu->execute();
	$YoneticilerSayisi		=	$YoneticilerSorgusu->rowCount();
	$YoneticilerKayitlari	=	$YoneticilerSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($YoneticilerSayisi>0){
		foreach($YoneticilerKayitlari as $YoneticilerSatirlari){
	?>
	<tr>
		<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr height="30">
				<td align="left" width="150"><?php echo $YoneticilerSatirlari["kullaniciAdi"]; ?></td>
				<td align="left" width="150"><?php echo $YoneticilerSatirlari["isimSoyisim"]; ?></td>
				<td align="left" width="200"><?php echo $YoneticilerSatirlari["email"]; ?></td>
				<td align="left" width="100"><?php echo $YoneticilerSatirlari["telefon"]; ?></td>
				<td align="right" width="150"><table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=64&ID=<?php echo geriDondur($YoneticilerSatirlari["id"]); ?>"><img src="../resimler/guncelle.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="70" align="left"><a href="index.php?skd=0&ski=64&ID=<?php echo geriDondur($YoneticilerSatirlari["id"]); ?>" style="color: #646464; text-decoration: none;">Güncelle</a></td>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=68&ID=<?php echo geriDondur($YoneticilerSatirlari["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 5px;"></a></td>
						<td width="30" align="left"><a href="index.php?skd=0&ski=68&ID=<?php echo geriDondur($YoneticilerSatirlari["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
				<td width="750">Kayıtlı yönetici bulunmamaktadır.</td>
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
