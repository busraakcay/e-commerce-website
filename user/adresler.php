<?php
if(isset($_SESSION["Kullanici"])){
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">

	<tr>
		<td width="1065" valign="top">
			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td colspan="5" style="color:#ff6666"><h3>Adreslerim</h3></td>
				</tr>
				<tr height="30">
					<td colspan="5" valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Tüm Adreslerini görüntüleyebilir veya güncelleyebilirsin.</i></td>
				</tr>
				<tr height="50">
					<td colspan="1" style="background: #ff9999; color: black; font-weight: bold;" align="left">&nbsp;Adresler</td>
					<td colspan="4" style="background: #ff9999; color: black; font-weight: bold;" align="right"><a href="index.php?sk=67" style="text-decoration: none; color: #000000;">+ Adres Ekle</a>&nbsp;</td>
				</tr>
				<?php
				$AdreslerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM adresler WHERE uyeID = ?");
				$AdreslerSorgusu->execute([$KullaniciID]);
				$AdreslerSayisi			=	$AdreslerSorgusu->rowCount();
				$AdreslerKayitlari		=	$AdreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);

				$Renk1			=	"#ffffff";
				$Renk2			=	"#ffe6ff";
				$RenkSayisi				=	1;

				if($AdreslerSayisi>0){
					foreach($AdreslerKayitlari as $Adresler){
						if($RenkSayisi % 2){
							$ArkaplanRengi	=	$Renk1;
						}else{
							$ArkaplanRengi	=	$Renk2;
						}
				?>
					<tr height="50" bgcolor="<?php echo $ArkaplanRengi; ?>">
						<td align="left"><?php echo $Adresler["adiSoyadi"]; ?> - <?php echo $Adresler["adres"]; ?> <?php echo $Adresler["Sehir"]; ?> / <?php echo $Adresler["Ilce"]; ?> - <?php echo $Adresler["telefon"]; ?></td>
						<td width="25"><a href="index.php?sk=58&ID=<?php echo $Adresler["id"]; ?>"><img src="resimler/guncelle.png" border="0" style="margin-top: 5px;"></td>
						<td width="70"><a href="index.php?sk=58&ID=<?php echo $Adresler["id"]; ?>" style="text-decoration: none; color: #646464;">Güncelle</a></td>
						<td width="25"><a href="index.php?sk=64&ID=<?php echo $Adresler["id"]; ?>"><img src="resimler/sil.png" border="0" style="margin-top: 5px;"></td>
						<td width="25"><a href="index.php?sk=64&ID=<?php echo $Adresler["id"]; ?>" style="text-decoration: none; color: #646464;">Sil</a></td>
					</tr>
				<?php
						$RenkSayisi++;
					}
				}else{
				?>
					<tr height="50">
						<td colspan="5" align="left">Sisteme Kayıtlı Adresiniz Bulunmamaktadır.</td>
					</tr>
				<?php
				}
				?>
			</table>
		</td>
	</tr>
	<tr height="30">
		<td colspan="8"><br /></td>
	</tr>
  <tr>
    <td style="border-top: 5px dotted #4d0033;"><br></td>
  </tr>
  <tr>
    <td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
      <a href="index.php?sk=45" style="text-decoration: none; color: #ff00aa;">Üyelik Bilgilerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
      <a href="index.php?sk=54" style="text-decoration: none; color: #ff00aa;">Adreslerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
      <a href="index.php?sk=57" style="text-decoration: none; color: #ff00aa;">Siparişlerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
      <a href="index.php?sk=55" style="text-decoration: none; color: #ff00aa;">Favorilerim</a></td>
    <td width="10">&nbsp;</td>
    <td width="203" style="border: 2px dashed #ff00aa; text-align: center; padding: 10px 0; font-weight: bold;">
      <a href="index.php?sk=56" style="text-decoration: none; color: #ff00aa;">Yorumlarım</a></td>
  </tr>
    </table></td>
  </tr>
  <tr>
    <td style="border-bottom: 5px dotted #4d0033;"><br></td>
  </tr>
</table>
<?php
}else{
	header("Location:index.php");
	exit();
}
?>
