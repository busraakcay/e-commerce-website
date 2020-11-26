<?php
if(isset($_SESSION["Yonetici"])){
	$SayfalamaIcinSolVeSagButonSayisi		=	2;
	$SayfaBasinaGosterilecekKayitSayisi		=	10;
	$ToplamKayitSayisiSorgusu				=	$db_baglantisi->prepare("SELECT * FROM yorumlar ORDER BY id DESC");
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
		<td width="560" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yorumlar</h3></td>
	</tr>
	<tr height="10">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$YorumlarSorgusu		=	$db_baglantisi->prepare("SELECT * FROM yorumlar ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
	$YorumlarSorgusu->execute([0]);
	$YorumlarSayisi		=	$YorumlarSorgusu->rowCount();
	$YorumlarKayitlari	=	$YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($YorumlarSayisi>0){
		foreach($YorumlarKayitlari as $Yorumlar){
			if(geriDondur($Yorumlar["Puan"]) == "1"){
				$PuanResmi	=	"cicekbir.png";
			}elseif(geriDondur($Yorumlar["Puan"]) == "2"){
				$PuanResmi	=	"cicekiki.png";
			}elseif(geriDondur($Yorumlar["Puan"]) == "3"){
				$PuanResmi	=	"cicekuc.png";
			}elseif(geriDondur($Yorumlar["Puan"]) == "4"){
				$PuanResmi	=	"cicekdort.png";
			}elseif(geriDondur($Yorumlar["Puan"]) == "5"){
				$PuanResmi	=	"cicekbes.png";
			}
	?>
			<tr>
				<td style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="685"><img src="../resimler/<?php echo $PuanResmi ?>" border="0"></td>
						<td width="10">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><?php echo geriDondur($Yorumlar["YorumMetni"]); ?></td>
					</tr>
					<tr>
						<td width="55"><table width="55" align="right" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=80&ID=<?php echo geriDondur($Yorumlar["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 5px;"></a></td>
								<td width="30" align="left"><a href="index.php?skd=0&ski=80&ID=<?php echo geriDondur($Yorumlar["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
			<td>&nbsp;</td>
		</tr>
		<tr height="50">
			<td align="center"><div class="Sayfalama">
				<div><br></div>
				<div class="SayfalamaNumara">
					<?php
					if($Sayfalama>1){
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=79&page=1'><<</a></span>";
						$SayfalamaIcinSayfaDegeriniBirGeriAl	=	$Sayfalama-1;
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=79&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
					}

					for($SayfalamaIcinSayfaIndexDegeri=$Sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$Sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
						if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
							if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
								echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
							}else{
								echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=79&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
							}
						}
					}

					if($Sayfalama!=$BulunanSayfaSayisi){
						$SayfalamaIcinSayfaDegeriniBirIleriAl	=	$Sayfalama+1;
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=79&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
						echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=79&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="750">Kayıtlı yorum bulunmamaktadır.</td>
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
