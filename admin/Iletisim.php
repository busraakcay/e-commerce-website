<?php
if(isset($_SESSION["Yonetici"])){
  $SayfalamaIcinSolVeSagButonSayisi		=	2;
  $SayfaBasinaGosterilecekKayitSayisi		=	3;
  $ToplamKayitSayisiSorgusu				=	$db_baglantisi->prepare("SELECT * FROM iletisim ORDER BY id DESC");
  $ToplamKayitSayisiSorgusu->execute([0]);
  $ToplamKayitSayisiSorgusu				=	$ToplamKayitSayisiSorgusu->rowCount();
  $SayfalamayaBaslanacakKayitSayisi		=	($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
  $BulunanSayfaSayisi						=	ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
?>
<table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
  <tr height="120">
    <td style="font-size: 10px;">&nbsp;</td>
  </tr>
	<tr height="70">
		<td bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Mesajlar</h3></td>
	</tr>
	<tr height="10">
		<td style="font-size: 10px;">&nbsp;</td>
	</tr>
	<?php
	$IletisimSorgusu		=	$db_baglantisi->prepare("SELECT * FROM iletisim ORDER BY IslemTarihi ASC LIMIT $SayfalamayaBaslanacakKayitSayisi, $SayfaBasinaGosterilecekKayitSayisi");
	$IletisimSorgusu->execute();
	$IletisimSayisi		=	$IletisimSorgusu->rowCount();
	$IletisimKayitlari	=	$IletisimSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($IletisimSayisi>0){
		foreach($IletisimKayitlari as $Iletisim){
	?>
	<tr>
		<td style="border-bottom: 1px dashed #e6005c;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
			<tr height="40">
				<td align="left" width="250"><b>Adı Soyadı</b></td>
        <td width="10"><b>:</b></td>
        <td width="700"><?php echo geriDondur($Iletisim["isimsoyisim"]); ?></td>
				<td align="right" width="350"><?php echo tarihYaz($Iletisim["islemTarihi"]); ?></td>
			</tr>
      <tr height="30">
        <td width="150"><b>E-Mail</b></td>
        <td width="10"><b>:</b></td>
        <td width="500"><?php echo geriDondur($Iletisim["email"]); ?></td>
      </tr>
      <tr  height="30">
        <td width="150"><b>Telefon</b></td>
        <td width="10"><b>:</b></td>
        <td width="500"><?php echo geriDondur($Iletisim["telefonnum"]); ?></td>
      </tr>
			<tr  height="30">
				<td align="left" width="160"><b>Mesaj</b></td>
        <td width="10"><b>:</b></td>
        <td width="490"><?php echo geriDondur($Iletisim["mesaj"]); ?></td>
			</tr>
			<tr height="20">
				<td colspan="4" align="right"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
					<tr height="20">
						<td width="750">&nbsp;</td>
						<td width="25" valign="top" align="left"><a href="index.php?skd=0&ski=110&ID=<?php echo geriDondur($Iletisim["id"]); ?>"><img src="../resimler/sil.png" border="0" style="margin-top: 2px;"></a></td>
						<td width="25" align="left"><a href="index.php?skd=0&ski=110&ID=<?php echo geriDondur($Iletisim["id"]); ?>" style="color: #646464; text-decoration: none;">Sil</a></td>
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
            echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=109&page=1'><<</a></span>";
            $SayfalamaIcinSayfaDegeriniBirGeriAl	=	$Sayfalama-1;
            echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=109&page=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
          }

          for($SayfalamaIcinSayfaIndexDegeri=$Sayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$Sayfalama+$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++){
            if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
              if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
                echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
              }else{
                echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=109&page=" . $SayfalamaIcinSayfaIndexDegeri . "'> " . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
              }
            }
          }

          if($Sayfalama!=$BulunanSayfaSayisi){
            $SayfalamaIcinSayfaDegeriniBirIleriAl	=	$Sayfalama+1;
            echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=109&page=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
            echo "<span class='SayfalamaPasif'><a href='index.php?skd=0&ski=109&page=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
				<td width="750">Alınan Mesaj bulunmamaktadır.</td>
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
