<?php

if(isset($_POST["kargoTakipNo"])){
	$in_kargoTakipNo =	sayilarifiltrele(filtrele($_POST["kargoTakipNo"]));
}else{
	$in_kargoTakipNo =	"";
}

if($in_kargoTakipNo!=""){
	header("Location:https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code=" . $in_kargoTakipNo);
	exit();
}else{
	header("Location:index.php?sk=14");
	exit();
}
?>
