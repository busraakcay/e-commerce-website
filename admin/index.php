<?php
session_start(); ob_start();
require_once("../ayarlar/ayar.php");
require_once("../ayarlar/fonksiyonlar.php");
require_once("../ayarlar/YsayfalarIc.php");
require_once("../ayarlar/YsayfalarDıs.php");

if(isset($_REQUEST["ski"])){
  $ICsk_num =  sayilarifiltrele($_REQUEST["ski"]);
}else{
  $ICsk_num = 0;
}

if(isset($_REQUEST["skd"])){
  $DISsk_num =  sayilarifiltrele($_REQUEST["skd"]);
}else{
  $DISsk_num = 0;
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
<meta name="robots" content="noindex, nofollow, norarchive">
<meta name="googlebot" content="noindex, nofollow, norarchive">
<link type="image/png" rel="icon" href="../resimler/favi.png">
<title><?php echo geriDondur($siteBasligi); ?></title>
<script type="text/javascript" src="../frameworks/JQuery/jquery-3.5.1.min.js" language = "javascript"></script>
<script type="text/javascript" src="../ayarlar/fonksiyonlar.js" language = "javascript"></script>
<link type="text/css" rel="stylesheet" href="../ayarlar/Ystyle.css">
</head>
<body>
  <tablewidth = "1065" height = 100% align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100%">
      <td align="center"><?php
      if(empty($_SESSION["Yonetici"])){
        if((!$DISsk_num) or ($DISsk_num=="") or ($DISsk_num==0)){
          include($sKoduDıs[1]);
        }else{
          include($sKoduDıs[$DISsk_num]);
        }
      }else{
        if((!$DISsk_num) or ($DISsk_num=="") or ($DISsk_num==0)){
          include($sKoduDıs[0]);
        }else{
          include($sKoduDıs[$DISsk_num]);
        }
      }
       ?>
      </td>
    </tr>
  </table>
</body>
</html>
<?php
$db_baglantisi = null;
ob_end_flush();
?>
