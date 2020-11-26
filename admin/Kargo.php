<?php
if(isset($_SESSION["Yonetici"])){
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 370px;">
  <tr height = "150">
    <td>&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="550" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Kargo Ayarları</h3></td>
		<td width="200" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=22" style="color: #262626; text-decoration: none;">+ Yeni Kargo Firması Ekle&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$KargolarSorgusu		=	$db_baglantisi->prepare("SELECT * FROM kargofirmalari ORDER BY KargoFirmasiAdi ASC");
	$KargolarSorgusu->execute();
	$KargolarSayisi			=	$KargolarSorgusu->rowCount();
	$KargolarKayitlari		=	$KargolarSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($KargolarSayisi>0){
		foreach($KargolarKayitlari as $Kargolar){
	?>
	<tr height="50">
		<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr height="50">
				<td width="200" align="left"><img src="../resimler/<?php echo geriDondur($Kargolar["KargoFirmasiLogosu"]); ?>" border="0"></td>
				<td width="10" align="left">&nbsp;</td>
				<td width="150" align="left"><b>Kargo Firması Adı</b></td>
				<td width="20" align="left"><b>:</b></td>
				<td width="210" align="left"><?php echo geriDondur($Kargolar["KargoFirmasiAdi"]); ?></td>
				<td width="10" align="left">&nbsp;</td>
				<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=26&ID=<?php echo geriDondur($Kargolar["id"]); ?>"><img src="../resimler/guncelle.png" border="0" style="margin-top: 15px;"></a></td>
				<td width="70" align="left"><a href="index.php?skd=0&ski=26&ID=<?php echo geriDondur($Kargolar["id"]); ?>" style="color: #646464; text-decoration: none;">Güncelle</a></td>
				<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=30&ID=<?php echo geriDondur($Kargolar["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 15px;"></a></td>
				<td width="30" align="left"><a href="index.php?skd=0&ski=30&ID=<?php echo geriDondur($Kargolar["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
				<td width="750">Kayıtlı kargo firması bulunmamaktadır.</td>
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
