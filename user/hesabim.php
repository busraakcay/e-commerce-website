<?php
if(isset($_SESSION["Kullanici"])){
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">

	<tr>
		<td width="1065" valign="top">
			<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td style="color:#ff6666"><h3>Hesap Bilgileri</h3></td>
				</tr>
				<tr height="30">
					<td valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Üyelik bilgilerinizi görüntüleyebilir veya güncelleyebilirsiniz.</i></td>
				</tr>
				<tr height="30">
					<td valign="bottom" align="left"><b>İsim Soyisim</b></td>
				</tr>
				<tr height="30">
					<td valign="top" align="left"><?php echo $IsimSoyisim; ?></td>
				</tr>
				<tr height="30">
					<td valign="bottom" align="left"><b>Cinsiyet</b></td>
				</tr>
				<tr height="30">
					<td valign="top" align="left"><?php echo $Cinsiyet; ?></td>
				</tr>
				<tr height="30">
					<td valign="bottom" align="left"><b>E-Mail Adresi</b></td>
				</tr>
				<tr height="30">
					<td valign="top" align="left"><?php echo $EmailAdresi; ?></td>
				</tr>
				<tr height="30">
					<td valign="bottom" align="left"><b>Telefon Numarası</b></td>
				</tr>
				<tr height="30">
					<td valign="top" align="left"><?php echo $TelefonNumarasi; ?></td>
				</tr>
				<tr height="30">
					<td valign="bottom" align="left"><b>Kayıt Tarihi</b></td>
				</tr>
				<tr height="30">
					<td valign="top" align="left"><?php echo tarihCevir($KayitTarihi); ?></td>
				</tr>
				<tr height="60">
					<td valign="top" align="right"><a href="index.php?sk=47" class="bilgiguncelle">Bilgilerimi Güncelle</a></td>
				</tr>
			</table>
		</td>
	</tr>
  <tr>
    <td colspan="3" style="border-top: 5px dotted #4d0033;"><br></td>
  </tr>
  <tr>
    <td colspan="3"><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
    <a href="index.php?sk=45" style="text-decoration: none; color: #ff00aa;">Üyelik Bilgilerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
    <a href="index.php?sk=54" style="text-decoration: none; color: #ff00aa;">Adreslerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
    <a href="index.php?sk=57" style="text-decoration: none; color: #ff00aa;">Siparişlerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
    <a href="index.php?sk=55" style="text-decoration: none; color: #ff00aa;">Favorilerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
    <a href="index.php?sk=56" style="text-decoration: none; color: #ff00aa;">Yorumlarım</a></td>
  </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom: 5px dotted #4d0033;"><br></td>
  </tr>
</table>
<?php
}else{
	header("Location:index.php");
	exit();
}
?>
