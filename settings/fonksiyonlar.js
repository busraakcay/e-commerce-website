$(document).ready(function(){
  $.cevapAc	=	function(IDs){
    var soruID			=	IDs;
    var kaydir		=	"#" + IDs;
    $(".cevap").slideUp();
    $(kaydir).parent().find(".cevap").slideToggle();
  }

  $.kartsecilince			=	function(){
  $(".eftyle").css("display", "none");
  $(".kartla").css("display", "block");
  }

  $.eftsecilince			=	function(){
  $(".kartla").css("display", "none");
  $(".eftyle").css("display", "block");
  }

});
