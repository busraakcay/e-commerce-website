<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_REQUEST["AramaIcerigi"])){
		$GelenAramaIcerigi	=	filtrele($_REQUEST["AramaIcerigi"]);
		$AramaKosulu		=	 " AND (EmailAdresi LIKE '%" . $GelenAramaIcerigi . "%' OR IsimSoyisim LIKE '%" . $GelenAramaIcerigi . "%' OR TelefonNumarasi LIKE '%" . $GelenAramaIcerigi . "%' ) ";
		$SayfalamaKosulu	=	"&AramaIcerigi=" . $GelenAramaIcerigi;
	}else{
		$AramaKosulu		=	"";
		$SayfalamaKosulu	=	"";
	}

	$SayfalamaIcinSolVeSagButonSayisi		=	2;
	$SayfaBasinaGosterilecekKayitSayisi		=	10;
	$ToplamKayitSayisiSorgusu				=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE SilinmeDurumu = ? $AramaKosulu ORDER BY id DESC");
	$ToplamKayitSayisiSorgusu->execute([0]);
	$ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
	$SayfalamayaBaslanacakKayitSayisi		=	($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
	$BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="100">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Üyeler</h3></td>
		<td width="200" bgcolor="#ff9999" align="right"><a href="index.php?skd=0&ski=72" style="color: #262626; text-decoration: none;">Silinen Üyelere Geç&nbsp;</a></td>
	</tr>
	<tr height="10">
		<td colspan="2" style="font-size: 10px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td><div class="Arama"><form action="index.php?skd=0&ski=71" method="post">
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
	$UyelerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE SilinmeDurumu = ? $AramaKosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
	$UyelerSorgusu->execute([0]);
	$UyelerSayisi		=	$UyelerSorgusu->rowCount();
	$UyelerKayitlari	=	$UyelerSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($UyelerSayisi>0){
		foreach($UyelerKayitlari as $Uyeler){
	?>
			<tr height="80">
				<td colspan="2" style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="30">
						<td width="85"><b>Adı Soyadı</b></td>
						<td width="10"><b>:</b></td>
						<td width="150"><?php echo geriDondur($Uyeler["IsimSoyisim"]); ?></td>
						<td width="90"><b>E-Mail</b></td>
						<td width="10"><b>:</b></td>
						<td width="200"><?php echo geriDondur($Uyeler["EmailAdresi"]); ?></td>
						<td width="70"><b>Telefon</b></td>
						<td width="10"><b>:</b></td>
						<td width="95"><?php echo geriDondur($Uyeler["TelefonNumarasi"]); ?></td>
					</tr>
					<tr height="30">
						<td><b>Cinsiyet</b></td>
						<td><b>:</b></td>
						<td><?php echo geriDondur($Uyeler["Cinsiyet"]); ?></td>
						<td><b>Kayıt Tarihi</b></td>
						<td><b>:</b></td>
						<td><?php echo  tarihCevir(geriDondur($Uyeler["KayitTarihi"])); ?></td>
						<td><b>Kayıt IP</b></td>
						<td><b>:</b></td>
						<td><?php echo geriDondur($Uyeler["KayitIpAdresi"]); ?></td>
					</tr>
					<tr>
						<td colspan="9" align="right"><table width="95" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="40">&nbsp;</td>
								<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=73&ID=<?php echo geriDondur($Uyeler["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 1px;"></a></td>
								<td width="30" align="left"><a href="index.php?skd=0&ski=73&ID=<?php echo geriDondur($Uyeler["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=71" . $SayfalamaKosulu . "&page=1'><<</a></span>";
						$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$Sayfalama-1;
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=71" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
					}

					for($SayfalamaIcinSayfaIndexDegeri=$Sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$Sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
						if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
							if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
								echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
							}else{
								echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=71" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
							}
						}
					}

					if($Sayfalama!=$BulunanSayfaSayisi){
						$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$Sayfalama+1;
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=71" . $SayfalamaKosulu . "&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=71" . $SayfalamaKosulu . "&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
					<td width="750">Kayıtlı üye bulunmamaktadır.</td>
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
