<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=6" method="post">
	<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 450px;">
		<tr height="20">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr height="70">
			<td bgcolor="#ff9999" align="center" style="color: #262626;"><h3>Sözleşmeler ve Bilgilendirmeler</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
					<td width="230" valign="top">Hakkımızda</td>
					<td width="20" valign="top">:</td>
					<td width="500" valign="top"><textarea name="Hakkimizda" class="textAreas"><?php echo geriDondur($hakkimizda); ?></textarea></td>
				</tr>
				<tr>
					<td width="230" valign="top">Üyelik Sözleşmesi</td>
					<td width="20" valign="top">:</td>
					<td width="500" valign="top"><textarea name="UyelikSozlesmesi" class="textAreas"><?php echo geriDondur($uyelikSozlesmesi); ?></textarea></td>
				</tr>
				<tr>
					<td width="230" valign="top">Kullanım Koşulları</td>
					<td width="20" valign="top">:</td>
					<td width="500" valign="top"><textarea name="KullanimKosullari" class="textAreas"><?php echo geriDondur($kullanimKosullari); ?></textarea></td>
				</tr>
				<tr>
					<td width="230" valign="top">Gizlilik Sözleşmesi</td>
					<td width="20" valign="top">:</td>
					<td width="500" valign="top"><textarea name="GizlilikSozlesmesi" class="textAreas"><?php echo geriDondur($gizlilikSozlesmesi); ?></textarea></td>
				</tr>
				<tr>
					<td width="230" valign="top">Mesafeli Satış Sözleşmesi</td>
					<td width="20" valign="top">:</td>
					<td width="500" valign="top"><textarea name="MesafeliSatisSozlesmesi" class="textAreas"><?php echo geriDondur($mesafeliSatisSozlesmesi); ?></textarea></td>
				</tr>
				<tr>
					<td width="230" valign="top">Teslimat</td>
					<td width="20" valign="top">:</td>
					<td width="500" valign="top"><textarea name="Teslimat" class="textAreas"><?php echo geriDondur($teslimat); ?></textarea></td>
				</tr>
				<tr>
					<td width="230" valign="top">İptal & İade & Değişim</td>
					<td width="20" valign="top">:</td>
					<td width="500" valign="top"><textarea name="IptalIadeDegisim" class="textAreas"><?php echo geriDondur($iptalIadeDegisim); ?></textarea></td>
				</tr>
				<tr height="40">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><input type="submit" value="Değişiklikleri Kaydet" class="buttons"></td>
				</tr>
        <tr height="50">
          <td style="font-size: 10px;">&nbsp;</td>
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
