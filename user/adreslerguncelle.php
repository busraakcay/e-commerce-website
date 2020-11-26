<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}

	if($GelenID!=""){
		$AdresSorgusu		=	$db_baglantisi->prepare("SELECT * FROM adresler WHERE id = ? AND UyeId = ? LIMIT 1");
		$AdresSorgusu->execute([$GelenID, $KullaniciID]);
		$AdresSayisi		=	$AdresSorgusu->rowCount();
		$KayitBilgisi		=	$AdresSorgusu->fetch(PDO::FETCH_ASSOC);

		if($AdresSayisi>0){
?>
			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="1065" valign="top">
						<form action="index.php?sk=59&ID=<?php echo $GelenID; ?>" method="post">
							<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr height="40">
									<td style="color:#ff6666"><h3>Adreslerim</h3></td>
                </tr>
      					<tr height="30">
      						<td valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Tüm Adreslerini görüntüleyebilir veya güncelleyebilirsin.</i></td>
      					</tr>
      					<tr height="30">
      						<td valign="bottom" align="left">İsim Soyisim:</td>
                  <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
      					</tr>
      					<tr height="30">
      						<td valign="top" align="left"><input type="text" name="IsimSoyisim" class="inputs" value="<?php echo $KayitBilgisi["adiSoyadi"]; ?>"></td>
      					</tr>
      					<tr height="30">
      						<td valign="bottom" align="left">Adres:</td>
                  <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
      					</tr>
      					<tr height="30">
      						<td valign="top" align="left"><input type="text" name="Adres" class="inputs" value="<?php echo $KayitBilgisi["adres"]; ?>"></td>
      					</tr>
      					<tr height="30">
      						<td valign="bottom" align="left">İl:</td>
                  <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
      					</tr>
      					<tr height="30">
      						<td valign="top" align="left"><input type="text" name="Sehir" class="inputs" value="<?php echo $KayitBilgisi["Sehir"]; ?>"></td>
      					</tr>
      					<tr height="30">
      						<td valign="bottom" align="left">İlçe:</td>
                  <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
      					</tr>
      					<tr height="30">
      						<td valign="top" align="left"><input type="text" name="Ilce" class="inputs" value="<?php echo $KayitBilgisi["Ilce"]; ?>"></td>
      					</tr>
      					<tr height="30">
      						<td valign="bottom" align="left">Telefon Numarası:</td>
                  <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
      					</tr>
      					<tr height="30">
      						<td valign="top" align="left"><input type="text" name="TelefonNumarasi" maxlength="11" class="inputs" value="<?php echo $KayitBilgisi["telefon"]; ?>"></td>
      					</tr>
      					<tr height="60">
      						<td colspan="2" align="center"><input type="submit" value="Adresi Kaydet" class="buttons"></td>
      					</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
<?php
		}else{
			header("Location:index.php?sk=62");
			exit();
		}
	}else{
		header("Location:index.php?sk=62");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
