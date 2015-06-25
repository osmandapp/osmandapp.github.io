$(function() {

     ga('set', 'page', '/home');	 
	
	 $('ul.menu a').on('click', function(){
		sendGAEvent('topmenu', this);		
	 });
     $('ul.badges a').on('click', function(){		
		sendGAEvent('badges', this);				
	 });
	 $('.screenshots .arrow').on('click', function(){
	    sendGAEvent('screenshots', this);		
	 });
	 $('.screenshots .button').on('click', function(){
	    sendGAEvent('screenshots', this);		
	 });
	 $('.blogitem a').on('click', function(){
	    sendGAEvent('blogitem', this);		
	 });
	  $('.footer a').on('click', function(){
	    sendGAEvent('footer', this);		
	 });
	 $('.selectbox input').on('click', function(){
	    sendGAEvent('mapexample', this);		
	 }); 
	 
	 $('a.header_joinus').on('click', function(){
	    sendGAEvent('joinus', this);		
	 }); 
	 
});



