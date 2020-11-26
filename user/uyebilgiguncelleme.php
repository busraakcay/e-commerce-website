<?php
if(isset($_SESSION["Kullanici"])){
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="1065" valign="top">
			<form action="index.php?sk=48" method="post">
				<table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color:#ff6666"><h3>Hesap Bilgileriniz</h3></td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Aşağıdan üyelik bilgilerini görüntüleyebilir veya güncelleyebilirsin.</i></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left">E-Mail Adresi</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><input type="email" name="EmailAdresi" class="inputs" value="<?php echo $EmailAdresi; ?>"></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left">Şifre</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><input type="password" name="Sifre" class="inputs" value="EskiSifre"></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left">Şifre Tekrar</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><input type="password" name="SifreTekrar" class="inputs" value="EskiSifre"></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left">İsim Soyisim</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><input type="text" name="IsimSoyisim" class="inputs" value="<?php echo $IsimSoyisim; ?>"></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left">Telefon Numarası</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><input type="text" name="TelefonNumarasi" maxlength="11" class="inputs" value="<?php echo $TelefonNumarasi; ?>"></td>
					</tr>
					<tr height="30">
						<td valign="bottom" align="left">Cinsiyet</td>
					</tr>
					<tr height="30">
						<td valign="top" align="left"><select name="Cinsiyet" class="selects">
							<option value="Erkek" <?php if($Cinsiyet=="Erkek"){ ?>selected="selected"<?php } ?>>Erkek</option>
							<option value="Kadın" <?php if($Cinsiyet=="Kadın"){ ?>selected="selected"<?php } ?>>Kadın</option>
						</select></td>
					</tr>
					<tr height="60">
						<td colspan="2" align="right"><input type="submit" value="Bilgilerimi Güncelle" class="buttons"></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<?php
}else{
	header("Location:index.php");
	exit();
}
?>
