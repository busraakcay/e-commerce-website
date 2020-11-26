<?php
if(isset($_POST["IsimSoyisim"])){
	$inputIsimSoyisim		=	filtrele($_POST["IsimSoyisim"]);
}else{
	$inputIsimSoyisim		=	"";
}

if(isset($_POST["EmailAdresi"])){
	$inputEmailAdresi		=	filtrele($_POST["EmailAdresi"]);
}else{
	$inputEmailAdresi		=	"";
}

if(isset($_POST["TelefonNumarasi"])){
	$inputTelefonNumarasi	=	filtrele($_POST["TelefonNumarasi"]);
}else{
	$inputTelefonNumarasi	=	"";
}

if(isset($_POST["Mesaj"])){
	$inputMesaj				=	filtrele($_POST["Mesaj"]);
}else{
	$inputMesaj				=	"";
}

if(($inputIsimSoyisim!="") and ($inputEmailAdresi!="") and ($inputTelefonNumarasi!="") and ($inputMesaj!="")){
	$iletisim_sorgusu = $db_baglantisi->prepare("INSERT INTO iletisim (isimsoyisim, email, telefonnum, mesaj, islemTarihi) values (?, ?, ?, ?, ?)");
  $iletisim_sorgusu->execute([$inputIsimSoyisim, $inputEmailAdresi, $inputTelefonNumarasi, $inputMesaj, $TS]);
  $iletisim_num = $iletisim_sorgusu->rowCount();

	if ($iletisim_sorgusu>0) {
		header("Location:index.php?sk=18");
		die();
	}else {
		header("Location:index.php?sk=19");
		exit();
	}
}else{
	header("Location:index.php?sk=20");
	exit();
	}
?>
