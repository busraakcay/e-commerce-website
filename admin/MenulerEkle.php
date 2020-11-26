<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=47" method="post">
  <table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="70">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yeni Model Ekle</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Menü İçin Ürün Türü</td>
					<td width="20">:</td>
					<td width="500"><select name="UrunTuru" class="selects">
						<option value="">Lütfen Seçiniz</option>
						<option value="Kolye">Kolye</option>
						<option value="Küpe">Küpe</option>
						<option value="Bileklik">Bileklik</option>
            <option value="Yüzük">Yüzük</option>
						<option value="Saat">Saat</option>
						<option value="Gözlük">Gözlük</option>
					</select></td>
				</tr>
				<tr height="40">
					<td width="230">Menü Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="MenuAdi" class="inputs"></td>
				</tr>
        <tr height="40">
          <td width="230">Ürün Adedi</td>
          <td width="20">:</td>
          <td width="500"><input type="text" name="UrunAdedi" class="inputs"></td>
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
