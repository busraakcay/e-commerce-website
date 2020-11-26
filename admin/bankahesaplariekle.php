<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=11" method="post" enctype="multipart/form-data">
	<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="150">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yeni Banka Hesabı Ekle</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td>Banka Logosu</td>
					<td>:</td>
					<td><input type="file" name="BankaLogosu"></td>
				</tr>
				<tr height="40">
					<td width="230">Banka Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="BankaAdi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Banka Şube Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="SubeAdi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Banka Şube Kodu</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="SubeKodu" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Bankanın Bulunduğu Şehir</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KonumSehir" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Bankanın Bulunduğu Ülke</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KonumUlke" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Hesabın Para Birimi</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="ParaBirimi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Hesap Sahibi</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="HesapSahibi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Hesap Numarası</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="HesapNumarasi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">IBAN</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="IbanNumarasi" class="inputs"></td>
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
