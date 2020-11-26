<?php
if(isset($_SESSION["Yonetici"])){
	if(isset($_GET["ID"])){
		$GelenID			=	filtrele($_GET["ID"]);
	}else{
		$GelenID			=	"";
	}

	$YoneticilerSorgusu		=	$db_baglantisi->prepare("SELECT * FROM yoneticiler WHERE id = ? LIMIT 1");
	$YoneticilerSorgusu->execute([$GelenID]);
	$YoneticilerSayisi		=	$YoneticilerSorgusu->rowCount();
	$YoneticilerBilgisi		=	$YoneticilerSorgusu->fetch(PDO::FETCH_ASSOC);

	if($YoneticilerSayisi>0){
?>
<form action="index.php?skd=0&ski=65&ID=<?php echo geriDondur($GelenID); ?>" method="post">
  <table width="750" align="right" valign="top" border="0" cellpadding="0" cellspacing="0" style="margin-left: 360px;">
    <tr height="70">
      <td style="font-size: 10px;">&nbsp;</td>
    </tr>
		<tr height="70">
			<td width="750" bgcolor="#ff9999" style="color: #262626;" align="left"><h3>&nbsp;Yönetici Bilgilerini Güncelle</h3></td>
		</tr>
		<tr height="10">
			<td style="font-size: 10px;">&nbsp;</td>
		</tr>
		<tr>
			<td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td width="230">Kullanıcı Adı</td>
					<td width="20">:</td>
					<td width="500"><?php echo geriDondur($YoneticilerBilgisi["kullaniciAdi"]); ?></td>
				</tr>
				<tr height="40">
					<td width="230">Şifre</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="Sifre" class="inputs"></td>
				</tr>
        <tr height="40">
          <td width="230">&nbsp;</td>
          <td width="20">&nbsp;</td>
          <td width="500" style="font-size: 13px;"><i>(Yöneticinin şifresini güncellemek istemiyorsanız lütfen şifre alanını boş bırakınız.)</i></td>
        </tr>
				<tr height="40">
					<td width="230">İsim Soyisim</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="IsimSoyisim" class="inputs" value="<?php echo geriDondur($YoneticilerBilgisi["isimSoyisim"]); ?>"></td>
				</tr>
				<tr height="40">
					<td width="230">E-Mail Adresi</td>
					<td width="20">:</td>
					<td width="500"><input type="email" name="EmailAdresi" class="inputs" value="<?php echo geriDondur($YoneticilerBilgisi["email"]); ?>"></td>
				</tr>
				<tr height="40">
					<td width="230">Telefon Numarası</td>
					<td width="20">:</td>
					<td width="500"><input type="text" name="TelefonNumarasi" class="inputs" value="<?php echo geriDondur($YoneticilerBilgisi["telefon"]); ?>" maxlength="11"></td>
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
		header("Location:index.php?skd=0&ski=67");
		exit();
	}
}else{
	header("Location:index.php?skd=1");
	exit();
}
?>
