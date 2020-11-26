<?php
if(isset($_POST["adSoyad"])){
  $in_adSoyad = filtrele($_POST["adSoyad"]);
}else{
  $in_adSoyad = "";
}

if(isset($_POST["email"])){
  $in_email = filtrele($_POST["email"]);
}else{
  $in_email = "";
}

if(isset($_POST["tel"])){
  $in_tel = filtrele($_POST["tel"]);
}else{
  $in_tel = "";
}

if(isset($_POST["bankasec"])){
  $in_bankasec = filtrele($_POST["bankasec"]);
}else{
  $in_bankasec = "";
}

if(isset($_POST["aciklama"])){
  $in_aciklama = filtrele($_POST["aciklama"]);
}else{
  $in_aciklama = "";
}

if(($in_adSoyad!="") and ($in_email!="") and ($in_tel!="") and ($in_bankasec!="")){
  $havBil_sorgusu = $db_baglantisi->prepare("INSERT INTO havalebildirimleri (bankaID, adiSoyadi, email, telefon, aciklama, islemTarihi, durum) values (?, ?, ?, ?, ?, ?, ?)");
  $havBil_sorgusu->execute([$in_bankasec, $in_adSoyad, $in_email, $in_tel, $in_aciklama, $TS, 0]);
  $havBil_num = $havBil_sorgusu->rowCount();

  if ($havBil_sorgusu>0) {
    header("Location:index.php?sk=11");
    die();
  }else {
    header("Location:index.php?sk=12");
    die();
  }
}else{
  header("Location:index.php?sk=13");
  die();
}
?>
