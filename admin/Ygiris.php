<?php
if(empty($_SESSION["Yonetici"])){
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr height="250">
		<td>&nbsp;</td>
	</tr>
  <tr height="70">
    <td align="center"><a href="index.php?skd=0&ski=0"><img src="../resimler/logo.jpg" border="0"></a></td>
  </tr>
  <tr height="50">
    <td>&nbsp;</td>
  </tr>
<form action="index.php?skd=2" method="post">
	<table width="550" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #000000; padding: 20px; border-radius: 5px;">
		<tr height="40">
			<td align="left" width="150">Yönetici Kullanıcı Adı</td>
			<td align="left" width="50">:</td>
			<td align="left" width="240"><input type="text" name="YKullanici" class="inputs"></td>
			<td align="left" width="20">&nbsp;</td>
		</tr>
		<tr height="40">
			<td align="left">Yönetici Şifresi</td>
			<td align="left">:</td>
			<td align="left"><input type="password" name="YSifre" class="inputs"></td>
			<td align="left">&nbsp;</td>
		</tr>
		<tr height="40">
			<td align="left">&nbsp;</td>
			<td align="left">&nbsp;</td>
			<td align="right"><input type="submit" value="Giriş Yap" class="buttons"></td>
			<td align="left">&nbsp;</td>
		</tr>
	</table>
</form>
</table>
<?php
}
?>
