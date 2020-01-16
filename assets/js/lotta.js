function changeSlide(slideNum){
	if (slideNum < 4) {
		slideNum++;
	}
	else{
		slideNum = 1;
	}
	console.log(slideNum);
	$("#slideshow > a").hide();
	$("#slide"+slideNum).fadeIn(1000);
	return slideNum;
}
function changeRadio(now){
	if (!$(now).hasClass("current")) {
		$(".radio label").removeClass("current");
		$(now).addClass("current");
	}
}
var interval;
$(document).ready(function(){
	var slideNo = 2;
	$(window).scroll(function(){
		var x = window.scrollY;
		if( x <= 100){
			$("#nav").css({position: "absolute", top: "100px"});
			$("#small-logo").fadeOut(300);
			//$("#profil-menu").css({position: "absolute", top: "130px"});
		}
		else {
			$("#nav").css({position: "fixed", top: "0"});
			$("#small-logo").fadeIn(300);
			//$("#profil-menu").css({position: "fixed", top: "30px"});
		}
	})
	$(".promo img").each(function(){
		var h = $(this).height();
		var w = $(this).width();
		if (h <= w) {
			$(this).height("100%");
			$(this).width("auto");
		}
		else{
			$(this).width("100%");	
			$(this).height("auto");
		}
	})
	$("#slideBtn").change(function(){
		slideNo = changeSlide(slideNo);
	})
	interval = window.setInterval(function(){
			$("#slideBtn"+slideNo).click();
		}, 5000);
	$("#slideshow").mouseout(function(){
		interval = window.setInterval(function(){
			$("#slideBtn"+slideNo).click();
		}, 5000);
	})
	$("#slideshow").mouseover(function(){
		clearInterval(interval);
	})
	$("textarea").keyup(function(){
		var h = $(this).height();
		$(this).height(1+"px");
		console.log($(this).get());
		var nh = $(this).get()[0].scrollHeight;
		x = h + nh;
		$(this).height(nh+"px");
	})
})