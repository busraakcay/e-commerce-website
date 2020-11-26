<?php
if(isset($_SESSION["Kullanici"])){
	if(isset($_GET["ID"])){
		$GelenID		=	filtrele($_GET["ID"]);
	}else{
		$GelenID		=	"";
	}

	if($GelenID!=""){

		$FavoriKontrolSorgusu	=	$db_baglantisi->prepare("SELECT * FROM favoriler WHERE UrunId = ? AND UyeId = ? LIMIT 1");
		$FavoriKontrolSorgusu->execute([$GelenID, $KullaniciID]);
		$FavoriKontrolSayisi		=	$FavoriKontrolSorgusu->rowCount();

		if($FavoriKontrolSayisi>0){
			header("Location:index.php?sk=89");
			exit();
		}else{
			$FavoriEklemeSorgusu	=	$db_baglantisi->prepare("INSERT INTO favoriler (UrunId, UyeId) values (?, ?)");
			$FavoriEklemeSorgusu->execute([$GelenID, $KullaniciID]);
			$FavoriEklemeSayisi		=	$FavoriEklemeSorgusu->rowCount();

			if($FavoriEklemeSayisi>0){
				header("Location:index.php?sk=87");
				exit();
			}else{
				header("Location:index.php?sk=88");
				exit();
			}
		}
	}else{
		header("Location:index.php");
		exit();
	}
}else{
	header("Location:index.php");
	exit();
}
?>
