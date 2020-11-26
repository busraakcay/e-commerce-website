<table width="1065" align="center" border ="0"  cellpadding="0" cellspacing="0">
  <tr height="50" bgcolor = "#ff9999">
    <td align = "left"><h3 style="color: white;">&nbsp;&nbsp;BANKA HESAPLARIMIZ</h3></td>
  </tr>
  <tr height="50">
    <td align="left" style="border-bottom: 1px dashed #ff00aa;"><i>&nbsp;Ödemeleriniz İçin Çalışmakta Olduğumuz Tüm Bankalar...</i></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td><table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr><?php
        $bank_sorgusu = $db_baglantisi->prepare("SELECT * FROM bankahesaplari");
        $bank_sorgusu->execute();
        $bank_num = $bank_sorgusu->rowCount();
        $bank = $bank_sorgusu->fetchAll(PDO::FETCH_ASSOC);

        $dongu_num = 1;
        $sutun_num = 3;

    foreach($bank as $kayit){
    ?>
      <td width="348">
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #ff80df; margin-bottom: 10px;">
          <tr height="40">
            <td colspan="4" align="center"><img src="resimler/<?php echo geriDondur($kayit["bankaLogo"]); ?>" border="0"></td>
          </tr>
          <tr height="25">
            <td width="5">&nbsp;</td>
            <td width="80"><b>Banka Adı</b></td>
            <td width="10"><b>:</b></td>
            <td width="253"><?php echo geriDondur($kayit["bankaAdi"]); ?></td>
          </tr>
          <tr height="25">
            <td width="5">&nbsp;</td>
            <td><b>Konum</b></td>
            <td><b>:</b></td>
            <td><?php echo geriDondur($kayit["konumSehir"]); ?> / <?php echo geriDondur($kayit["konumUlke"]); ?></td>
          </tr>
          <tr height="25">
            <td width="5">&nbsp;</td>
            <td><b>Şube</b></td>
            <td><b>:</b></td>
            <td><?php echo geriDondur($kayit["subeAdi"]); ?> / <?php echo geriDondur($kayit["subeKodu"]); ?></td>
          </tr>
          <tr height="25">
            <td width="5">&nbsp;</td>
            <td><b>Birim</b></td>
            <td><b>:</b></td>
            <td><?php echo geriDondur($kayit["paraBirimi"]); ?></td>
          </tr>
          <tr height="25">
            <td width="5">&nbsp;</td>
            <td><b>Hesap Adı</b></td>
            <td><b>:</b></td>
            <td><?php echo geriDondur($kayit["hesapSahibi"]); ?></td>
          </tr>
          <tr height="25">
            <td width="5">&nbsp;</td>
            <td><b>Hesap No</b></td>
            <td><b>:</b></td>
            <td><?php echo geriDondur($kayit["hesapNum"]); ?></td>
          </tr>
          <tr height="25">
            <td width="5">&nbsp;</td>
            <td><b>IBAN No</b></td>
            <td><b>:</b></td>
            <td style="font-size: 15px;"><?php echo ibanfiltrele(geriDondur($kayit["ibanNum"])); ?></td>
          </tr>
        </table>
      </td>
      <?php
      if($dongu_num<$sutun_num){
      ?>
        <td width="10">&nbsp;</td>
      <?php
      }
      ?>
    <?php
    $dongu_num++;
        if($dongu_num>$sutun_num){
          echo "</tr><tr>";
          $dongu_num	=	1;
        }
      }
    ?>
  </tr>
</table></td>
</tr>
</table>
