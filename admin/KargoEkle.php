<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=23" method="post" enctype="multipart/form-data">
  <table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 370px;">
    <tr height = "250">
      <td>&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yeni Kargo Firması Ekle</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td>Kargo Firması Logosu</td>
					<td>:</td>
					<td><input type="file" name="KargoFirmasiLogosu"></td>
				</tr>
				<tr height="40">
					<td width="230">Kargo Firması Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KargoFirmasiAdi" class="inputs"></td>
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
