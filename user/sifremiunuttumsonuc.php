<?php
if(isset($_POST["EmailAdresi"])){
	$GelenEmailAdresi		=	filtrele($_POST["EmailAdresi"]);
}else{
	$GelenEmailAdresi		=	"";
}

if(($GelenEmailAdresi!="")){
	$KontrolSorgusu		=	$db_baglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi = ? AND SilinmeDurumu = ?");
	$KontrolSorgusu->execute([$GelenEmailAdresi, 0]);
	$KullaniciSayisi	=	$KontrolSorgusu->rowCount();
	$KullaniciKaydi		=	$KontrolSorgusu->fetch(PDO::FETCH_ASSOC);

	if($KullaniciSayisi>0){
			header("Location:index.php?sk=39");
			exit();
	}else{
		header("Location:index.php?sk=37");
		exit();
	}
}else{
	header("Location:index.php?sk=38");
	exit();
}
?>
