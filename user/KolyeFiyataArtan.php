<?php
if(isset($_REQUEST["MenuID"])){
	$GelenMenuId		=	sayilarifiltrele(filtrele($_REQUEST["MenuID"]));
	$MenuKosulu			=	 " AND MenuId = '" . $GelenMenuId . "' ";
	$SayfalamaKosulu	=	"&MenuID=" . $GelenMenuId;
}else{
	$GelenMenuId		=	"";
	$MenuKosulu			=	"";
	$SayfalamaKosulu	=	"";
}

if(isset($_REQUEST["AramaIcerigi"])){
	$GelenAramaIcerigi	=	filtrele($_REQUEST["AramaIcerigi"]);
	$AramaKosulu		=	 " AND UrunAdi LIKE '%" . $GelenAramaIcerigi . "%' ";
	$SayfalamaKosulu	.=	"&AramaIcerigi=" . $GelenAramaIcerigi;
}else{
	$AramaKosulu		=	"";
	$SayfalamaKosulu	.=	"";
}

$SayfalamaIcinSolVeSagButonSayisi		=	2;
$SayfaBasinaGosterilecekKayitSayisi		=	4;
$ToplamKayitSayisiSorgusu				=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE UrunTuru = 'Kolye' AND Durumu = '1' $MenuKosulu $AramaKosulu ORDER BY id DESC");
$ToplamKayitSayisiSorgusu->execute();
$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi		=	($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);

