<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID			=	filtrele($_GET["ID"]);
	}else{
		$GelenID			=	"";
	}

	$MenulerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM menuler WHERE id = ? LIMIT 1");
	$MenulerSorgusu->execute([$GelenID]);
	$MenuSayisi		=	$MenulerSorgusu->rowCount();
	$MenuBilgisi	=	$MenulerSorgusu->fetch(PDO::FETCH_ASSOC);

	if($MenuSayisi>0){
?>
<form action="index.php?skd=0&ski=51&ID=<?php echo geriDondur($GelenID); ?>" method="post">
  <table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="70">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Model Güncelle</h3></td>
		</tr>
		<tr height="10">
			<td colspan="2" style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Ürün Türü</td>
					<td width="20">:</td>
					<td width="500"><?php echo geriDondur($MenuBilgisi["UrunTuru"]); ?></td>
				</tr>
				<tr height="40">
					<td width="230">Menü Adı</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="MenuAdi" class="inputs" value="<?php echo geriDondur($MenuBilgisi["MenuAdi"]); ?>"></td>
				</tr>
        <tr height="40">
          <td width="230">Ürün UrunAdedi</td>
          <td width="20">:</td>
          <td width="500"><input type="text" name="UrunAdedi" class="inputs" value="<?php echo geriDondur($MenuBilgisi["UrunSayisi"]); ?>"></td>
        </tr>
				<tr height="40">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><input type="submit" value="Güncelle" class="buttons"></td>
				</tr>
			</table></td>
		</tr>
	</table>
</form>
<?php
	}else{
		header("Location:index.php?skd=0&ski=53");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
