<table width = "1065" align = "center" border = "0" cellpadding ="-0" cellspacing="0">
  <tr>
    <td width = "545" valign="top">
      <table width="545" align = "center" border="0" cellpadding="0" cellspacing="0">
        <tr height="40">
          <td colspan="2" align="left" style="color:#ff6666"><h3>Havale / EFT Süreçleri</h3></td>
        </tr>
        <tr height="5">
				<td colspan="2" height="5" style="font-size: 5px;">&nbsp;</td>
			  </tr>
        <tr height="40">
          <td align="left" width = "30"><img src="resimler/banka.png" border="0"></td>
            <td colspan="2" align="left"><b>Havale / EFT Süreci</b></td>
        </tr>
        <tr height="30">
            <td colspan="2" align="left">Öncelikle banka hesaplarımız
              sayfasında bulunan herhangi bir banka hesabımıza ödeme işlemi gerçekleştirilir.</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="40">
          <td align="left" width = "30"><img src="resimler/kalemlidokuman.png" border="0"></td>
            <td colspan="2" align="left"><b>Bildirme</b></td>
        </tr>
        <tr height="30">
            <td colspan="2" align="left">Ödeme işlemi tamamlandıktan sonra Havale Bildirim Formu
              sayfasından ödeme bildirimini Havale Bildirim Formunu doldurarak form gönderilir.</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="40">
          <td align="left" width = "30"><img src="resimler/cark.png" border="0"></td>
            <td colspan="2" align="left"><b>Kontrol Süreci</b></td>
        </tr>
        <tr height="30">
            <td colspan="2" align="left">Bildirim formunuz tarafımıza ulaştığında ilgili departmanımız
              tarafından yapılan Havale / EFT süreci ilgili banka üzerinden kontrol edilir.</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="40">
          <td align="left" width = "30"><img src="resimler/onay.png" border="0"></td>
            <td colspan="2" align="left"><b>Onay veya Red Süreci</b></td>
        </tr>
        <tr height="30">
            <td colspan="2" align="left">Havale / EFT süreci ile ilgili banka ve yöneticiden, ilgili
              bildirim formunun onayı belirtildiğinde siparişiniz teslimat departmanına iletilir.</td>
        </tr>
        <td colspan="2">&nbsp;</td>
        <tr height="40">
          <td align="left" width = "30"><img src="resimler/saat.png" border="0"></td>
            <td colspan="2" align="left"><b>Siparişin Hazırlanması & Teslimat Süreci</b></td>
        </tr>
        <tr height="30">
            <td colspan="2" align="left">Teslimat departmanımız iletiyi aldıktan sonra siparişiniz
              hazırlanarak kargoya teslim edilir ve tarafınıza ulaştırılır.</td>
        </tr>
      </table>
    </td>
    <td width="20">&nbsp;</td>
    <td width = "500" valign="top">
      <form action="index.php?sk=10" method="post">
      <table width="500" align = "center" border="0" cellpadding="0" cellspacing="0">
        <tr height="40">
          <td style="color:#ff6666"><h3>Havale Bildirim Formu</h3></td>
        </tr>
        <tr height="30">
          <td valign="top" style="border-bottom: 1px dashed #ff00aa;"><i>Tamamlanmış Olan Ödeme İşleminizi Aşağıdaki Formdan İletiniz.</i></td>
        </tr>
        <tr height="30">
          <td valign="bottom" align="left">İsim Soyisim:</td>
          <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
        </tr>
        <tr height="30">
          <td valign="top"><input type="text" name="adSoyad" class="inputs"></td>
        </tr>
        <tr height="30">
          <td valign="bottom" align="left">E-Mail Adresi:</td>
          <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
        </tr>
        <tr height="30">
          <td valign="top"><input type="email" name="email" class="inputs"></td>
        </tr>
        <tr height="30">
          <td valign="bottom" align="left">Telefon Numarası:</td>
          <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
        </tr>
        <tr height="30">
          <td valign="top"><input type="text" name="tel" maxlength="11" class="inputs"></td>
        </tr>
        <tr height="30">
          <td valign="bottom" align="left">Ödeme Yapılan Banka:</td>
          <td valign="bottom" align="left" style="color:red;" style="text-align: right;"><b>*</b></td>
        </tr>
        <tr height="30">
          <td valign="top" align="left">
            <select name="bankasec" class="selects">
              <?php
              $banka_sorgusu = $db_baglantisi->prepare("SELECT * FROM bankahesaplari ORDER BY bankaAdi ASC");
              $banka_sorgusu->execute();
              $banka_num = $banka_sorgusu->rowCount();
              $bankalar = $banka_sorgusu->fetchAll(PDO::FETCH_ASSOC);

              foreach ($bankalar as $values) {
               ?>
              <option value="<?php echo geriDondur($values["id"]); ?>"><?php echo geriDondur($values["bankaAdi"]); ?></option>
            <?php } ?>
            </select>
          </td>
        </tr>
        <tr height="30">
          <td valign="bottom" align="left">Açıklama:</td>
        </tr>
        <tr height="30">
          <td valign="top">
            <textarea name="aciklama" class="textAreas"rows="8" cols="100"></textarea>
          </td>
        </tr>
        <tr height="40">
          <td align="right"><input type="submit" class="buttons" value="Gönder"></td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table>
