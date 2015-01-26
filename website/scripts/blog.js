var blogArticles = [
	{title:'OsmAnd 1.9', url:'#', index: 0},
	{title:'OsmAnd 1.8', url:'#', index: 1},
	{title:'OsmAnd 1.7', url:'\blog.html?id=osmand-1-7-released', index: 2},
	{title:'OsmAnd Seamarks &amp; Bitcoin maps', url:'#', index: 3},
	{title:'OsmAnd 1.6 Released', url:'#', index: 4},
	{title:'OsmAnd 1.5 Released', url:'#', index: 5}
];


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
		var url = 'blog_articles' + '\\' + $.urlParam(this.href, 'id') + ".html";
		$( ".article" ).load(url);		
	 });
}

init();


}