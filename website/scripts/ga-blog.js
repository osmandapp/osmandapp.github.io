$(function() {

     ga('set', 'page', '/blog');	 
	
	 $('ul.menu a').on('click', function(){
		sendGAEvent('blog_topmenu', this);		
	 });
    
	 $('.articlelinklist a').on('click', function(){
	    sendGAEvent('articlelink', this);		
	 });
	  $('.footer a').on('click', function(){
	    sendGAEvent('blog_footer', this);		
	 });
	 
});



