$(function() {

     ga('set', 'page', '/blog');	 
	
	 $('ul.menu a').on('click', function(){
		sendGAEvent('blog_topmenu', this);		
	 });    
	 
	  $('.footer a').on('click', function(){
	    sendGAEvent('blog_footer', this);		
	 });
	 
	 addGATagsToLatestArticlesLinks();
	 
});

function addGATagsToLatestArticlesLinks(){
	if ($('.articlelinklist a').length != 0){	
		 $('.articlelinklist a').on('click', function(){
			sendGAEvent('articlelink', this);		
		});
	}else{
		setTimeout(addGATagsToLatestArticlesLinks, 200);
	}
}



