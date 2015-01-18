$(function() {

     ga('set', 'page', '/home');
	 
	 function sendEvent(category, action, element){
		var label= $(element).attr('data-gatag');		
		ga('send', 'event', category, action, label);
	 }
	 $('ul.menu a').on('click', function(){
		sendEvent('topmenu', 'goto', this);		
	 });
     $('ul.badges a').on('click', function(){		
		sendEvent('badges', 'goto', this);				
	 });
	 $('.screenshots .arrow').on('click', function(){
	    sendEvent('screenshots', 'viewmore', this);		
	 });
	 $('.blogitem a').on('click', function(){
	    sendEvent('blogitem', 'readmore', this);		
	 });
	  $('.footer a').on('click', function(){
	    sendEvent('footer', 'goto', this);		
	 });
	 $('.selectbox input').on('click', function(){
	    sendEvent('mapexample', 'choose', this);		
	 }); 
	 
});



