<?php
  if (empty($_GET['id'])) {
    $_GET['id'] ="main";
  } 
?>          
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OsmAnd - Offline Mobile Maps and Navigation</title>
  <?php include 'blocks/default_links.html';  ?>
  <!-- for google+-->
  <link rel="canonical"  <?php echo 'href="http://osmand.net'.$_SERVER['REQUEST_URI'].'"'  ?> />
  <script src="https://apis.google.com/js/platform.js" async defer></script>
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
      $simpleheader_header = "FEATURES";
      $simpleheader_header_id = "FEATURES";
      include 'blocks/simple_header.php';
    ?>
    <div class="articles">
      <div class="articlescontainer">
    
      <?php if ( true || $_GET['id'] != 'main') { ?>

        <div class="article"><?php echo file_get_contents("feature_articles/".$_GET['id'].".html"); ?></div>

        <div class="article-menu-wrapper">
          <div class="modal-menu-button"></div>
          <div class="article-menu">
            <div class="acticlestitles">
              <h2>Features</h2>
              <ul class="articlelinklist">
                <li><a data-gatag='start' href="/features?id=start">Begin with OsmAnd</a></li>
                <li><a data-gatag='navigation' href="/features?id=navigation">Navigation</a></li>
                <li><a data-gatag='map-viewing' href="/features?id=map-viewing">Map Viewing</a></li>
                <li><a data-gatag='search-on-map' href="/features?id=find-something-on-map">Search on the map</a></li>
                <li><a data-gatag='trip-planning' href="/features?id=trip-planning">Planning trip</a></li>
                <li><a data-gatag='troubleshooting' href="/features?id=installation-and-troubleshooting">Installation &amp; troubleshoooting</a></li>
              </ul>
              <h2>Plugins</h2>
              <ul class="articlelinklist">
                <li><a data-gatag='online-maps-plugin' href="/features?id=online-maps-plugin">Online maps</a></li>
                <li><a data-gatag='contour-lines-plugin' href="/features?id=contour-lines-plugin" >Contour lines and Hillshade map</a></li>
                <li><a data-gatag='trip-recording-plugin' href="/features?id=trip-recording-plugin" >Trip recording</a></li>
                <li><a data-gatag='ski-plugin' href="/features?id=ski-plugin" >Ski maps</a></li>
                <li><a data-gatag='nautical_charts' href="/features?id=nautical-charts" >Nautical charts</a></li>
                <li><a data-gatag='audio-video-notes-plugin' href="/features?id=audio-video-notes-plugin" >Audio/video notes</a></li>
                <li><a data-gatag='osm-editing-plugin' href="/features?id=osm-editing-plugin">OSM editing</a></li>
                <li><a data-gatag='distance-calculator-and-planning-tool' href="/features?id=distance-calculator-and-planning-tool">Distance calculator and planning tool</a></li>
                <li><a data-gatag='parking-plugin' href="/features?id=parking-plugin" >Parking place</a></li>
                <li><a data-gatag='osmo-plugin' href="/features?id=osmo-plugin">OsMo plugin</a></li>
              </ul>
            </div>
          </div>
        </div>
    
      <?php } else { 
        echo file_get_contents("feature_articles/".$_GET['id'].".html"); 
      } ?>
      </div>
    </div>
    <?php include 'blocks/footer.html';  ?>
  </div>
</div>

<!-- for twitter-->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<script>
  var equalHeight = function(container) {

    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;

    $(container).each(function() {

      $el = $(this);
      $($el).height('auto')
      topPostion = $el.position().top;

      if (currentRowStart != topPostion) {
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
          rowDivs[currentDiv].height(currentTallest);
        }
        rowDivs.length = 0; // empty the array
        currentRowStart = topPostion;
        currentTallest = $el.height();
        rowDivs.push($el);
      } else {
        rowDivs.push($el);
        currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
      }
      for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
        rowDivs[currentDiv].height(currentTallest);
      }
    });
  }

  $(window).on('resize', function() {
    if ($(window).width() > 800) {
      equalHeight($('.plugin, .subfeatureheader'));
    }
  });

  $(window).on('load', function() {
    if ($(window).width() > 800) {
      equalHeight($('.plugin, .subfeatureheader'));
    }
  });

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

  $(window).on('resize', function() {
    if ($(document).width() > 900) {
      $('.article-menu').attr('style', false);
    }
  });

  $('.article-menu-wrapper').on('click', function(e) {
    e.stopPropagation();
  });
</script>
</body>
</html>