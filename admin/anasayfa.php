<?php
if(isset($_SESSION["Yonetici"])){
?>
	<table width="1065" height="100%" align="left" border="0" cellpadding="0" cellspacing="0">
		<tr height="100%">
			<td width="300" align="center" bgcolor="#ff9999" valign="top"><table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="30">
					<td>&nbsp;</td>
				</tr>
				<tr height="70">
					<td align="center"><a href="index.php?skd=0&ski=0"><img src="../resimler/favi.png" border="0"></a></td>
				</tr>
				<tr height="30">
					<td>&nbsp;</td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=95">&nbsp;&nbsp;Siparişler</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=83">&nbsp;&nbsp;Ürünler</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=71">&nbsp;&nbsp;Üyeler</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=79">&nbsp;&nbsp;Yorumlar</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=45">&nbsp;&nbsp;Modeller</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=109">&nbsp;&nbsp;Mesajlar</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=105">&nbsp;&nbsp;Havale Bildirimleri</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=5">&nbsp;&nbsp;Sözleşmeler ve Bilgilendirmeler</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=1">&nbsp;&nbsp;Site Ayarları</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=9">&nbsp;&nbsp;Banka Hesap Ayarları</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=21">&nbsp;&nbsp;Kargo Ayarları</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=57">&nbsp;&nbsp;Yöneticiler</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=0&ski=33">&nbsp;SSS</a></td>
				</tr>
				<tr height="50">
					<td align="left" style="border-bottom: 1px dashed #e6005c;" class="anaMenu"><a href="index.php?skd=4">&nbsp;&nbsp;Çıkış</a></td>
				</tr>
			</table></td>
			<td width="5" align="center" bgcolor="#ff6666" valign="top">&nbsp;</td>
			<td width="1065" align="right" valign="top"><?php
				if((!$ICsk_num) or ($ICsk_num=="") or ($ICsk_num==0)){
					include($sKoduIc[0]);
				}else{
					include($sKoduIc[$ICsk_num]);
				}
			?></td>
		</tr>
	</table>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
