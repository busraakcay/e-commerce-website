<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID			=	filtrele($_GET["ID"]);
	}else{
		$GelenID			=	"";
	}

	$HesaplarSorgusu	=	$db_baglantisi->prepare("SELECT * FROM bankahesaplari WHERE id = ? LIMIT 1");
	$HesaplarSorgusu->execute([$GelenID]);
	$HesaplarSayisi		=	$HesaplarSorgusu->rowCount();
	$HesapBilgisi		=	$HesaplarSorgusu->fetch(PDO::FETCH_ASSOC);

  $BankaAdi = $HesapBilgisi["bankaAdi"];

	if($HesaplarSayisi>0){
?>
<form action="index.php?skd=0&ski=15&ID=<?php echo geriDondur($GelenID); ?>" method="post" enctype="multipart/form-data">
	<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="150">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;<?php echo $BankaAdi;?> Hesabını Güncelle</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td>Banka Logosu</td>
					<td>:</td>
					<td><input type="file" name="BankaLogosu"></td>
				</tr>
				<tr height="40">
					<td width="230">Banka Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="BankaAdi" value="<?php echo geriDondur($HesapBilgisi["bankaAdi"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Banka Şube Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="SubeAdi" value="<?php echo geriDondur($HesapBilgisi["subeAdi"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Banka Şube Kodu</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="SubeKodu" value="<?php echo geriDondur($HesapBilgisi["subeKodu"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Bankanın Bulunduğu Şehir</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KonumSehir" value="<?php echo geriDondur($HesapBilgisi["konumSehir"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Bankanın Bulunduğu Ülke</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="KonumUlke" value="<?php echo geriDondur($HesapBilgisi["konumUlke"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Hesabın Para Birimi</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="ParaBirimi" value="<?php echo geriDondur($HesapBilgisi["paraBirimi"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Hesap Sahibi</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="HesapSahibi" value="<?php echo geriDondur($HesapBilgisi["hesapSahibi"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">Hesap Numarası</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="HesapNumarasi" value="<?php echo geriDondur($HesapBilgisi["hesapNum"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td width="230">IBAN</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="IbanNumarasi" value="<?php echo geriDondur($HesapBilgisi["ibanNum"]); ?>" class="inputs"></td>
				</tr>
				<tr height="40">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><input type="submit" value="Güncelle" class="buttons"></td>
				</tr>
			</table></td>
		</tr>
	</table>
</form>
<?php
	}else{
		header("Location:index.php?skd=0&ski=17");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
