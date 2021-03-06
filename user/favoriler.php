<?php
if(isset($_SESSION["Kullanici"])){

$SayfalamaIcinSolVeSagButonSayisi		=	2;
$SayfaBasinaGosterilecekKayitSayisi		=	5;
$ToplamKayitSayisiSorgusu				=	$db_baglantisi->prepare("SELECT * FROM favoriler WHERE UyeId = ? ORDER BY id DESC");
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
					<td colspan="4" style="color:#ff6666"><h3>Favorilerim</h3></td>
				</tr>
				<tr height="30">
					<td colspan="4" valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Favorilerinize Eklediğiniz Tüm Ürünleri Bu Alandan Görüntüleyebilirsiniz.</i></td>
				</tr>
				<tr height="50">
					<td width="130" style="background: #ff9999; color: black;" align="left">&nbsp;Ürün Resmi:</td>
					<td width="35" style="background: #ff9999; color: black;" align="left">Sil</td>
					<td width="865" style="background: #ff9999; color: black;" align="left">Adı:</td>
					<td width="70" style="background: #ff9999; color: black;" align="left">Fiyatı:</td>
				</tr>
				<?php
				$FavorilerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM favoriler WHERE UyeId = ? ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
				$FavorilerSorgusu->execute([$KullaniciID]);
				$FavoriSayisi			=	$FavorilerSorgusu->rowCount();
				$FavoriKayitlari		=	$FavorilerSorgusu->fetchAll(PDO::FETCH_ASSOC);

				if($FavoriSayisi>0){
					foreach($FavoriKayitlari as $FavoriSatirlar){
						$UrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
						$UrunlerSorgusu->execute([$FavoriSatirlar["UrunId"]]);
						$UrunKaydi			=	$UrunlerSorgusu->fetch(PDO::FETCH_ASSOC);

						$UrununAdi			=	$UrunKaydi["UrunAdi"];
						$UrununUrunTuru		=	$UrunKaydi["UrunTuru"];
						$UrununResmi		=	$UrunKaydi["UrunResmi"];
						$UrununUrunFiyati	=	$UrunKaydi["UrunFiyati"];
						$UrununParaBirimi	=	$UrunKaydi["ParaBirimi"];

            if($UrununUrunTuru == "Kolye"){
              $ResimKlasoruAdi	=	"kolyeler";
            }elseif($UrununUrunTuru == "Küpe"){
              $ResimKlasoruAdi	=	"kupeler";
            }elseif($UrununUrunTuru == "Bileklik"){
              $ResimKlasoruAdi	=	"bileklikler";
            }elseif($UrununUrunTuru == "Yüzük"){
              $ResimKlasoruAdi	=	"yuzukler";
            }elseif($UrununUrunTuru == "Saat"){
              $ResimKlasoruAdi	=	"saatler";
            }elseif($UrununUrunTuru == "Gözlük"){
              $ResimKlasoruAdi	=	"gozlukler";
            }

				?>
        <tr height="30">
        <td width="75" align="left" style="border-bottom: 1px dashed #ffccff;"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunKaydi["id"]); ?>"><img src="urunler/<?php echo $ResimKlasoruAdi; ?>/<?php echo geriDondur($UrununResmi); ?>" border="0" width="60" height="80"></a></td>
        <td width="50" align="left" style="border-bottom: 1px dashed #ffccff;"><a href="index.php?sk=77&ID=<?php echo geriDondur($FavoriSatirlar["id"]); ?>"><img src="resimler/sil.png" border="0"></a></td>
        <td width="415" align="left" style="border-bottom: 1px dashed #ffccff;"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunKaydi["id"]); ?>" style="color: #646464; text-decoration: none;"><?php echo geriDondur($UrununAdi); ?></a></td>
        <td width="100" align="left" style="border-bottom: 1px dashed #ffccff;"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunKaydi["id"]); ?>" style="color: #646464; text-decoration: none;"><?php echo fiyatYaz(geriDondur($UrununUrunFiyati)); ?> <?php echo geriDondur($UrununParaBirimi); ?></a></td>
      </tr>
				<?php
					}
					if($BulunanSayfaSayisi>1){
				?>
					<tr height="50">
						<td colspan="4" align="center"><div class="Sayfalama">
							<br>
							<div class="SayfalamaNumara">
								<?php
								if($Sayfalama>1){
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=55&page=1'><<</a></span>";
									$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$Sayfalama-1;
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=55&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
								}

								for($SayfalamaIcinSayfaIndexDegeri=$Sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$Sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
									if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
										if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
											echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
										}else{
											echo "<span class='SayfalamaPasif'><a href='index.php?sk=55&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
										}
									}
								}

								if($Sayfalama!=$BulunanSayfaSayisi){
									$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$Sayfalama+1;
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=55&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=55&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
						<td colspan="4" align="left">Sisteme Kayıtlı Favori Ürününüz Bulunmamaktadır.</td>
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
