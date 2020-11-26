<?php
if(isset($_SESSION["Kullanici"])){
	$SepettekiUrunlerSorgusu	=	$db_baglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC");
	$SepettekiUrunlerSorgusu->execute([$KullaniciID]);
	$SepettekiUrunSayisi		=	$SepettekiUrunlerSorgusu->rowCount();
	$SepettiKayitlar			=	$SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

	if($SepettekiUrunSayisi>0){
		$SepettekiToplamUrunSayisi			=	0;
		$SepettekiToplamFiyat				=	0;
		$SepettekiToplamKargoFiyati			=	0;
		$SepettekiToplamKargoFiyatiHesapla	=	0;

		foreach($SepettiKayitlar as $SepetSatirlari){
			$SepetIdsi						=	$SepetSatirlari["id"];
			$SepettekiSepetNumarasi			=	$SepetSatirlari["SepetNumarasi"];
			$SepettekiUrununIdsi			=	$SepetSatirlari["UrunId"];
			$SepettekiUrununAdedi			=	$SepetSatirlari["UrunAdedi"];

			$UrunBilgileriSorgusu			=	$db_baglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
			$UrunBilgileriSorgusu->execute([$SepettekiUrununIdsi]);
			$UrunKaydi						=	$UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
				$UrununFiyati			=	$UrunKaydi["UrunFiyati"];
				$UrununParaBirimi		=	$UrunKaydi["ParaBirimi"];
				$UrununKargoUcreti		=	$UrunKaydi["KargoUcreti"];


				$UrunFiyatiHesapla				=	$UrununFiyati;
				$UrunFiyatiBicimlendir			=	fiyatYaz($UrununFiyati);

			$UrunToplamFiyatiHesapla				=	($UrunFiyatiHesapla*$SepettekiUrununAdedi);
			$UrunToplamFiyatiBicimlendir			=	fiyatYaz($UrunToplamFiyatiHesapla);

			$SepettekiToplamUrunSayisi				+=	$SepettekiUrununAdedi;
			$SepettekiToplamFiyat					+=	($UrunFiyatiHesapla*$SepettekiUrununAdedi);

			$SepettekiToplamKargoFiyatiHesapla		+=	($UrununKargoUcreti*$SepettekiUrununAdedi);
			$SepettekiToplamKargoFiyatiBicimlendir	=	fiyatYaz($SepettekiToplamKargoFiyatiHesapla);


		if($SepettekiToplamFiyat>=$ucretsizKargo){
			$SepettekiToplamKargoFiyatiHesapla		=	0;
			$SepettekiToplamKargoFiyatiBicimlendir	=	fiyatYaz($SepettekiToplamKargoFiyatiHesapla);

			$OdenecekToplamTutariBicimlendir		=	fiyatYaz($SepettekiToplamFiyat);
		}else{
			$OdenecekToplamTutariHesapla			=	($SepettekiToplamFiyat+$SepettekiToplamKargoFiyatiHesapla);
			$OdenecekToplamTutariBicimlendir		=	fiyatYaz($OdenecekToplamTutariHesapla);
		}
  }
?>
  <form action="index.php?sk=104" method="post">
	<table width=100% align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="1065" valign="top">
				<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr height="40">
						<td style="color:#ff6666"><h3>Alışveriş Sepeti</h3></td>
					</tr>
					<tr height="30">
						<td valign="top" style="border-bottom: 1px dashed #ff00aa;">Kredi Kartı Bilgilerini Aşağıdan Belirtebilir ve Ödeme Yapabilirsin.</td>
					</tr>
					<tr height="10">
						<td style="font-size: 10px;">&nbsp;</td>
					</tr>
					<tr>
						<td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
							<tr height="40">
								<td width="250">Kredi Kart Numarası:</td>
								<td colspan="4" width="550"><input type="text" name="kartnum" class="inputs"  style="text-align: center;">
							</tr>
							<tr height="40">
								<td>Son Kullanma Tarihi:</td>
								<td width="100"><select name="skt" class="selects">
									<option value=""></option>
									<option value="01">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
								</select></td>
								<td width="20" align="center"> - </td>
								<td width="100"><select name="yil" class="selects">
									<option value=""></option>
									<option value="2013">2013</option>
									<option value="2014">2014</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
									<option value="2019">2019</option>
									<option value="2020">2020</option>
								</select></td>
								<td width="330"></td>
							</tr>
							<tr height="40">
								<td>Kart Türü:</td>
								<td colspan="4"><input type="radio" value="1" name="kartturu"> Visa <input type="radio" value="2" name="kartturu"> MasterCard</td>
							</tr>
							<tr height="40">
								<td>Güvenlik Kodu:</td>
								<td width="100"><input type="text" name="guvenlikkodu" size="4" value="" class="inputs" /></td>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr height="40">
								<td align="center">&nbsp;</td>
								<td colspan="4" align="right"><input type="submit" value="Ödeme Yap" class="buttons" /></td>
							</tr>
						</table></td>
					</tr>
				</table>
			</td>

			<td width="15">&nbsp;</td>

			<td width="250" valign="top"><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr height="40">
					<td  style="color:#ff6666" align="right"><h3>Sipariş Özeti</h3></td>
				</tr>
				<tr height="30">
					<td valign="top" style="border-bottom: 1px dashed #ff00aa; font-size: 18px;" align="right">Toplam <b style="color: #800080;"><?php echo $SepettekiToplamUrunSayisi; ?></b> Adet Ürün</td>
				</tr>
				<tr height="5">
					<td height="5" style="font-size: 5px;">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">Ödenecek Tutar (KDV Dahil)</td>
				</tr>
				<tr>
					<td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
				</tr>
				<tr height="10">
					<td style="font-size: 10px;">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">Ürünler Toplam Tutarı (KDV Dahil)</td>
				</tr>
				<tr>
					<td align="right" style="font-size: 25px; font-weight: bold;"><?php echo fiyatYaz($SepettekiToplamFiyat); ?> TL</td>
				</tr>
				<tr height="10">
					<td style="font-size: 10px;">&nbsp;</td>
				</tr>
				<tr>
					<td align="right">Kargo Tutarı (KDV Dahil)</td>
				</tr>
				<tr>
					<td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $SepettekiToplamKargoFiyatiBicimlendir; ?> TL</td>
				</tr>
			</table></td>
		</tr>
	</table>
</form>
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
