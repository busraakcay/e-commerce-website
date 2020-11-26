<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="35">
		<td bgcolor="#ff9999" align="center" style="color: #FFFFFF; font-weight: bold;">&nbsp;En Popüler Ürünler</td>
	</tr>
	<tr>
		<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr><?php
				$EnPopulerUrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE Durumu = '1' ORDER BY GoruntulenmeSayisi DESC LIMIT 5");
				$EnPopulerUrunlerSorgusu->execute();
				$EnPopulerUrunSayisi			=	$EnPopulerUrunlerSorgusu->rowCount();
				$EnPopulerUrunKayitlari			=	$EnPopulerUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

				$EnPopulerDonguSayisi			=	1;

				foreach($EnPopulerUrunKayitlari as $EnPopulerUrunSatirlari){
					$EnPopulerUrununTuru		=	geriDondur($EnPopulerUrunSatirlari["UrunTuru"]);
					$EnPopulerUrununFiyati		=	geriDondur($EnPopulerUrunSatirlari["UrunFiyati"]);
					$EnPopulerUrununParaBirimi	=	geriDondur($EnPopulerUrunSatirlari["ParaBirimi"]);


					$EnPopulerUrunFiyatiHesapla	=	$EnPopulerUrununFiyati;

          if($EnPopulerUrununTuru=="Kolye"){
            $EnPopulerUrunResimKlasoru		=	"kolyeler";
          }elseif($EnPopulerUrununTuru=="Küpe"){
            $EnPopulerUrunResimKlasoru		=	"kupeler";
          }elseif($EnPopulerUrununTuru=="Bileklik"){
            $EnPopulerUrunResimKlasoru		=	"bileklikler";
          }elseif($EnPopulerUrununTuru=="Yüzük"){
            $EnPopulerUrunResimKlasoru		=	"yuzukler";
          }elseif($EnPopulerUrununTuru=="Saat"){
            $EnPopulerUrunResimKlasoru		=	"saatler";
          }elseif($EnPopulerUrununTuru=="Gözlük"){
            $EnPopulerUrunResimKlasoru		=	"gozlukler";
          }

					$EnPopulerUrununToplamYorumSayisi	=	geriDondur($EnPopulerUrunSatirlari["YorumSayisi"]);
					$EnPopulerUrununToplamYorumPuani	=	geriDondur($EnPopulerUrunSatirlari["ToplamYorumPuani"]);

					if($EnPopulerUrununToplamYorumSayisi>0){
						$EnPopulerPuanHesapla			=	number_format($EnPopulerUrununToplamYorumPuani/$EnPopulerUrununToplamYorumSayisi, 2, ".", "");
					}else{
						$EnPopulerPuanHesapla			=	0;
					}

					if($EnPopulerPuanHesapla==0){
						$EnPopulerPuanResmi	=	"CizgiliBos.png";
					}elseif(($EnPopulerPuanHesapla>0) and ($EnPopulerPuanHesapla<=1)){
						$EnPopulerPuanResmi	=	"CizgiliBirDolu.png";
					}elseif(($EnPopulerPuanHesapla>1) and ($EnPopulerPuanHesapla<=2)){
						$EnPopulerPuanResmi	=	"CizgiliIkiDolu.png";
					}elseif(($EnPopulerPuanHesapla>2) and ($EnPopulerPuanHesapla<=3)){
						$EnPopulerPuanResmi	=	"CizgiliUcDolu.png";
					}elseif(($EnPopulerPuanHesapla>3) and ($EnPopulerPuanHesapla<=4)){
						$EnPopulerPuanResmi	=	"CizgiliDortDolu.png";
					}elseif($EnPopulerPuanHesapla>4){
						$EnPopulerPuanResmi	=	"CizgiliBesDolu.png";
					}
				?>
					<td width="205" valign="top">
						<table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
							<tr height="40">
								<td align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnPopulerUrunSatirlari["id"]); ?>"><img src="urunler/<?php echo $EnPopulerUrunResimKlasoru; ?>/<?php echo geriDondur($EnPopulerUrunSatirlari["UrunResmi"]); ?>" border="0" width="205" height="273"></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnPopulerUrunSatirlari["id"]); ?>" style="color: #cc0099; font-weight: bold; text-decoration: none;"><?php echo  geriDondur($EnPopulerUrununTuru); ?></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnPopulerUrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo geriDondur($EnPopulerUrunSatirlari["UrunAdi"]); ?></div></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnPopulerUrunSatirlari["id"]); ?>"><img src="resimler/<?php echo $EnPopulerPuanResmi; ?>" border="0"></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnPopulerUrunSatirlari["id"]); ?>" style="color: #ff6666; font-weight: bold; text-decoration: none;"><?php echo fiyatYaz($EnPopulerUrunFiyatiHesapla) . " " . $EnPopulerUrununParaBirimi; ?></a></td>
							</tr>
						</table>
					</td>
					<?php
					if($EnPopulerDonguSayisi<4){
					?>
						<td width="10">&nbsp;</td>
					<?php
					}
					?>
				<?php
					$EnPopulerDonguSayisi++;
				}
			?></tr>
		</table></td>
	</tr>
	<tr height="35">
		<td bgcolor="#ff9999" align="center" style="color: #FFFFFF; font-weight: bold;">&nbsp;En Çok Yorum Alan Ürünler</td>
	</tr>
	<tr>
	  <td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	    <tr><?php
	      $UrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE Durumu = '1' ORDER BY YorumSayisi DESC LIMIT 5");
	      $UrunlerSorgusu->execute();
	      $UrunSayisi			=	$UrunlerSorgusu->rowCount();
	      $UrunKayitlari		=	$UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

	      $DonguSayisi			=	1;

	      foreach($UrunKayitlari as $UrunSatirlari){
	        $UrununTuru		=	geriDondur($UrunSatirlari["UrunTuru"]);
	        $UrununFiyati		=	geriDondur($UrunSatirlari["UrunFiyati"]);
	        $UrununParaBirimi	=	geriDondur($UrunSatirlari["ParaBirimi"]);


	        if($UrununTuru=="Kolye"){
	          $UrunResimKlasoru		=	"kolyeler";
	        }elseif($UrununTuru=="Küpe"){
	          $UrunResimKlasoru		=	"kupeler";
	        }elseif($UrununTuru=="Bileklik"){
	          $UrunResimKlasoru		=	"bileklikler";
	        }elseif($UrununTuru=="Yüzük"){
	          $UrunResimKlasoru		=	"yuzukler";
	        }elseif($UrununTuru=="Saat"){
	          $UrunResimKlasoru		=	"saatler";
	        }elseif($UrununTuru=="Gözlük"){
	          $UrunResimKlasoru		=	"gozlukler";
	        }

	        $UrununToplamYorumSayisi	=	geriDondur($UrunSatirlari["YorumSayisi"]);
	        $UrununToplamYorumPuani	=	geriDondur($UrunSatirlari["ToplamYorumPuani"]);

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
	        <td width="205" valign="top">
	          <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
	            <tr height="40">
	              <td align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>"><img src="urunler/<?php echo $UrunResimKlasoru; ?>/<?php echo geriDondur($UrunSatirlari["UrunResmi"]); ?>" border="0" width="205" height="273"></a></td>
	            </tr>
	            <tr height="25">
	              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>" style="color: #cc0099; font-weight: bold; text-decoration: none;"><?php echo  geriDondur($UrununTuru); ?></a></td>
	            </tr>
	            <tr height="25">
	              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo geriDondur($UrunSatirlari["UrunAdi"]); ?></div></a></td>
	            </tr>
	            <tr height="25">
	              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>"><img src="resimler/<?php echo $PuanResmi; ?>" border="0"></a></td>
	            </tr>
	            <tr height="25">
	              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>" style="color: #ff6666; font-weight: bold; text-decoration: none;"><?php echo fiyatYaz($UrununFiyati) . " " .  $UrununParaBirimi;?></a></td>
	            </tr>
	          </table>
	        </td>
	        <?php
	        if($DonguSayisi<4){
	        ?>
	          <td width="10">&nbsp;</td>
	        <?php
	        }
	        ?>
	      <?php
	        $DonguSayisi++;
	      }
	    ?></tr>
	  </table></td>
	</tr>
	<tr>
		<tr height="35">
			<td bgcolor="#ff9999" align="center" style="color: #FFFFFF; font-weight: bold;">&nbsp;En Çok Beğeni Alan Ürünler</td>
		</tr>
		<tr>
		  <td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		    <tr><?php
		      $UrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE Durumu = '1' ORDER BY ToplamYorumPuani DESC LIMIT 5");
		      $UrunlerSorgusu->execute();
		      $UrunSayisi			=	$UrunlerSorgusu->rowCount();
		      $UrunKayitlari		=	$UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

		      $DonguSayisi			=	1;

		      foreach($UrunKayitlari as $UrunSatirlari){
		        $UrununTuru		=	geriDondur($UrunSatirlari["UrunTuru"]);
		        $UrununFiyati		=	geriDondur($UrunSatirlari["UrunFiyati"]);
		        $UrununParaBirimi	=	geriDondur($UrunSatirlari["ParaBirimi"]);


		        if($UrununTuru=="Kolye"){
		          $UrunResimKlasoru		=	"kolyeler";
		        }elseif($UrununTuru=="Küpe"){
		          $UrunResimKlasoru		=	"kupeler";
		        }elseif($UrununTuru=="Bileklik"){
		          $UrunResimKlasoru		=	"bileklikler";
		        }elseif($UrununTuru=="Yüzük"){
		          $UrunResimKlasoru		=	"yuzukler";
		        }elseif($UrununTuru=="Saat"){
		          $UrunResimKlasoru		=	"saatler";
		        }elseif($UrununTuru=="Gözlük"){
		          $UrunResimKlasoru		=	"gozlukler";
		        }

		        $UrununToplamYorumSayisi	=	geriDondur($UrunSatirlari["YorumSayisi"]);
		        $UrununToplamYorumPuani	=	geriDondur($UrunSatirlari["ToplamYorumPuani"]);

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
		        <td width="205" valign="top">
		          <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
		            <tr height="40">
		              <td align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>"><img src="urunler/<?php echo $UrunResimKlasoru; ?>/<?php echo geriDondur($UrunSatirlari["UrunResmi"]); ?>" border="0" width="205" height="273"></a></td>
		            </tr>
		            <tr height="25">
		              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>" style="color: #cc0099; font-weight: bold; text-decoration: none;"><?php echo  geriDondur($UrununTuru); ?></a></td>
		            </tr>
		            <tr height="25">
		              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo geriDondur($UrunSatirlari["UrunAdi"]); ?></div></a></td>
		            </tr>
		            <tr height="25">
		              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>"><img src="resimler/<?php echo $PuanResmi; ?>" border="0"></a></td>
		            </tr>
		            <tr height="25">
		              <td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($UrunSatirlari["id"]); ?>" style="color: #ff6666; font-weight: bold; text-decoration: none;"><?php echo fiyatYaz($UrununFiyati) . " " .  $UrununParaBirimi;?></a></td>
		            </tr>
		          </table>
		        </td>
		        <?php
		        if($DonguSayisi<4){
		        ?>
		          <td width="10">&nbsp;</td>
		        <?php
		        }
		        ?>
		      <?php
		        $DonguSayisi++;
		      }
		    ?></tr>
		  </table></td>
		</tr>
		<tr>
	<tr height="35">
		<td bgcolor="#ff9999" align="center" style="color: #FFFFFF; font-weight: bold;">&nbsp;En Çok Satılan Ürünler</td>
	</tr>
	<tr>
		<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr><?php
				$EnCokSatanUrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE Durumu = '1' ORDER BY ToplamSatisSayisi DESC LIMIT 5");
				$EnCokSatanUrunlerSorgusu->execute();
				$EnCokSatanUrunSayisi			=	$EnCokSatanUrunlerSorgusu->rowCount();
				$EnCokSatanUrunKayitlari		=	$EnCokSatanUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

				$EnCokSatanDonguSayisi			=	1;

				foreach($EnCokSatanUrunKayitlari as $EnCokSatanUrunSatirlari){
					$EnCokSatanUrununTuru		=	geriDondur($EnCokSatanUrunSatirlari["UrunTuru"]);
					$EnCokSatanUrununFiyati		=	geriDondur($EnCokSatanUrunSatirlari["UrunFiyati"]);
					$EnCokSatanUrununParaBirimi	=	geriDondur($EnCokSatanUrunSatirlari["ParaBirimi"]);

						$EnCokSatanUrunFiyatiHesapla	=	$EnCokSatanUrununFiyati;

					if($EnCokSatanUrununTuru=="Kolye"){
						$EnCokSatanUrunResimKlasoru		=	"kolyeler";
					}elseif($EnCokSatanUrununTuru=="Küpe"){
						$EnCokSatanUrunResimKlasoru		=	"kupeler";
					}elseif($EnCokSatanUrununTuru=="Bileklik"){
						$EnCokSatanUrunResimKlasoru		=	"bileklikler";
					}elseif($EnCokSatanUrununTuru=="Yüzük"){
						$EnCokSatanUrunResimKlasoru		=	"yuzukler";
					}elseif($EnCokSatanUrununTuru=="Saat"){
						$EnCokSatanUrunResimKlasoru		=	"saatler";
					}elseif($EnCokSatanUrununTuru=="Gözlük"){
						$EnCokSatanUrunResimKlasoru		=	"gozlukler";
					}


					$EnCokSatanUrununToplamYorumSayisi	=	geriDondur($EnCokSatanUrunSatirlari["YorumSayisi"]);
					$EnCokSatanUrununToplamYorumPuani	=	geriDondur($EnCokSatanUrunSatirlari["ToplamYorumPuani"]);

					if($EnCokSatanUrununToplamYorumSayisi>0){
						$EnCokSatanPuanHesapla			=	number_format($EnCokSatanUrununToplamYorumPuani/$EnCokSatanUrununToplamYorumSayisi, 2, ".", "");
					}else{
						$EnCokSatanPuanHesapla			=	0;
					}

					if($EnCokSatanPuanHesapla==0){
						$EnCokSatanPuanResmi	=	"CizgiliBos.png";
					}elseif(($EnCokSatanPuanHesapla>0) and ($EnCokSatanPuanHesapla<=1)){
						$EnCokSatanPuanResmi	=	"CizgiliBirDolu.png";
					}elseif(($EnCokSatanPuanHesapla>1) and ($EnCokSatanPuanHesapla<=2)){
						$EnCokSatanPuanResmi	=	"CizgiliIkiDolu.png";
					}elseif(($EnCokSatanPuanHesapla>2) and ($EnCokSatanPuanHesapla<=3)){
						$EnCokSatanPuanResmi	=	"CizgiliUcDolu.png";
					}elseif(($EnCokSatanPuanHesapla>3) and ($EnCokSatanPuanHesapla<=4)){
						$EnCokSatanPuanResmi	=	"CizgiliDortDolu.png";
					}elseif($EnCokSatanPuanHesapla>4){
						$EnCokSatanPuanResmi	=	"CizgiliBesDolu.png";
					}
				?>
					<td width="205" valign="top">
						<table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
							<tr height="40">
								<td align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnCokSatanUrunSatirlari["id"]); ?>"><img src="urunler/<?php echo $EnCokSatanUrunResimKlasoru; ?>/<?php echo geriDondur($EnCokSatanUrunSatirlari["UrunResmi"]); ?>" border="0" width="205" height="273"></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnCokSatanUrunSatirlari["id"]); ?>" style="color: #cc0099; font-weight: bold; text-decoration: none;"><?php echo  geriDondur($EnCokSatanUrununTuru); ?></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnCokSatanUrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo geriDondur($EnCokSatanUrunSatirlari["UrunAdi"]); ?></div></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnCokSatanUrunSatirlari["id"]); ?>"><img src="resimler/<?php echo $EnCokSatanPuanResmi; ?>" border="0"></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnCokSatanUrunSatirlari["id"]); ?>" style="color: #ff6666; font-weight: bold; text-decoration: none;"><?php echo fiyatYaz($EnCokSatanUrunFiyatiHesapla) . " " . $EnCokSatanUrununParaBirimi;?></a></td>
							</tr>
						</table>
					</td>
					<?php
					if($EnCokSatanDonguSayisi<4){
					?>
						<td width="10">&nbsp;</td>
					<?php
					}
					?>
				<?php
					$EnCokSatanDonguSayisi++;
				}
			?></tr>
		</table></td>
	</tr>
	<tr height="35">
		<td bgcolor="#ff9999" align="center" style="color: #FFFFFF; font-weight: bold;">&nbsp;En Yeni Ürünler</td>
	</tr>
	<tr>
		<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr><?php
				$EnYeniUrunlerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE Durumu = '1' ORDER BY id DESC LIMIT 5");
				$EnYeniUrunlerSorgusu->execute();
				$EnYeniUrunSayisi			=	$EnYeniUrunlerSorgusu->rowCount();
				$EnYeniUrunKayitlari		=	$EnYeniUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

				$EnYeniDonguSayisi			=	1;

				foreach($EnYeniUrunKayitlari as $EnYeniUrunSatirlari){
					$EnYeniUrununTuru		=	geriDondur($EnYeniUrunSatirlari["UrunTuru"]);
					$EnYeniUrununFiyati		=	geriDondur($EnYeniUrunSatirlari["UrunFiyati"]);
					$EnYeniUrununParaBirimi	=	geriDondur($EnYeniUrunSatirlari["ParaBirimi"]);


          if($EnYeniUrununTuru=="Kolye"){
            $EnYeniUrunResimKlasoru		=	"kolyeler";
          }elseif($EnYeniUrununTuru=="Küpe"){
            $EnYeniUrunResimKlasoru		=	"kupeler";
          }elseif($EnYeniUrununTuru=="Bileklik"){
            $EnYeniUrunResimKlasoru		=	"bileklikler";
          }elseif($EnYeniUrununTuru=="Yüzük"){
            $EnYeniUrunResimKlasoru		=	"yuzukler";
          }elseif($EnYeniUrununTuru=="Saat"){
            $EnYeniUrunResimKlasoru		=	"saatler";
          }elseif($EnYeniUrununTuru=="Gözlük"){
            $EnYeniUrunResimKlasoru		=	"gozlukler";
          }

					$EnYeniUrununToplamYorumSayisi	=	geriDondur($EnYeniUrunSatirlari["YorumSayisi"]);
					$EnYeniUrununToplamYorumPuani	=	geriDondur($EnYeniUrunSatirlari["ToplamYorumPuani"]);

					if($EnYeniUrununToplamYorumSayisi>0){
						$EnYeniPuanHesapla			=	number_format($EnYeniUrununToplamYorumPuani/$EnYeniUrununToplamYorumSayisi, 2, ".", "");
					}else{
						$EnYeniPuanHesapla			=	0;
					}

					if($EnYeniPuanHesapla==0){
						$EnYeniPuanResmi	=	"CizgiliBos.png";
					}elseif(($EnYeniPuanHesapla>0) and ($EnYeniPuanHesapla<=1)){
						$EnYeniPuanResmi	=	"CizgiliBirDolu.png";
					}elseif(($EnYeniPuanHesapla>1) and ($EnYeniPuanHesapla<=2)){
						$EnYeniPuanResmi	=	"CizgiliIkiDolu.png";
					}elseif(($EnYeniPuanHesapla>2) and ($EnYeniPuanHesapla<=3)){
						$EnYeniPuanResmi	=	"CizgiliUcDolu.png";
					}elseif(($EnYeniPuanHesapla>3) and ($EnYeniPuanHesapla<=4)){
						$EnYeniPuanResmi	=	"CizgiliDortDolu.png";
					}elseif($EnYeniPuanHesapla>4){
						$EnYeniPuanResmi	=	"CizgiliBesDolu.png";
					}
				?>
					<td width="205" valign="top">
						<table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
							<tr height="40">
								<td align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnYeniUrunSatirlari["id"]); ?>"><img src="urunler/<?php echo $EnYeniUrunResimKlasoru; ?>/<?php echo geriDondur($EnYeniUrunSatirlari["UrunResmi"]); ?>" border="0" width="205" height="273"></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnYeniUrunSatirlari["id"]); ?>" style="color: #cc0099; font-weight: bold; text-decoration: none;"><?php echo  geriDondur($EnYeniUrununTuru); ?></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnYeniUrunSatirlari["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo geriDondur($EnYeniUrunSatirlari["UrunAdi"]); ?></div></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnYeniUrunSatirlari["id"]); ?>"><img src="resimler/<?php echo $EnYeniPuanResmi; ?>" border="0"></a></td>
							</tr>
							<tr height="25">
								<td width="205" align="center"><a href="index.php?sk=79&ID=<?php echo geriDondur($EnYeniUrunSatirlari["id"]); ?>" style="color: #ff6666; font-weight: bold; text-decoration: none;"><?php echo fiyatYaz($EnYeniUrununFiyati) . " " .  $EnYeniUrununParaBirimi;?></a></td>
							</tr>
						</table>
					</td>
					<?php
					if($EnYeniDonguSayisi<4){
					?>
						<td width="10">&nbsp;</td>
					<?php
					}
					?>
				<?php
					$EnYeniDonguSayisi++;
				}
			?></tr>
		</table></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>

</table>
