<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_REQUEST["AramaIcerigi"])){
		$GelenAramaIcerigi	=	filtrele($_REQUEST["AramaIcerigi"]);
		$AramaKosulu		=	 " AND UrunAdi LIKE '%" . $GelenAramaIcerigi . "%' ";
		$SayfalamaKosulu	=	"&AramaIcerigi=" . $GelenAramaIcerigi;
	}else{
		$AramaKosulu		=	"";
		$SayfalamaKosulu	=	"";
	}

	$SayfalamaIcinSolVeSagButonSayisi		=	2;
	$SayfaBasinaGosterilecekKayitSayisi		=	8;
	$ToplamKayitSayisiSorgusu				=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE Durumu = ? $AramaKosulu ORDER BY id DESC");
	$ToplamKayitSayisiSorgusu->execute([1]);
	$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
	$SayfalamayaBaslanacakKayitSayisi		=	($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
	$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
	<tr height="70">
		<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Ürünler</h3></td>
		<td width="200" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=84" style="color: #262626; text-decoration: none;">+ Yeni Ürün Ekle&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><div class="Arama"><form action="index.php?skd=0&ski=83" method="post">
					<div class="AramaButon">
						<input type="submit" value="" class="AramaButonuURL">
					</div>
					<div class="AramaInput">
						<input type="text" name="AramaIcerigi" class="AramaInputuIci">
					</div>
				</form></div></td>
			</tr>
		</table></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$UrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE Durumu = ? $AramaKosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
	$UrunlerSorgusu->execute([1]);
	$UrunlerSayisi			=	$UrunlerSorgusu->rowCount();
	$UrunlerKayitlari		=	$UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($UrunlerSayisi>0){
		foreach($UrunlerKayitlari as $Urunler){
			$UrununMenuSorgusu		=	$db_baglantisi->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
			$UrununMenuSorgusu->execute([geriDondur($Urunler["MenuId"])]);
			$UrunMenuKaydi			=	$UrununMenuSorgusu->fetch(PDO::FETCH_ASSOC);

			if($Urunler["UrunTuru"] == "Kolye"){
				$ResimKlasoru	=	"kolyeler";
			}elseif($Urunler["UrunTuru"] == "Küpe"){
				$ResimKlasoru	=	"kupeler";
			}elseif($Urunler["UrunTuru"] == "Bileklik"){
				$ResimKlasoru	=	"bileklikler";
			}elseif($Urunler["UrunTuru"] == "Yüzük"){
				$ResimKlasoru	=	"yuzukler";
			}elseif($Urunler["UrunTuru"] == "Saat"){
				$ResimKlasoru	=	"saatler";
			}elseif($Urunler["UrunTuru"] == "Gözlük"){
				$ResimKlasoru	=	"gozlukler";
			}
	?>
	<tr height="80">
		<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
      <td style="font-size: 5px;">&nbsp;</td>
			<tr>
				<td width="60" valign="top"><img src="../urunler/<?php echo $ResimKlasoru; ?>/<?php echo geriDondur($Urunler["UrunResmi"]); ?>" border="0" width="60" height="80"></td>
				<td width="10">&nbsp;</td>
				<td width="680" valign="top"><table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="25">
						<td colspan="2"><?php echo geriDondur($Urunler["UrunTuru"]); ?> | <?php echo geriDondur($UrunMenuKaydi["MenuAdi"]); ?></td>
					</tr>
					<tr height="25">
						<td width="580"><?php echo geriDondur($Urunler["UrunAdi"]); ?></td>
						<td width="100" align="right"><?php echo  fiyatYaz(geriDondur($Urunler["UrunFiyati"])); ?> <?php echo geriDondur($Urunler["ParaBirimi"]); ?></td>
					</tr>
					<tr height="25">
						<td width="540"><?php echo geriDondur($Urunler["ToplamSatisSayisi"]); ?> adet satıldı. <?php echo geriDondur($Urunler["YorumSayisi"]); ?> adet yorumda <?php echo geriDondur($Urunler["ToplamYorumPuani"]); ?> Puan aldı. <?php echo geriDondur($Urunler["GoruntulenmeSayisi"]); ?> defa görüntülendi.</td>
						<td width="140" align="right"><table width="140" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="25" valign="top"><a href="index.php?skd=0&ski=88&ID=<?php echo geriDondur($Urunler["id"]); ?>"><img src="../resimler/guncelle.png" border="0"></a></td>
								<td width="70" valign="top"><a href="index.php?skd=0&ski=88&ID=<?php echo geriDondur($Urunler["id"]); ?>" style="color: #646464; text-decoration: none;">Güncelle</a></td>
								<td width="25" valign="top"><a href="index.php?skd=0&ski=92&ID=<?php echo geriDondur($Urunler["id"]); ?>"><img src="../resimler/sil.png" border="0"></a></td>
								<td width="20" valign="top"><a href="index.php?skd=0&ski=92&ID=<?php echo geriDondur($Urunler["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
							</tr>
						</table></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	<?php
		}

		if($BulunanSayfaSayisi>1){
		?>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>

	<tr height="50">
		<td colspan="2" align="center"><div class="Sayfalama">
      <div><br></div>
			<div class="SayfalamaNumara">
				<?php
				if($Sayfalama>1){
					echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=83" . $SayfalamaKosulu . "&page=1'><<</a></span>";
					$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$Sayfalama-1;
					echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=83" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
				}

				for($SayfalamaIcinSayfaIndexDegeri=$Sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$Sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
					if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
						if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
							echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
						}else{
							echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=83" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
						}
					}
				}

				if($Sayfalama!=$BulunanSayfaSayisi){
					$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$Sayfalama+1;
					echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=83" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
					echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=83" . $SayfalamaKosulu . "&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
				}
				?>
			</div>
		</div></td>
	</tr>
		<?php
		}
	}else{
	?>
	<tr>
		<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="750">Kayıtlı ürün bulunmamaktadır.</td>
			</tr>
		</table></td>
	</tr>
	<?php
	}
	?>
</table>
<?php
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
