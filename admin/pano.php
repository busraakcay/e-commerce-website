<?php
if(isset($_SESSION["Yonetici"])){
	$BekleyenSiparislerSorgusu		=	$db_baglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE OnayDurumu = ? AND KargoDurumu = ?");
	$BekleyenSiparislerSorgusu->execute([0, 0]);
	$BekleyenSiparislerSayisi		=	$BekleyenSiparislerSorgusu->rowCount();

	$TamamlananSiparislerSorgusu	=	$db_baglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE OnayDurumu = ? AND KargoDurumu = ?");
	$TamamlananSiparislerSorgusu->execute([1, 1]);
	$TamamlananSiparislerSayisi		=	$TamamlananSiparislerSorgusu->rowCount();

	$TumSiparislerSorgusu			=	$db_baglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler");
	$TumSiparislerSorgusu->execute();
	$TumSiparislerSayisi			=	$TumSiparislerSorgusu->rowCount();

	$HavaleBildirimSorgusu			=	$db_baglantisi->prepare("SELECT * FROM havalebildirimleri");
	$HavaleBildirimSorgusu->execute();
	$HavaleBildirimSayisi			=	$HavaleBildirimSorgusu->rowCount();

	$BankalarSorgusu				=	$db_baglantisi->prepare("SELECT * FROM bankahesaplari");
	$BankalarSorgusu->execute();
	$BankalarSayisi					=	$BankalarSorgusu->rowCount();

	$MenulerSorgusu					=	$db_baglantisi->prepare("SELECT * FROM menuler");
	$MenulerSorgusu->execute();
	$MenulerSayisi					=	$MenulerSorgusu->rowCount();

	$UrunlerSorgusu					=	$db_baglantisi->prepare("SELECT * FROM urunler");
	$UrunlerSorgusu->execute();
	$UrunlerSayisi					=	$UrunlerSorgusu->rowCount();

	$UyelerSorgusu					=	$db_baglantisi->prepare("SELECT * FROM uyeler");
	$UyelerSorgusu->execute();
	$UyelerSayisi					=	$UyelerSorgusu->rowCount();

	$YoneticilerSorgusu				=	$db_baglantisi->prepare("SELECT * FROM yoneticiler");
	$YoneticilerSorgusu->execute();
	$YoneticilerSayisi				=	$YoneticilerSorgusu->rowCount();

	$KargolarSorgusu				=	$db_baglantisi->prepare("SELECT * FROM kargofirmalari");
	$KargolarSorgusu->execute();
	$KargolarSayisi					=	$KargolarSorgusu->rowCount();

	$IletisimSorgusu				=	$db_baglantisi->prepare("SELECT * FROM iletisim");
	$IletisimSorgusu->execute();
	$IletisimSayisi				=	$IletisimSorgusu->rowCount();

	$YorumlarSorgusu				=	$db_baglantisi->prepare("SELECT * FROM yorumlar");
	$YorumlarSorgusu->execute();
	$YorumlarSayisi					=	$YorumlarSorgusu->rowCount();

	$SorularSorgusu					=	$db_baglantisi->prepare("SELECT * FROM sorular");
	$SorularSorgusu->execute();
	$SorularSayisi					=	$SorularSorgusu->rowCount();
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="100">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Pano</h3></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Bekleyen Siparişler</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $BekleyenSiparislerSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Tamamlanan Siparişler</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $TamamlananSiparislerSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Tüm Siparişler</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $TumSiparislerSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<tr height="10">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Havale Bildirimleri</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $HavaleBildirimSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Banka Hesapları</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $BankalarSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Mesajlar</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $IletisimSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<tr height="10">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Ürünler</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $UrunlerSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Üyeler</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $UyelerSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Yöneticiler</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $YoneticilerSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<tr height="10">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Kargo Firmaları</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $KargolarSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Model Adedi</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $MenulerSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Yorumlar</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $YorumlarSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<tr height="10">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="243" style="border: 1px solid #e6005c;"><table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 18px;">Sık Sorulan Sorular</td>
					</tr>
					<tr height="30">
						<td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $SorularSayisi; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table></td>
				<td width="10">&nbsp;</td>
				<td width="243">&nbsp;</td>
				<td width="10">&nbsp;</td>
				<td width="243">&nbsp;</td>
			</tr>
		</table></td>
	</tr>
</table>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
