<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=2" method="post" enctype="multipart/form-data">
	<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 450px;">
    <tr height="120">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr height="70">
			<td bgcolor="#ff9999" align="center" style="color: #262626;"><h3>Site Ayarları</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Site Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="SiteAdi" value="<?php echo geriDondur($siteAdi); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Başlığı</td>
					<td>:</td>
					<td><input type="text" name="SiteTitle" value="<?php echo geriDondur($siteBasligi); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Açıklaması</td>
					<td>:</td>
					<td><input type="text" name="SiteDescription" value="<?php echo geriDondur($siteAciklama); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Keywords</td>
					<td>:</td>
					<td><input type="text" name="SiteKeywords" value="<?php echo geriDondur($siteKword); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Copyright</td>
					<td>:</td>
					<td><input type="text" name="siteCR" value="<?php echo geriDondur($siteCR); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Logosu</td>
					<td>:</td>
					<td><input type="file" name="SiteLogosu"></td>
				</tr>
				<tr height="40">
					<td>Site Linki</td>
					<td>:</td>
					<td><input type="text" name="SiteLinki" value="<?php echo geriDondur($siteLinki); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Email Adresi</td>
					<td>:</td>
					<td><input type="text" name="SiteEmailAdresi" value="<?php echo geriDondur($siteEmail); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Email Şifresi</td>
					<td>:</td>
					<td><input type="text" name="SiteEmailSifresi" value="<?php echo geriDondur($siteEmailPswrd); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Site Host Adresi</td>
					<td>:</td>
					<td><input type="text" name="SiteEmailHostAdresi" value="<?php echo geriDondur($siteHostu); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Facebook Linki</td>
					<td>:</td>
					<td><input type="text" name="facebook" value="<?php echo geriDondur($facebook); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Twitter Linki</td>
					<td>:</td>
					<td><input type="text" name="twitter" value="<?php echo geriDondur($twitter); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Instagram Linki</td>
					<td>:</td>
					<td><input type="text" name="instagram" value="<?php echo geriDondur($instagram); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>Ücretsiz Kargo Barajı</td>
					<td>:</td>
					<td><input type="text" name="ucretsizKargo" value="<?php echo geriDondur($ucretsizKargo); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><input type="submit" value="Değişiklikleri Kaydet" class="buttons"></td>
				</tr>
			</table></td>
		</tr>
	</table>
</form>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
