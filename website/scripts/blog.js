var blogArticles = [
	{title:'OsmAnd 1.9', url:'#', index: 0},
	{title:'OsmAnd 1.8', url:'#', index: 1},
	{title:'OsmAnd 1.7', url:'\blog.html?id=osmand-1-7-released', index: 2},
	{title:'OsmAnd Seamarks &amp; Bitcoin maps', url:'#', index: 3},
	{title:'OsmAnd 1.6 Released', url:'#', index: 4},
	{title:'OsmAnd 1.5 Released', url:'#', index: 5}
];

function getUrlParameter(url, sParam)
{
    var sPageURL = url.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}   

$.urlParam = function(url, name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}

function blog(container){


var init = function(){
	container.empty();
	
	for (var link of blogArticles){
		container.append('<li><a data-index="' + link.index+ '" href="' + link.url + '">' + link.title + '</a></li>');
	}
	container.find('a').on('click', function(event){
		event.preventDefault();
		var url = $.urlParam(this.href, 'id') + ".html";
	    var link =$(this);
		//var index =link.attr('data-index').val();
		//var article = blogArticles[index];
		$( ".article" ).load(url);
	    /*$.get( url, function( data ) {
			var articleContainer = $( ".article" );
			articleContainer.empty();
			articleContainer.html( data );
			
		});*/
		
	 });
}

init();


}