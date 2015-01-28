var blogArticles = [
	{title:'OsmAnd 1.9', url:'blog.html?id=osmand-1-9-released', id:'osmand-1-9-released', index: 0},
	{title:'OsmAnd 1.8', url:'blog.html?id=osmand-1-8-released', id:'osmand-1-8-released', index: 1},
	{title:'OsmAnd 1.7', url:'blog.html?id=osmand-1-7-released', id:'osmand-1-7-released', index: 2},
	{title:'OsmAnd Seamarks &amp; Bitcoin maps', url:'blog.html?id=osmand-seamarks-and-bitcoin-maps', id:'osmand-seamarks-and-bitcoin-maps', index: 3},
	{title:'OsmAnd 1.6 Released', url:'blog.html?id=osmand-1-6-released', id:'osmand-1-6-released', index: 4},
	{title:'OsmAnd 1.5 Released', url:'blog.html?id=osmand-1-5-released', id:'osmand-1-5-released', index: 5}
];

var webSiteUrl = "http://osmand.net";

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

var getFullArticleUrl = function(articleObj){
	return webSiteUrl + "/" + articleObj.url;
}

var fixTwitter =function (){ 
	$('#___plusone_0 iframe').css('height', '21px');
}

var updateMetaTags = function(articleObj){
	if (articleObj && articleObj != null){
		var articleFullUrl = getFullArticleUrl(articleObj);
		$('meta[property="og:title"]').attr('content', articleObj.title);
		$('meta[property="og:url"]').attr('content', articleFullUrl);
		$('meta[property="og:description"]').attr('content', articleObj.title);
		
		$('link[rel="canonical"]').attr('href', articleFullUrl);
	}
}

var getArticleById = function(articleid){
	for(var i=0; i < blogArticles.length;++i){
		if (blogArticles[i].id === articleid){
			return blogArticles[i];
		}
	}
	return null;
}

var init = function(){
	container.empty();
	
	for (var link of blogArticles){
		container.append('<li><a data-index="' + link.index+ '" href="' + link.url + '">' + link.title + '</a></li>');
	}
	
	var articleid = $.urlParam(window.location.href, 'id');
	if (!articleid || articleid == null){
		articleid = blogArticles[0].id;
	}
	
	var url = 'blog_articles' + '\\' + articleid + ".html";
	$( ".article" ).load(url);
	
	updateMetaTags(getArticleById(articleid));
		
	
	setTimeout(fixTwitter, 5000);
}

init();


}