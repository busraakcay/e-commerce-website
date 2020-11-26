<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=35" method="post">
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="250">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Sıkça Sorulan Sorular</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Soru</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="Soru" class="inputs"></td>
				</tr>
				<tr>
					<td width="230" valign="top">Cevap</td>
					<td width="20" valign="top">:</td>
					<td width="500"><textarea name="Cevap" class="textAreas"></textarea></td>
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
