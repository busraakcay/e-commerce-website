<?php
if(isset($_SESSION["Kullanici"])){

$SayfalamaIcinSolVeSagButonSayisi		=	2;
$SayfaBasinaGosterilecekKayitSayisi		=	4;
$ToplamKayitSayisiSorgusu				=	$db_baglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE UyeId = ? ORDER BY SiparisNumarasi DESC");
$ToplamKayitSayisiSorgusu->execute([$KullaniciID]);
$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi		=	($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">

	<tr>
		<td width="1065" valign="top">
			<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td colspan="8" style="color:#ff6666"><h3>Siparişlerim</h3></td>
				</tr>
				<tr height="30">
					<td colspan="8" valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Tüm Siparişlerinizi Bu Alandan Görüntüleyebilirsiniz.</i></td>
				</tr>
				<tr height="50">
					<td width="200" style="background: #ff9999; color: black;" align="left">&nbsp;Sipariş No:</td>
					<td width="200" style="background: #ff9999; color: black;" align="left">Ürün Resmi:</td>
					<td width="210" style="background: #ff9999; color: black;" align="left">Yorum Yap:</td>
					<td width="420" style="background: #ff9999; color: black;" align="left">Adı:</td>
					<td width="215" style="background: #ff9999; color: black;" align="left">Fiyatı:</td>
					<td width="150" style="background: #ff9999; color: black;" align="left">Adet:</td>
					<td width="220" style="background: #ff9999; color: black;" align="left">Toplam Fiyat:</td>
					<td width="150" style="background: #ff9999; color: black;" align="left">Kargo Num:</td>
				</tr>
				<?php
				$SiparisNumaralariSorgusu		=	$db_baglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE UyeId = ? ORDER BY SiparisNumarasi DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
				$SiparisNumaralariSorgusu->execute([$KullaniciID]);
				$SiparisNumaralariSayisi		=	$SiparisNumaralariSorgusu->rowCount();
				$SiparisNumaralariKayitlari		=	$SiparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

				if($SiparisNumaralariSayisi>0){
					foreach($SiparisNumaralariKayitlari as $SiparisNumaralariSatirlar){
						$SiparisNo		=	geriDondur($SiparisNumaralariSatirlar["SiparisNumarasi"]);

						$SiparisSorgusu				=	$db_baglantisi->prepare("SELECT * FROM siparisler WHERE UyeId = ? AND SiparisNumarasi = ? ORDER BY id ASC");
						$SiparisSorgusu->execute([$KullaniciID, $SiparisNo]);
						$SiparisSorgusuKayitlari	=	$SiparisSorgusu->fetchAll(PDO::FETCH_ASSOC);

						foreach($SiparisSorgusuKayitlari as $SiparisSatirlar){
							$UrunTuru		=	geriDondur($SiparisSatirlar["UrunTuru"]);
							if($UrunTuru == "Kolye"){
								$ResimKlasoruAdi	=	"kolyeler";
							}elseif($UrunTuru == "Küpe"){
								$ResimKlasoruAdi	=	"kupeler";
							}elseif($UrunTuru == "Bileklik"){
								$ResimKlasoruAdi	=	"bileklikler";
							}elseif($UrunTuru == "Yüzük"){
								$ResimKlasoruAdi	=	"yuzukler";
							}elseif($UrunTuru == "Saat"){
								$ResimKlasoruAdi	=	"saatler";
							}elseif($UrunTuru == "Gözlük"){
								$ResimKlasoruAdi	=	"gozlukler";
							}

								$KargoDurumu		=	geriDondur($SiparisSatirlar["KargoDurumu"]);
									if($KargoDurumu == 0){
										$KargoDurumuYazdir	=	"Beklemede";
									}else{
										$KargoDurumuYazdir	=	geriDondur($SiparisSatirlar["KargoGonderiKodu"]);
									}
				?>
							<tr height="30">
								<td width="200" align="left" style="border-bottom: 1px dashed #ffccff;">&nbsp;#<?php echo geriDondur($SiparisSatirlar["SiparisNumarasi"]); ?></td>
								<td width="200" align="left" style="border-bottom: 1px dashed #ffccff;"><img src="urunler/<?php echo $ResimKlasoruAdi; ?>/<?php echo geriDondur($SiparisSatirlar["UrunResmi"]); ?>" border="0" width="60" height="80"></td>
								<td width="210" align="left" style="border-bottom: 1px dashed #ffccff;"><a href="index.php?sk=72&UrunID=<?php echo geriDondur($SiparisSatirlar["UrunId"]); ?>"><img src="resimler/kalemlidokuman.png" border="0"></a></td>
								<td width="420" align="left" style="border-bottom: 1px dashed #ffccff;"><?php echo geriDondur($SiparisSatirlar["UrunAdi"]); ?></td>
								<td width="215" align="left" style="border-bottom: 1px dashed #ffccff;"><?php echo fiyatYaz(geriDondur($SiparisSatirlar["UrunFiyati"])); ?> TL</td>
								<td width="150" align="left" style="border-bottom: 1px dashed #ffccff;"><?php echo geriDondur($SiparisSatirlar["UrunAdedi"]); ?></td>
								<td width="220" align="left" style="border-bottom: 1px dashed #ffccff;"><?php echo fiyatYaz(geriDondur($SiparisSatirlar["ToplamUrunFiyati"])); ?> TL</td>
								<td width="150" align="left" style="border-bottom: 1px dashed #ffccff;"><?php echo $KargoDurumuYazdir; ?></td>
							</tr>
				<?php
						}
				?>
						<tr height="30">
							<td colspan="8"><br /></td>
						</tr>
				<?php
					}

					if($BulunanSayfaSayisi>1){
				?>
					<tr height="50">
						<td colspan="8" align="center"><div class="Sayfalama">
				     <br>
							<div class="SayfalamaNumara">
								<?php
								if($Sayfalama>1){
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=57&page=1'><<</a></span>";
									$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$Sayfalama-1;
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=57&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
								}

								for($SayfalamaIcinSayfaIndexDegeri=$Sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$Sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
									if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
										if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
											echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
										}else{
											echo "<span class='SayfalamaPasif'><a href='index.php?sk=57&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
										}
									}
								}

								if($Sayfalama!=$BulunanSayfaSayisi){
									$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$Sayfalama+1;
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=57&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=57&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
								}
								?>
							</div>
						</div></td>
					</tr>
				<?php
					}
				}else{
				?>
					<tr height="50">
						<td colspan="8" align="left">Sisteme Kayıtlı Siparişiniz Bulunmamaktadır.</td>
					</tr>
				<?php
				}
				?>
			</table>
		</td>
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
