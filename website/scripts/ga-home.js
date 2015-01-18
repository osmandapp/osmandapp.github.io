$(function() {

     ga('set', 'page', '/home');
	 
	 function sendEvent(category, element){
		var action= $(element).attr('data-gatag');		
		ga('send', 'event', category, action);
	 }
	 $('ul.menu a').on('click', function(){
		sendEvent('topmenu', this);		
	 });
     $('ul.badges a').on('click', function(){		
		sendEvent('badges', this);				
	 });
	 $('.screenshots .arrow').on('click', function(){
	    sendEvent('screenshots', this);		
	 });
	 $('.blogitem a').on('click', function(){
	    sendEvent('blogitem', this);		
	 });
	  $('.footer a').on('click', function(){
	    sendEvent('footer', this);		
	 });
	 $('.selectbox input').on('click', function(){
	    sendEvent('mapexample', this);		
	 }); 
	 
});



