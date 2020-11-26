<?php
$IP = $_SERVER["REMOTE_ADDR"];
$TS = time();
$zaman = date("d.m.Y H:i:s", $TS);

function geriDondur($dondur){
	$geri_dondur			=	htmlspecialchars_decode($dondur, ENT_QUOTES);
	return $geri_dondur;
}

function PageclearChar($deger){
	$digits = preg_replace("/[^0-9]/", "",$deger);
	return $digits;
}

function hepsinisil_bosluk($deger){
	$bosluksuz = preg_replace("/\s|&nbsp;/", "", $deger);
	return $bosluksuz;
}

function filtrele($filtre){
	$delete_S = trim($filtre);
	$clear_T = strip_tags($delete_S);
	$ineffect = htmlspecialchars($clear_T, ENT_QUOTES);
	return $ineffect;
}

function sayilarifiltrele($filtre){
	$delete_S = trim($filtre);
	$clear_T = strip_tags($delete_S);
	$ineffect = htmlspecialchars($clear_T, ENT_QUOTES);
	$clear_char = PageclearChar($ineffect);
	return $clear_char;
}

function ibanfiltrele($deger){
	$boslukSil		=	trim($deger);
	$hepsiniSil		=	hepsinisil_bosluk($deger);
	$blok_1		=	substr($hepsiniSil, 0, 4);
	$blok_2		=	substr($hepsiniSil, 4, 4);
	$blok_3		=	substr($hepsiniSil, 8, 4);
	$blok_4		=	substr($hepsiniSil, 12, 4);
	$blok_5		=	substr($hepsiniSil, 16, 4);
	$blok_6		=	substr($hepsiniSil, 20, 4);
	$blok_7		=	substr($hepsiniSil, 24, 2);
	$birlestir			=	$blok_1 . " " . $blok_2 . " " . $blok_3 . " " . $blok_4 . " " . $blok_5 . " " . $blok_6 . " " . $blok_7;
	return	$birlestir;
}

function tarihCevir($tarih){
	$cevir	=	date("d.m.Y H:i:s", $tarih);
	return $cevir;
}

function tarihYaz($tarih){
	$cevir	=	date("d.m.Y", $tarih);
	return $cevir;
}

function fiyatYaz($deger){
	$yaz	=	number_format($deger, "2", ".", ",");
	return $yaz;
}

function ArtiUcGun(){
	global $TS;
	$islem			=	$TS+(3*86400);
	$islemson				=	date("d.m.Y", $islem);
	return $islemson;
}

function GunBul($deger){
	$Gun				=	date("d.m.Y", $deger);
	return $Gun;
}
?>
