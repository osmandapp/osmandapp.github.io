$(function() {

     ga('set', 'page', '/home');	 
	
	 $('ul.menu a').on('click', function(){
		sendGAEvent('header', this);		
	 });
     $('.appstorebadge').on('click', function(){		
		sendGAEvent('badge', this);				
	 });	
	  $('.footer a').on('click', function(){
	    sendGAEvent('footer', this);		
	 });
	 
});



