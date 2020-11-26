<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?skd=0&ski=85" method="post" enctype="multipart/form-data">
  <table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="130">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>		<tr height="70">
			<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yeni Ürün Ekle</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Ürün Menüsü</td>
					<td width="20">:</td>
					<td width="500"><select name="UrunMenusu" class="selects">
						<option value="">Lütfen Seçiniz</option>

						<?php
						$MenulerSorgusu			=	$db_baglantisi->prepare("SELECT * FROM menuler ORDER BY UrunTuru ASC, MenuAdi ASC");
						$MenulerSorgusu->execute();
						$MenuSayisi			=	$MenulerSorgusu->rowCount();
						$MenuKayitlari		=	$MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

						foreach($MenuKayitlari as $MenuKaydi){
						?>
							<option value="<?php echo  geriDondur($MenuKaydi["id"]); ?>"><?php echo  geriDondur($MenuKaydi["UrunTuru"]); ?> | <?php echo  geriDondur($MenuKaydi["MenuAdi"]); ?></option>
						<?php
						}
						?>
					</select></td>
				</tr>
				<tr height="40">
					<td width="230">Ürün Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="UrunAdi" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Ürün Fiyatı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="UrunFiyati" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Para Birimi</td>
					<td width="20">:</td>
				  <td width="500"><input type="text" name="ParaBirimi" class="inputs"></td>
				</tr>
        <tr height="40">
          <td width="230">Stok Adedi</td>
          <td width="20">:</td>
          <td width="500"><input type="text" name="StokAdedi" class="inputs"></td>
        </tr>
				<tr height="40">
					<td width="230">KDV Oranı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KdvOrani" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Kargo Ücreti</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KargoUcreti" class="inputs"></td>
				</tr>
				<tr>
					<td width="230" valign="top">Ürün Açıklaması</td>
					<td width="20" valign="top">:</td>
					<td width="500"><textarea name="UrunAciklamasi" class="textAreas"></textarea></td>
				</tr>
				<tr height="40">
					<td>Ürün Resmi</td>
					<td>:</td>
					<td><input type="file" name="Resim"></td>
				</tr>
        <tr height="40">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><input type="submit" value="Ekle" class="buttons"></td>
				</tr>
	</table>
</form>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
