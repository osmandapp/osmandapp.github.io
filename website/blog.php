<?php
  if (empty($_GET['id'])) {
    $_GET['id'] ="travel";
  } 
?>          
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:url"        <?php  echo 'content="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?> /> 
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="OsmAnd - Offline Mobile Maps and Navigation" />
  <meta property="og:description"   content="" />
  <meta property="og:image"         content="http://osmand.net/images/logo-grey.png" />
  <title>OsmAnd - Offline Mobile Maps and Navigation</title>
  <?php include 'blocks/default_links.html'; ?>
  <!-- for google+-->
  <link rel="canonical" <?php echo 'href="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?>  />
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script type="text/javascript" src="scripts/ga-init.js"></script>
  <script type="text/javascript" src="scripts/ga-blog.js"></script>
</head>
<body>
<!-- for FB-->
<div id="fb-root"></div>
<script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<div class="maincontainer">
  <div class="main">
    <?php
      if ($_GET['id'] != 'osmand-5-years') {
        $simpleheader_header = "BLOG";
        $simpleheader_header_id = "BLOG";
        include 'blocks/simple_header.php';
      } else {
    ?>
      <iframe src="http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=13SophOj2oI_AO1lb9aAOWrZiZiW1saaPgseZdijtuEE&font=Bevan-PotanoSans&maptype=toner&lang=en&start_at_slide=1&height=450" style="width:100%;height:450px">
      </iframe>
    <?php } ?>

    <div class="articles">
      <div class="articlescontainer">
        
      
      <div class="article">
        <?php echo file_get_contents("blog_articles/".$_GET['id'].".html"); ?>      
      </div>    
      
      <div class="article-menu-wrapper">
        <div class="modal-menu-button"></div>
        <div class="article-menu">
          <div class="acticlestitles">
            <h2>Latest articles</h2>
            <ul class="articlelinklist">
              <li><a data-gatag='travel' href="/blog?id=8-years">Travel guides</a></li>
              <li><a data-gatag='8-years' href="/blog?id=8-years">OsmAnd turns 8</a></li>
              <li><a data-gatag='osmand-3-0-released' href="/blog?id=osmand-3-0-released">OsmAnd 3.0</a></li>
              <li><a data-gatag='osmand-ios-2-1-released' href="/blog?id=osmand-ios-2-1-released">OsmAnd 2.1 (iOS)</a></li>
              <li><a data-gatag='osmand-2-9-released' href="/blog?id=osmand-2-9-released">OsmAnd 2.9</a></li>
              <li><a data-gatag='osmand-ios-2-0-released' href="/blog?id=osmand_payouts_suspended_01_2018">OsmAnd Live payouts suspended</a></li>
              <li><a data-gatag='osmand-ios-2-0-released' href="/blog?id=osmand-ios-2-0-released" >OsmAnd 2.0 (iOS)</a></li>
              <li><a data-gatag='osmand-2-8-released' href="/blog?id=osmand-2-8-released" >OsmAnd 2.8</a></li>
              <li><a data-gatag='osmand-2-7-released' href="/blog?id=osmand-2-7-released" >OsmAnd 2.7</a></li>
              <li><a data-gatag='osmand-2-6-released' href="/blog?id=osmand-2-6-released" >OsmAnd 2.6</a></li>
              <li><a data-gatag='osmand_youtube_channel' href="/blog?id=osmand_youtube_channel" >OsmAnd team on Youtube</a></li>
              <li><a data-gatag='osmand-ios-1.3-released' href="/blog?id=osmand-ios-1.3-released" >OsmAnd 1.3 (iOS)</a></li>
              <li><a data-gatag='osmand-2-5-released' href="/blog?id=osmand-2-5-released" >OsmAnd 2.5</a></li>
              <li><a data-gatag='christmas_map' href="/blog?id=christmas_map" >Сhristmas POI map</a></li>
              <li><a data-gatag='topo-style' href="/blog?id=topo_style" >Topo style</a></li>
              <li><a data-gatag='osmand-2-4-released' href="/blog?id=osmand-2-4-released" >OsmAnd 2.4</a></li>
              <li><a data-gatag='osmand_videos' href="/blog?id=osmand_videos" >OsmAnd Videos</a></li>
              <li><a data-gatag='api_demo' href="/blog?id=api_demo" >OsmAnd API Demo</a></li>
              <li><a data-gatag='osm-live' href="/blog?id=osm-live" >OsmAnd Live</a></li>
              <li><a data-gatag='osmand-2-3-released' href="/blog?id=osmand-2-3-released" >OsmAnd 2.3</a></li>
              <li><a data-gatag='osmand_google_comparison' href="/blog?id=osmand_google_comparison" >Google maps vs. OsmAnd maps  & navigation</a></li>
              <li><a data-gatag='osmand-2-2-released' href="/blog?id=osmand-2-2-released" >OsmAnd 2.2</a></li>
              <li><a data-gatag='osmand-ios-1.2.2-released' href="/blog?id=osmand-ios-1.2.2-released" >OsmAnd 1.2.2 (iOS)</a></li>
              <li><a data-gatag='osmand-ios-1.1.1-released' href="/blog?id=osmand-ios-1.1.1-released" >OsmAnd 1.1.1 (iOS)</a></li>
              <li><a data-gatag='osmand-5-years' href="/blog?id=5_years" >5 years!</a></li>
              <li><a data-gatag='osmand-2-1-released' href="/blog?id=osmand-2-1-released" >OsmAnd 2.1</a></li>
              <li><a data-gatag='osmand_ios_1_0_2' href="/blog?id=osmand-ios-1.0.2" >OsmAnd 1.0.2 (iOS)</a></li>
              <li><a data-gatag='osmand_2_0' href="/blog?id=osmand-2-0-released" >OsmAnd 2.0</a></li>
              <li><a data-gatag='osmand_ios' href="/blog?id=osmand-ios" >OsmAnd for iPhone is released</a></li>
              <li><a data-gatag='nautical_charts' href="/blog?id=nautical-charts" >Nautical charts</a></li>
              <li><a data-gatag='osmand_dvr_goes_live' href="/blog?id=osmand-dvr-goes-live">OsmAnd DVR goes live</a></li>
              <li><a data-gatag='osmand_1_9' href="/blog?id=osmand-1-9-released" >OsmAnd 1.9</a></li>
              <li><a data-gatag='osmand_1_8' href="/blog?id=osmand-1-8-released" >OsmAnd 1.8</a></li>
              <li><a data-gatag='osmand_1_7' href="/blog?id=osmand-1-7-released" >OsmAnd 1.7</a></li>
              <li><a data-gatag='osmand_1_6' href="/blog?id=osmand-1-6-released" >OsmAnd 1.6</a></li>
              <li><a data-gatag='osmand_1_5' href="/blog?id=osmand-1-5-released" >OsmAnd 1.5</a></li>
              <li><a data-gatag='osmand_videos' href="/blog?id=osmand_videos" >OsmAnd Videos</a></li>
              <li><a data-gatag='osmand_rss' href="/rss.xml" >RSS</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'blocks/footer.html'; ?>
</div>

<!-- for twitter-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>

<script>
  $('.modal-menu-button').on('click', function(e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $('.article-menu').slideToggle();
  });

  $('body').on('click', function() {
    if ($('.modal-menu-button').hasClass('active')) {
      $('.modal-menu-button').toggleClass('active');
      $('.article-menu').slideToggle();
    }
  });

  $('.article-menu-wrapper').on('click', function(e) {
    e.stopPropagation();
  });

  $(window).on('resize', function() {
    if ($(document).width() > 900) {
      $('.article-menu').attr('style', false);
    }
  });
</script>
</body>

</html>
