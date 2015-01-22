var blogArticles = [
	{title:'OsmAnd 1.9', url:'#'},
	{title:'OsmAnd 1.8', url:'#'},
	{title:'OsmAnd 1.7', url:'#'},
	{title:'OsmAnd Seamarks &amp; Bitcoin maps', url:'#'},
	{title:'OsmAnd 1.6 Released', url:'#'},
	{title:'OsmAnd 1.5 Released', url:'#'}
];


function blog(container){


var init = function(){
	container.empty();
	for (var link of blogArticles){
		container.append('<li><a href="' + link.url + '">' + link.title + '</a></li>');
	}
}

init();


}