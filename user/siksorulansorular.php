<script type = "text/javascript" language = "javascript" src = "fonksiyonlar.js"></script>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr height="50" bgcolor="#ff9999">
			<td align="left"><h3 style="color: white;">&nbsp;SIK SORULAN SORULAR</h3></td>
		</tr>
		<tr height="50">
			<td class="Sonuclar" align="left" style="border-bottom: 1px dashed #ff00aa;">&nbsp;Aklınıza takılabileceğini düşündüğümüz soruları bu sayfada cevapladık.
        Eğer bu sorulardan farklı bir sorunuz varsa lütfen iletişim sayfasından iletiniz.</a> İletişim sayfasına gitmek için <a href="index.php?sk=16"><b>tıklayınız.</b></a></td>
		</tr>
		<tr>
			<td><?php
			$sorular_sorgu		=	$db_baglantisi->prepare("SELECT * FROM sorular");
			$sorular_sorgu->execute();
			$sorular_num			=	$sorular_sorgu->rowCount();
			$sorular		=	$sorular_sorgu->fetchAll(PDO::FETCH_ASSOC);

			foreach($sorular as $soru){
			?>
      <div>
      <div id="<?php echo $soru["id"]; ?>" class="soruBaslik"	onClick="$.cevapAc(<?php echo $soru["id"]; ?>)"><?php echo $soru["soru"]; ?></div>
      <div class="cevap" style="display: none;"><?php echo $soru["cevap"]; ?></div>
    </div>
			<?php
			}
			?>
			</td>
		</tr>
	</table>
