var images=[
"promo-1.png",
"promo-2.png",
"promo-3.png",
"promo-4.png",
"promo-5.png",
"promo-6.png",
"promo-7.png",
"promo-8.png",
"promo-9.png",
"promo-10.png"
];

function slider(container){
var $cnt = $(container);
var $img1 = $cnt.find("#screenshot1");
var $img2 =$cnt.find("#screenshot2");
var $img3 = $cnt.find("#screenshot3");
var $leftarrow =  $cnt.find(".arrow.left");
var $rightarrow =  $cnt.find(".arrow.right");
var currentPosition =0;


var init = function(){
	updatePictures();
	updateArrows();	
	$leftarrow.on('click', function(){
		if (currentPosition > 0){
			currentPosition-=3;
			updatePictures();
			updateArrows();	
		}
	});
	$rightarrow.on('click', function(){
		if (currentPosition + 3 < images.length){
			currentPosition+=3;
			updatePictures();
			updateArrows();	
		}
	});
}

var changePicture = function(img, index){
	if (index < images.length){
		img.attr("src", "images/" + images[index]);
	}else{
		img.attr("src", "");
	}
}
var updatePictures = function(){
	changePicture( $img1, currentPosition);
	changePicture( $img2, currentPosition+1);
	changePicture( $img3, currentPosition+2);
}
var updateArrows = function(){
	if (currentPosition + 3 < images.length){
		enableRightArrow();	
	}else{
		disableRightArrow();
	}
	if (currentPosition== 0 ){
		disableLeftArrow();	
	}else{
		enableLeftArrow();
	}
}
var enableLeftArrow = function(){
	$leftarrow.attr("src", "images/left_arrow_orange.png");
	while ($leftarrow.hasClass("disabled")){	
		$leftarrow.removeClass("disabled");
	}
}
var disableLeftArrow = function(){
	$leftarrow.attr("src", "images/left_arrow_grey.png");
	$leftarrow.addClass("disabled");
}
var enableRightArrow = function(){
	$rightarrow.attr("src", "images/right_arrow_orange.png");
	while ($rightarrow.hasClass("disabled")){	
		$rightarrow.removeClass("disabled");
	}
}
var disableRightArrow = function(){
	$rightarrow.attr("src", "images/right_arrow_grey.png");
	$rightarrow.addClass("disabled");
}
init();

}
