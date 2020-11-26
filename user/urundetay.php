<?php
if(isset($_GET["ID"])){
$GelenID		=	sayilarifiltrele(filtrele($_GET["ID"]));

$UrunHitiGuncellemeSorgusu	=	$db_baglantisi->prepare("UPDATE urunler SET GoruntulenmeSayisi=GoruntulenmeSayisi+1 WHERE id = ? AND Durumu = ? LIMIT 1");
$UrunHitiGuncellemeSorgusu->execute([$GelenID, 1]);

$UrunSorgusu		=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? AND Durumu = ? LIMIT 1");
$UrunSorgusu->execute([$GelenID, 1]);
$UrunSayisi			=	$UrunSorgusu->rowCount();
$UrunSorgusuKaydi	=	$UrunSorgusu->fetch(PDO::FETCH_ASSOC);

	if($UrunSayisi>0){
    $UrunTuru		=	geriDondur($UrunSorgusuKaydi["UrunTuru"]);
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

			$UrununFiyati		=	geriDondur($UrunSorgusuKaydi["UrunFiyati"]);
			$UrununParaBirimi	=	geriDondur($UrunSorgusuKaydi["ParaBirimi"]);

?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="350" valign="top"><table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td style="border: 1px solid #CCCCCC;" align="center">
          <img src="urunler/<?php echo $ResimKlasoruAdi; ?>/<?php echo geriDondur($UrunSorgusuKaydi["UrunResmi"]); ?>" width="330" height="440" border="0"></td>
			</tr>
			<tr height="5">
				<td style="font-size: 5px;">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
        <td><table width="350" align="center" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px;">
          <tr height="30">
            <td><img src="resimler/saat24.png" border="0" style="margin-bottom: 8px;"></td>
            <td>&nbsp;Siparişiniz en geç <?php echo ArtiUcGun(); ?> tarihine kadar kargoya &nbsp;verilir.</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="30">
            <td><img src="resimler/saat.png" border="0" style="margin-bottom: 8px;"></td>
            <td>&nbsp;Süper hızlı gönderiyle aynı gün teslimat yapılabilir.</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="30">
            <td><img src="resimler/kart.png" border="0" style="margin-bottom: 8px;"></td>
            <td>&nbsp;Tüm bankaların kredi kartları ile peşin veya taksitli &nbsp;ödeme seçeneği.</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr height="30">
            <td><img src="resimler/banka.png" border="0" style="margin-bottom: 8px;"></td>
            <td>&nbsp;Tüm bankalardan havale veya EFT ile ödeme &nbsp;seçeneği.</td>
          </tr>
        </table></td>
      </tr>
			</tr>
		</table></td>

		<td width="10" valign="top">&nbsp;</td>

		<td width="705" valign="top"><table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
      <tr height="50" bgcolor="#ff9999">
        <td style="text-align: left; font-size: 16px; font-weight: bold; color:white;">&nbsp;<?php echo geriDondur($UrunSorgusuKaydi["UrunAdi"]); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
			<tr height="30">
				<td style="background: #ff9999; color: white;">&nbsp;Ürün Açıklaması</td>
			</tr>
			<tr>
				<td><?php echo geriDondur($UrunSorgusuKaydi["UrunAciklamasi"]); ?></td>
			</tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
			<tr height="30">
				<td style="background: #ff9999; color: white;">&nbsp;Ürün Yorumları</td>
			</tr>
			<tr>
				<td><div style="width: 705px; max-width: 705px; height: 350px; max-height: 350px; overflow-y: scroll;"><table width="685" align="left" border="0" cellpadding="0" cellspacing="0">
					<?php
					$YorumlarSorgusu	=	$db_baglantisi->prepare("SELECT * FROM yorumlar WHERE UrunId = ? ORDER BY YorumTarihi DESC");
					$YorumlarSorgusu->execute([geriDondur($UrunSorgusuKaydi["id"])]);
					$YorumSayisi		=	$YorumlarSorgusu->rowCount();
					$YorumKayitlari		=	$YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

					if($YorumSayisi>0){
						foreach($YorumKayitlari as $YorumSatirlari){
							$YorumPuani		=	geriDondur($YorumSatirlari["Puan"]);

							if($YorumPuani==1){
								$YorumPuanResmi		=	"cicekbir.png";
							}elseif($YorumPuani==2){
								$YorumPuanResmi		=	"cicekiki.png";
							}elseif($YorumPuani==3){
								$YorumPuanResmi		=	"cicekuc.png";
							}elseif($YorumPuani==4){
								$YorumPuanResmi		=	"cicekdort.png";
							}elseif($YorumPuani==5){
								$YorumPuanResmi		=	"cicekbes.png";
							}

							$YorumIcinUyeSorgusu	=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE id = ? LIMIT 1");
							$YorumIcinUyeSorgusu->execute([geriDondur($YorumSatirlari["UyeId"])]);
							$YorumIcinUyeKaydi		=	$YorumIcinUyeSorgusu->fetch(PDO::FETCH_ASSOC);
					?>
							<tr height="30">
								<td width="64"><img src="resimler/<?php echo $YorumPuanResmi; ?>" border="0" style="margin-top:5px;"></td>
								<td width="10">&nbsp;</td>
								<td width="451"><?php echo geriDondur($YorumIcinUyeKaydi["IsimSoyisim"]); ?></td>
								<td width="10">&nbsp;</td>
								<td width="150" align="right"><?php echo GunBul(geriDondur($YorumSatirlari["YorumTarihi"])); ?></td>
							</tr>
              <tr>
              </tr>
              <td colspan="5" style="border-bottom: 1px solid #f1f1f1;"></td>
							<tr height="30">
								<td colspan="5" style="border-bottom: 1px dashed #ff00aa;"><?php echo geriDondur($YorumSatirlari["YorumMetni"]); ?></td>
							</tr>
					<?php
						}
					}else{
					?>
					<tr height="30">
						<td>Ürün İçin Henüz Yorum Eklenmemiş.</td>
					</tr>
					<?php
					}
					?>
				</table></div></td>
        <tr>
          <td>&nbsp;</td>
        </tr>
			</tr>
      <tr>
        <td><form action="index.php?sk=90&ID=<?php echo geriDondur($UrunSorgusuKaydi["id"]); ?>" method="post"><table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
          <tr height="45">
            <td width="30"><?php if(isset($_SESSION["Kullanici"])){ ?><a href="index.php?sk=86&ID=<?php echo geriDondur($UrunSorgusuKaydi["id"]); ?>"><img src="resimler/favori.png" border="0" style="margin-top: 5px;"></a>
            <?php }else{ ?><a href="index.php?sk=30"><img src="resimler/favori.png" border="0" style="margin-top: 5px;"><?php } ?></td>
            <td width="10">&nbsp;</td>
            <td width="605"><input type="submit" value="Sepete Ekle" class="SepetButonu"></td>
          </tr>
          <tr height="45">
            <td colspan="3"><table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
              <tr height="45">
                <td width="205" align="right" style="font-size: 25px; color: #595959; font-weight: bold;"><?php echo fiyatYaz($UrununFiyati) . " " . $UrununParaBirimi  ?></td>
              </tr>
            </table></td>
          </tr>
        </table></form></td>
      </tr>
		</table></td>
	</tr>
</table>
<?php
	}else{
		header("Location:index.php");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
