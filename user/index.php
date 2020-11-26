<?php
session_start(); ob_start();
require_once("ayarlar/ayar.php");
require_once("ayarlar/fonksiyonlar.php");
require_once("ayarlar/sayfalar.php");

if(isset($_REQUEST["sk"])){
  $sk_num =  sayilarifiltrele($_REQUEST["sk"]);
}else{
  $sk_num = 0;
}

if(isset($_REQUEST["page"])){
	$Sayfalama		=	sayilarifiltrele($_REQUEST["page"]);
}else{
	$Sayfalama			=	1;
}

?>
<!doctype html>
<html lang = "tr-TR">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset = utf-8">
<meta http-equiv = "Content-Language" content = "tr">
<meta charset = "utf-8">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="revisit-after" content="7 Days">
<link type="image/png" rel="icon" href="resimler/favi.png">
<title><?php echo geriDondur($siteBasligi); ?></title>
<meta name="description" content="<?php echo geriDondur($siteAciklama); ?>">
<meta name="keywords" content="<?php echo geriDondur($site_keywords); ?>">
<script type="text/javascript" src="frameworks/JQuery/jquery-3.5.1.min.js" language = "javascript"></script>
<script type="text/javascript" src="ayarlar/fonksiyonlar.js" language = "javascript"></script>
<link type="text/css" rel="stylesheet" href="ayarlar/style.css">
</head>
<body>
  <table width = 100% height = 100% align="center" border="0" cellpadding="0" cellspacing="0">
    <tr width="2000" height="100" align="center">
      <td><img src="resimler/kadinlaraozel.png" border=0></td>
    </tr>
    <tr height="110">
      <td>
        <table width = 100% height = "30" align="center" border="0" cellpadding="0" cellspacing="0">
          <tr bgcolor = #ff9999>
            <td>&nbsp;</td>
            <td><a href="index.php"><img src="resimler/isim.png" border="0" style="margin-top:6px; margin-left:0px;"></a></td>
            <?php
					   if(isset($_SESSION["Kullanici"])){
	          ?>
            <td width="20"><a href="index.php?sk=45"><img src="resimler/hesabim.png" border="0" style="margin-top:3px;"></a></td>
            <td width="87" class="menu"><a href="index.php?sk=45">Hesabım</a></td>
            <td width="18"><a href="index.php?sk=46"><img src="resimler/cikis.png" border="0" style="margin-top:4px;"></a></td>
            <td width="80" class="menu"><a href="index.php?sk=46">Çıkış Yap</a></td>
              <?php
  					}else{
  					?>
            <td width="20"><a href="index.php?sk=30"><img src="resimler/girisyap.png" border="0" style="margin-top:3px;"></a></td>
              <td width="100" class="menu"><a href="index.php?sk=30">Giriş Yap</a></td>
              <td width="18"><a href="index.php?sk=22"><img src="resimler/uyeol.png" border="0" style="margin-top:4px;"></a></td>
              <td width="80" class="menu"><a href="index.php?sk=22">Üye Ol</a></td>
            <?php
            }
            ?>
            <td width="25"><?php if(isset($_SESSION["Kullanici"])){ ?><a href="index.php?sk=93"><img src="resimler/sepet.png" border="0" style="margin-top:3px;"></a></td>
            <?php }else{ ?><a href="index.php?sk=30"><img src="resimler/sepet.png" border="0" style="margin-top: 5px;"><?php } ?></a></td>
            <td width="140" class="menu"><?php if(isset($_SESSION["Kullanici"])){ ?><a href="index.php?sk=93">Alışveriş Sepeti</a><?php }else{ ?><a href="index.php?sk=30">Alışveriş Sepeti<?php } ?></a></td>
          </tr>
        </table>
        <table width = "1840" height = "80" align = "center" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="500"><a href = "index.php"><img src="resimler/<?php echo geriDondur($siteLogo); ?>" border="0" style="margin-left: 20px;"></a></td>
          <td>
            <table width="1700" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="350" valign="middle" align="right" class = "anaMenu"><a href ="index.php">Anasayfa</a></td>
                <td width="90">&nbsp;</td>
                <td width="150" valign="middle" class = "anaMenu"><a href="index.php?sk=80">Kolye</a></td>
                <td width="150" valign="middle" class = "anaMenu"><a href="index.php?sk=81">Küpe</a></td>
                <td width="170" valign="middle" class = "anaMenu"><a href="index.php?sk=82">Bileklik</a></td>
                <td width="150" valign="middle" class = "anaMenu"><a href="index.php?sk=83">Yüzük</a></td>
                <td width="150" valign="middle" class = "anaMenu"><a href="index.php?sk=84">Saat</a></td>
                <td width="480" valign="middle" class = "anaMenu"><a href="index.php?sk=85">Gözlük</a></td>
              </tr>
            </table>
          </td>
        </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="font-size:0.5px;"><hr></td>
    </tr>
    <tr>
      <td style="font-size:50px;"><br></td>
    </tr>
    <tr>
      <td valign = "middle">
        <table width = 100% height = "80" align = "center" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center">
              <?php
                if((!$sk_num) or ($sk_num=="") or ($sk_num==0)){
                  include($sKodu[0]);
                }else{
                  include($sKodu[$sk_num]);
                }
               ?><br>
            </td>
          </tr>
        </table>
      </td>
      <tr>
        <td style="font-size:50px;"><br></td>
      </tr>
      <tr>
        <td style="font-size:0.5px;"><hr></td>
      </tr>
      <tr>
        <td style="font-size:15px;"><br></td>
      </tr>
    <tr height="210">
      <td>
        <table width = "1100" height = "80" align = "center" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffe6ff">
          <tr height = "30">
            <td width = "255" style="border-bottom: 1px dashed #ff99ff;"><b>&nbsp;&nbsp;Kurumsal</b></td>
            <td width = "20" style="border-bottom: 1px dashed #ff99ff;">&nbsp;</td>
            <td width = "255" style="border-bottom: 1px dashed #ff99ff;"><b>Üyelik & Hizmetler</b></td>
            <td width = "20" style="border-bottom: 1px dashed #ff99ff;">&nbsp;</td>
            <td width = "255" style="border-bottom: 1px dashed #ff99ff;"><b>Sözleşmeler</b></td>
            <td width = "20" style="border-bottom: 1px dashed #ff99ff;">&nbsp;</td>
            <td width = "255" style="border-bottom: 1px dashed #ff99ff;"><b>Bizi Takip Edin</b></td>
          </tr>
          <tr height = "30">
            <td class = "footer">&nbsp;&nbsp;<a href="index.php?sk=1">Hakkımızda</a></td>
            <td>&nbsp;</td>

            <?php
             if(isset($_SESSION["Kullanici"])){
            ?>
            <td class = "footer"><a href="index.php?sk=45">Hesabım</a></td>
            <?php
					     }else{
					  ?>
            <td class = "footer"><a href="index.php?sk=30">Giriş Yap</a></td>
            <?php
				    	}
					  ?>
            <td>&nbsp;</td>
            <td class = "footer"><a href="index.php?sk=2">Üyelik Sözleşmesi</a></td>
            <td width = "20">&nbsp;</td>
            <td><table width = "255" height = "" align = "center" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width = "20"><a href="<?php echo geriDondur($facebook); ?>"target="_blank"><img src="resimler/face.png" border = "0"; style="margin-top:3px;"></a></td>
                <td width = "235" class = "footer"><a href="<?php echo geriDondur($facebook); ?>"target="_blank">Facebook</a></td>
            </table></td>
            </tr></tr>
          <tr height = "30">
            <td class = "footer">&nbsp;&nbsp;<a href="index.php?sk=8">Hesap Numaralarımız</a></td>
            <td width = "20">&nbsp;</td>
            <?php
    					if(isset($_SESSION["Kullanici"])){
    				?>
            <td class = "footer"><a href="index.php?sk=46">Çıkış Yap</a></td>
            <?php
  					  }else{
  					?>
            <td class = "footer"><a href="index.php?sk=22">Üye Ol</a></td>
            <?php
					   }
					  ?>
            <td width = "20">&nbsp;</td>
            <td class = "footer"><a href="index.php?sk=3">Kullanım Koşulları</a></td>
            <td width = "20">&nbsp;</td>
            <td> <table width = "255" height = "" align = "center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width = "20"><a href="<?php echo geriDondur($instagram); ?>"target="_blank"><img src="resimler/insta.png" border = "0"; style="margin-top:3px;"></a></td>
                  <td width = "235" class = "footer"><a href="<?php echo geriDondur($instagram); ?>"target="_blank">Instagram</a></td>
              </table></td>
            </tr></tr>
          <tr height = "30">
            <td class = "footer">&nbsp;&nbsp;<a href="index.php?sk=9">Havale Bildirim Formu</a></td>
            <td>&nbsp;</td>
            <td class = "footer"><a href="index.php?sk=21">Sıkça Sorulan Sorular</a></td>
            <td>&nbsp;</td>
            <td class = "footer"><a href="index.php?sk=4">Gizlilik Sözleşmesi</a></td>
            <td width = "20">&nbsp;</td>
            <td><table width = "255" height = "" align = "center" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width = "20"><a href="<?php echo geriDondur($twitter); ?>" target="_blank"><img src="resimler/twitter.png" border = "0"; style="margin-top:3px;"></a></td>
                <td width = "235" class = "footer"><a href="<?php echo geriDondur($twitter); ?>"target="_blank">Twitter</a></td>
            </table></td>
          </tr></tr>
          <tr height = "30">
            <td class = "footer">&nbsp;&nbsp;<a href="index.php?sk=14">Kargom Nerede?</a></td>
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
            <td class = "footer"><a href="index.php?sk=5">Mesafeli Satış Sözleşmesi</a></td>
            <td width = "20">&nbsp;</td>
          </tr>
          <tr height = "30">
            <td class = "footer">&nbsp;&nbsp;<a href="index.php?sk=16">İletişim</a></td>
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
            <td height = "25" class = "footer"><a href="index.php?sk=6">Teslimat</a></td>
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
          </tr>
          <tr height = "30">
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
            <td width = "20">&nbsp;</td>
            <td class = "footer"><a href="index.php?sk=7">İptal & İade & Değişim</a></td>
            <td width = "20">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr height="30">
      <td>
        <table width = "1065" height = "20" align = "center" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align = "center" style="font-size:13px;"><?php echo geriDondur($siteCR); ?></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr height="30">
    			<td><table width="1065" height="25" align="center" border="0" cellpadding="0" cellspacing="0">
    				<tr>
    					<td align="center">
                <img src="resimler/RapidSSL32x12.png" border="0" style="margin-right:5px;">
                <img src="resimler/InternetteGuvenliAlisveris28x12.png" border="0" style="margin-right: 5px;">
                <img src="resimler/3DSecure14x12.png" border="0" style="margin-right:5px;">
                <img src="resimler/BonusCard41x12.png" border="0" style="margin-right: 5px;">
                <img src="resimler/MaximumCard46x12.png" border="0" style="margin-right:5px;">
                <img src="resimler/WorldCard48x12.png" border="0" style="margin-right: 5px;">
                <img src="resimler/CardFinans78x12.png" border="0" style="margin-right:5px;">
                <img src="resimler/AxessCard46x12.png" border="0" style="margin-right: 5px;">
                <img src="resimler/ParafCard19x12.png" border="0" style="margin-right:5px;">
                <img src="resimler/VisaCard37x12.png" border="0" style="margin-right: 5px;">
                <img src="resimler/MasterCard21x12.png" border="0" style="margin-right:5px;">
                <img src="resimler/AmericanExpiress20x12.png" border="0"></td>
    				</tr>
    			</table></td>
    		</tr>
  </table>
</body>
</html>
<?php
$db_baglantisi = null;
ob_end_flush();
?>
