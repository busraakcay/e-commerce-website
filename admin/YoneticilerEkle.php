<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=59" method="post">
  <table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="200">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yönetici Ekle</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Kullanıcı Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KullaniciAdi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Şifre</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="Sifre" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">İsim Soyisim</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="IsimSoyisim" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">E-Mail Adresi</td>
					<td width="20">:</td>
					<td width="500"><input type="email" name="EmailAdresi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Telefon Numarası</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="TelefonNumarasi" class="inputs" maxlength="11"></td>
				</tr>
				<tr height="40">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><input type="submit" value="Ekle" class="buttons"></td>
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
