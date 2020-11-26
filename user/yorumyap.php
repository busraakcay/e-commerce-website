<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["UrunID"])){
		$GelenUrunID	=	filtrele($_GET["UrunID"]);
	}else{
		$GelenUrunID	=	"";
	}

	if($GelenUrunID!=""){
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="1065" valign="top">
			<form action="index.php?sk=73&UrunID=<?php echo $GelenUrunID; ?>" method="post">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color:#ff6666"><h3>Yorum Yap</h3></td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Ürün Hakkındaki Yorumunu Bizimle Paylaş!</i></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left"><b>Değerlendirin!</b></td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><table width="360" align="left" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="64"><img src="resimler/cicekbir.png" border="0"></td>
								<td width="10">&nbsp;</td>
								<td width="64"><img src="resimler/cicekiki.png" border="0"></td>
								<td width="10">&nbsp;</td>
								<td width="64"><img src="resimler/cicekuc.png" border="0"></td>
								<td width="10">&nbsp;</td>
								<td width="64"><img src="resimler/cicekdort.png" border="0"></td>
								<td width="10">&nbsp;</td>
								<td width="64"><img src="resimler/cicekbes.png" border="0"></td>
							</tr>
							<tr>
								<td width="64" align="center"><input type="radio" name="Puan" value="1"></td>
								<td width="10">&nbsp;</td>
								<td width="64" align="center"><input type="radio" name="Puan" value="2"></td>
								<td width="10">&nbsp;</td>
								<td width="64" align="center"><input type="radio" name="Puan" value="3"></td>
								<td width="10">&nbsp;</td>
								<td width="64" align="center"><input type="radio" name="Puan" value="4"></td>
								<td width="10">&nbsp;</td>
								<td width="64" align="center"><input type="radio" name="Puan" value="5"></td>
							</tr>
						</table></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left"><b>Yorumunuzu Belirtin!</b></td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><textarea name="Yorum" class="yorumTextAreas"></textarea></td>
					</tr>
					<tr height="40">
						<td colspan="2" align="center"><input type="submit" value="Gönder" class="buttons"></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<?php
	}else{
		header("Location:index.php?sk=75");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
