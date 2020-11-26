<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID			=	filtrele($_GET["ID"]);
	}else{
		$GelenID			=	"";
	}

	$sssSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sorular WHERE id = ? LIMIT 1");
	$sssSorgusu->execute([$GelenID]);
	$sssSayisi	=	$sssSorgusu->rowCount();
	$sssBilgisi	=	$sssSorgusu->fetch(PDO::FETCH_ASSOC);

	if($sssSayisi>0){
?>
<form action="index.php?skd=0&ski=39&ID=<?php echo geriDondur($GelenID); ?>" method="post">
  <table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="250">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Sıkça Sorulan Sorular</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Soru</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="Soru" class="inputs" value="<?php echo geriDondur($sssBilgisi["soru"]); ?>"></td>
				</tr>
				<tr>
					<td width="230" valign="top">Cevap</td>
					<td width="20" valign="top">:</td>
					<td width="500"><textarea name="Cevap" class="textAreas"><?php echo geriDondur($sssBilgisi["cevap"]); ?></textarea></td>
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
		header("Location:index.php?skd=0&ski=41");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
