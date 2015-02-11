function slider(container)
{
   var currentIndex=0;
   var timerInMs = 3000;
   var currentOffset = -442;
   var initialOffset = -442;
   var minOffset = -884;
   var offsetStep = 100;
   var slideTimerInMs = 50;
   var slidesContainer = container.find('.slides-control');
   var currentSlide;
   var nextSlide;
   var currentPaginator;
   var nextPaginator;
   var nextSlideOffset = 884;
   var currentSlideOffset = 442;
   
   var init = function(){
		setTimeout(changeSlide, timerInMs);
   }
   
   var changeSlide = function(){
		var nextIndex = currentIndex + 1;
       var slides = container.find('.slide');
       if (currentIndex == slides.length - 1){
				nextIndex = 0;
	   }
	   currentSlide =$(slides[currentIndex]);
	   nextSlide =$(slides[nextIndex]);	   
	   var paginators = container.find('.pagination li');
	   currentPaginator = $(paginators[currentIndex]);
	   nextPaginator =  $(paginators[nextIndex]);
	   currentIndex =nextIndex;
	   moveSlide();
   }
   
   var moveSlide = function(){
	   if(currentOffset == initialOffset){
			nextSlide.css('display', 'block');
			nextSlide.css('left', nextSlideOffset + 'px');
	   }
	   currentOffset = currentOffset - offsetStep;
	   if (currentOffset > minOffset){			
			slidesContainer.css('left', currentOffset + 'px');
			setTimeout(moveSlide, slideTimerInMs);
	   }else {
			currentSlide.css('display', 'none');
			currentPaginator.removeClass('current');
			nextPaginator.addClass('current');			
			currentOffset = initialOffset;
			slidesContainer.css('left', currentOffset + 'px');
			nextSlide.css('left', currentSlideOffset + 'px');
			setTimeout(changeSlide, timerInMs);
	   }
   }
   
   init();
}