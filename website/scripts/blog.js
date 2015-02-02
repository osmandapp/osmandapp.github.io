var blogArticles = [
	{title:'OsmAnd 1.9', url:'blog.html?id=osmand-1-9-released', id:'osmand-1-9-released', gatag:'osmand_1_9'},
	{title:'OsmAnd 1.8', url:'blog.html?id=osmand-1-8-released', id:'osmand-1-8-released', gatag:'osmand_1_8'},
	{title:'OsmAnd 1.7', url:'blog.html?id=osmand-1-7-released', id:'osmand-1-7-released', gatag:'osmand_1_7'},
	{title:'OsmAnd Seamarks &amp; Bitcoin maps', url:'blog.html?id=osmand-seamarks-and-bitcoin-maps', id:'osmand-seamarks-and-bitcoin-maps', gatag:'seamarks_bitcoin'},
	{title:'OsmAnd 1.6 Released', url:'blog.html?id=osmand-1-6-released', id:'osmand-1-6-released', gatag:'osmand_1_6'},
	{title:'OsmAnd 1.5 Released', url:'blog.html?id=osmand-1-5-released', id:'osmand-1-5-released', gatag:'osmand_1_5'}
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
		
		$('div.fb-like').attr('data-href', articleFullUrl);
		$('.twitter-share-button').attr('data-url', articleFullUrl);
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
		container.append('<li><a data-gatag="' +link.gatag+ '" data-index="' + link.index+ '" href="' + link.url + '">' + link.title + '</a></li>');
	}
	
	var articleid = $.urlParam(window.location.href, 'id');
	if (!articleid || articleid == null){
		articleid = blogArticles[0].id;
	}
	//hide share buttons
	$('.share_buttons').css('display', 'none');
	var url = 'blog_articles' + '\\' + articleid + ".html";
	$( ".article" ).load(url, function( response, status, xhr) {
		if ( status != "error" ) {
			$('.share_buttons').css('display', 'block');
			updateMetaTags(getArticleById(articleid));
			setTimeout(fixTwitter, 5000);
		}
	});
	
}

init();


}