$AnaMenununTumUrunSayiSorgusu		=	$db_baglantisi->prepare("SELECT SUM(UrunSayisi) AS MenununToplamUrunu FROM menuler WHERE UrunTuru = 'Kolye'");
$AnaMenununTumUrunSayiSorgusu->execute();
$AnaMenununTumUrunSayiSorgusu		=	$AnaMenununTumUrunSayiSorgusu->fetch(PDO::FETCH_ASSOC);
?>
<table width="1065" align="left" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="1065" align="left" valign="top"><table width="550" align="left" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
						<tr height="35">
							<td bgcolor="#ff9999" style="color:white;"><b>&nbsp;MODELLER</b></td>
						</tr>
						<tr height="30">
						<td><a href="index.php?sk=107" style="text-decoration: none; <?php if($GelenMenuId==''){ ?>color: #cc0099;<?php }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;Tüm Ürünler [<?php echo $AnaMenununTumUrunSayiSorgusu["MenununToplamUrunu"]; ?>]</a></td>
	          </tr>
					<?php
					$MenulerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM menuler WHERE UrunTuru = 'Kolye' ORDER BY MenuAdi ASC");
					$MenulerSorgusu->execute();
					$MenuKayitSayisi	=	$MenulerSorgusu->rowCount();
					$MenuKayitlari		=	$MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

					foreach($MenuKayitlari as $Menu){
					?>
						<tr height="30">
							<td><a href="index.php?sk=107&MenuID=<?php echo $Menu["id"]; ?>" style="text-decoration: none;<?php if($GelenMenuId==$Menu['id']){ ?> color: #cc0099;
              <?php }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;<?php echo geriDondur($Menu["MenuAdi"]); ?> [<?php echo geriDondur($Menu["UrunSayisi"]); ?>]</a></td>
						</tr>
					<?php
					}
					?>
				</table></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table></td>
		<td width="11" align="left">&nbsp;</td>
		<td width="1000" align="left" valign="top"><table width="1000" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><div class="Arama"><form action="index.php?sk=107" method="post">
					<?php
					if($GelenMenuId!=""){
					?>
					<input type="hidden" name="MenuID" value="<?php echo $GelenMenuId; ?>">
					<?php
					}
					?>
					<div class="AramaButon">
						<input type="submit" value="" class="AramaButonuURL">
					</div>
					<div class="AramaInput">
						<input type="text" name="AramaIcerigi" class="AramaInputuIci">
					</div>
				</form></div></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
					<td><table width="1000" height="8" align="left" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="203" style="border: 0.5px solid #ff00aa; text-align: center; padding: 10px 0;">
					<a href="index.php?sk=107" style="text-decoration: none; color: #ff00aa;">Fiyata Göre Artan</a></td>
				<td width="10">&nbsp;</td>
				<td width="203" style="border: 0.5px solid #ff00aa; text-align: center; padding: 10px 0;">
					<a href="index.php?sk=108" style="text-decoration: none; color: #ff00aa;">Fiyata Göre Azalan</a></td>
				<td width="10">&nbsp;</td>
				<td width="203" style="border: 0.5px solid #ff00aa; text-align: center; padding: 10px 0;">
					<a href="index.php?sk=109" style="text-decoration: none; color: #ff00aa;">Ada Göre A > Z</a></td>
				<td width="10">&nbsp;</td>
				<td width="203" style="border: 0.5px solid #ff00aa; text-align: center; padding: 10px 0;">
					<a href="index.php?sk=110" style="text-decoration: none; color: #ff00aa;">Ada Göre Z > A</a></td>
				<td width="10">&nbsp;</td>
				<td width="203" style="border: 0.5px solid #ff00aa; text-align: center; padding: 10px 0;">
					<a href="index.php?sk=80" style="text-decoration: none; color: #ff00aa;">Normal</a></td>
			</tr>
				</table></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr><?php
						$UrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE UrunTuru = 'Kolye' AND Durumu = '1' $MenuKosulu $AramaKosulu ORDER BY UrunFiyati ASC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
						$UrunlerSorgusu->execute();
						$UrunSayisi			=	$UrunlerSorgusu->rowCount();
						$UrunKayitlari		=	$UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

						$DonguSayisi			=	1;
						$SutunAdetSayisi		=	4;

	            foreach($UrunKayitlari as $Kayit){
							$UrununToplamYorumSayisi	=	geriDondur($Kayit["YorumSayisi"]);
							$UrununToplamYorumPuani		=	geriDondur($Kayit["ToplamYorumPuani"]);

							if($UrununToplamYorumSayisi>0){
								$PuanHesapla			=	number_format($UrununToplamYorumPuani/$UrununToplamYorumSayisi, 2, ".", "");
							}else{
								$PuanHesapla			=	0;
							}

							if($PuanHesapla==0){
								$PuanResmi	=	"CizgiliBos.png";
							}elseif(($PuanHesapla>0) and ($PuanHesapla<=1)){
								$PuanResmi	=	"CizgiliBirDolu.png";
							}elseif(($PuanHesapla>1) and ($PuanHesapla<=2)){
								$PuanResmi	=	"CizgiliIkiDolu.png";
							}elseif(($PuanHesapla>2) and ($PuanHesapla<=3)){
								$PuanResmi	=	"CizgiliUcDolu.png";
							}elseif(($PuanHesapla>3) and ($PuanHesapla<=4)){
								$PuanResmi	=	"CizgiliDortDolu.png";
							}elseif($PuanHesapla>4){
								$PuanResmi	=	"CizgiliBesDolu.png";
							}
						?>
							<td width="191" valign="top">
								<table width="191" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
									<tr height="40">
										<td align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($Kayit["id"]); ?>"><img src="urunler/kolyeler/<?php echo geriDondur($Kayit["UrunResmi"]); ?>" border="0" width="185" height="247"></a></td>
									</tr>
									<tr height="25">
										<td width="191" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($Kayit["id"]); ?>" style="color: #cc0099; font-weight: bold; text-decoration: none;">Kolye</a></td>
									</tr>
									<tr height="25">
										<td width="191" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($Kayit["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;">
                      <div style="width: 191px; max-width: 191px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo geriDondur($Kayit["UrunAdi"]); ?></div></a></td>
									</tr>
									<tr height="25">
										<td width="191" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($Kayit["id"]); ?>"><img src="resimler/<?php echo $PuanResmi; ?>" border="0"></a></td>
									</tr>
									<tr height="25">
										<td width="191" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($Kayit["id"]); ?>" style="color: #ff6666; font-weight: bold; text-decoration: none;">
                      <?php echo fiyatYaz(geriDondur($Kayit["UrunFiyati"])) . " " . geriDondur($Kayit["ParaBirimi"]); ?></a></td>
									</tr>
								</table>
							</td>
							<?php
							if($DonguSayisi<$SutunAdetSayisi){
							?>
								<td width="10">&nbsp;</td>
							<?php
							}
							?>
						<?php
							$DonguSayisi++;

							if($DonguSayisi>$SutunAdetSayisi){
								echo "</tr><tr>";
								$DonguSayisi	=	1;
							}
            }
					?></tr>
				</table></td>
			</tr>

			<?php
			if($BulunanSayfaSayisi>1){
			?>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr height="50">
				<td align="center"><div class="Sayfalama">
					<div><br></div>
					<div class="SayfalamaNumara">
						<?php
						if($Sayfalama>1){
							echo "<span class='SayfalamaPasif'><a href='index.php?sk=107" . $SayfalamaKosulu . "&page=1'><<</a></span>";
							$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$Sayfalama-1;
							echo "<span class='SayfalamaPasif'><a href='index.php?sk=107" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
						}

						for($SayfalamaIcinSayfaIndexDegeri=$Sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$Sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
							if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
								if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
									echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
								}else{
									echo "<span class='SayfalamaPasif'><a href='index.php?sk=107" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
								}
							}
						}

						if($Sayfalama!=$BulunanSayfaSayisi){
							$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$Sayfalama+1;
							echo "<span class='SayfalamaPasif'><a href='index.php?sk=107" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
							echo "<span class='SayfalamaPasif'><a href='index.php?sk=107" . $SayfalamaKosulu . "&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
						}
						?>
					</div>
				</div></td>
			</tr>
			<?php
			}
			?>
		</table></td>

	</tr>
</table>
