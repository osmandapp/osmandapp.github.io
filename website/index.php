<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OsmAnd - Offline Mobile Maps and Navigation</title>
  <?php include 'blocks/default_links.html'; ?>
  <script type="text/javascript" src="scripts/slick.min.js"></script>
  <script type="text/javascript" src="scripts/mapselector.js"></script>
  <script type="text/javascript" src="scripts/poll.js"></script>
  <!-- <script type="text/javascript" src="scripts/ga-init.js"></script>
  <script type="text/javascript" src="scripts/ga-home.js?v=2"></script> -->
  <link rel="stylesheet" type="text/css" href="slick.css"/>
</head>
<body>

<div class="maincontainer">
  <div class="main">
    <div class="header">
      <div class="header-map"></div>
      <div class="shadowline">
        <div class="menu-wrapper">
          <a href="/" class="headerlogo-link"><div class="headerlogo"></div></a>
          <ul class="menu">
            <li class="mobile-sign">Menu</li>
            <li class="activeitem"><a data-gatag="header_home" href="/">Home</a></li>   
            <li><a data-gatag="header_features" href="/features">Features</a></li>    
            <li><a data-gatag="header_blog" href="/blog" >Blog</a></li>
            <li><a data-gatag="header_help" href="/help-online">Help</a></li>   
            <li><a data-gatag="header_dvr" href="http://dvr.osmand.net">DVR</a></li>
          </ul>
          <div class="menu-humburger"></div>
        </div>
      </div>
      <div class="header-caption">
        <div class="headertext">Offline mobile<br/> maps &amp; navigation</div>
        <div class="badges">
            <a data-gatag="googleplay" href="https://play.google.com/store/apps/details?id=net.osmand.plus"><img alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/images/generic/en-play-badge.png" /></a>
            <a data-gatag="amazon" href="http://www.amazon.com/gp/product/B00D0SEGMC/ref=mas_pm_OsmAnd-Maps-Navigation"><img alt="Get it on Amazon" src="images/amazon-apps-store.png" /></a>
            <a data-gatag="ios" class="appstoretopbadge" href="https://itunes.apple.com/app/apple-store/id934850257?pt=2123532&ct=WebSite&mt=8"><img src="images/app-store-badge.png"/></a>
          </li>
        </div>
      </div>
    </div>
  </div>

  <div class="features">
    <div class="featurestitle">
      <h2>APP FEATURES</h2>
      <p>Global Mobile Map Viewing and Navigation for Online and Offline OSM Maps</p>
    </div>
    <div class="featurescontainer">
      <div class="featureblock">  
        <div class="featureblocktitle feature-nav"> 
          <h2>Navigation <span class="warning">(Android only)</span></h2>
        </div>
        <ul class="categorydescription">
          <li>Works totally offline (no roaming charges when you are abroad) but also has a (fast) online option </li>
          <li>Turn-by-turn voice guidance (recorded and synthesized voices) </li>
          <li>Announce traffic warnings like stop signs, pedestrian crosswalks, or when you are exceeding the speed limit.  </li>   
          <li>Optional lane guidance, street name display, and estimated time of arrival</li>
          <li>Supports intermediate points on your itinerary</li>
          <li>Automatic re-routing whenever you deviate from the route</li>
          <li>Search for places by address, by type (e.g.: restaurant, hotel, gas station, museum), or by geographical coordinates</li>
        </ul>
      </div>
    
      <div class="featureblock">  
        <div class="featureblocktitle feature-map"> 
          <h2>Map viewing</h2>
        </div>
        <ul class="categorydescription">
          <li>Carry highly detailed, fully offline maps of any region world wide on your device!</li>
          <li>Display your position and orientation on the map</li>
          <li>Optionally align the map according to compass or your direction of motion </li>
          <li>Save your most important places as Favorites</li>
          <li>Display POIs (points of interest) around you</li>
          <li>Can also display specialized online tile maps</li>
          <li>Can also display satellite view (from Bing)</li>
          <li>Can display different overlays like touring/navigation GPX tracks and additional maps with customizable transparency</li>
          <li>Optionally display place names in English, local, or phonetic spelling</li>
        </ul>
      </div>    
    
      <div class="featureblock">  
        <div class="featureblocktitle feature-bike"> 
          <h2>Bicycle and pedestrian features</h2>
        </div>
        <ul class="categorydescription">
          <li>The offline maps include foot, hiking, and bike paths, great for outdoor activities</li>
          <li>Map display and navigation mode for bicycle and pedestrian</li>
          <li>Optionally display public transport stops (bus, tram, train) including line names</li>
          <li>Optional trip recording to local GPX file or online service</li>
          <li>Optional speed and altitude display</li>
          <li>Display of contour lines and hill-shading (via additional plugin)</li>    
        </ul>
      </div>
    
      <div class="featureblock">  
        <div class="featureblocktitle feature-opensource">
          <h2>Open Source <span class="subheader">OpenStreetMap &amp; Wikipedia data</span></h2>
        </div>
        <ul class="categorydescription">
          <li>High quality information from the 2 best collaborative projects of the world</li>
          <li>Global maps from OpenStreetMap, available per country or region</li>
          <li>Wikipedia POIs, great for sightseeing (not available in free version)</li>
          <li>Unlimited free map downloads, directly from the app (download limit 7 map files in the free version)</li>
          <li>Always up-to-date maps (updated at least once a month)</li>
          <li>Compact offline vector maps</li>  
          <li>Select between complete map data and just road network (Example: All of Japan is 700 MB, or 200 MB for the road network only)</li>            
          <li>Also supports online or cached tile maps</li>
        </ul>
      </div>
    
    </div>
  </div>

  <div class="screenshots">  
    <div class="slider">
      <div class="sliderheader">
        <h2>Screenshots</h2>
        <div class="switch">
          <div class="button active" data-gatag="android_button">Android</div>
          <div class="button" data-gatag="ios_button">iOS</div>
        </div>
      </div>
      <div class="images android">
        <img class="screenshot android" src="images/promo-1s.png"/>
        <img class="screenshot android" src="images/promo-2s.png"/>
        <img class="screenshot android" src="images/promo-3s.png"/>
        <img class="screenshot android" src="images/promo-4s.png"/>
        <img class="screenshot android" src="images/promo-5s.png"/>
        <img class="screenshot android" src="images/promo-6s.png"/>
        <img class="screenshot android" src="images/promo-7s.png"/>
        <img class="screenshot android" src="images/promo-8s.png"/>
        <img class="screenshot android" src="images/promo-9s.png"/>
        <img class="screenshot android" src="images/promo-10s.png"/>
        <img class="screenshot android" src="images/promo-11s.png"/>
        <img class="screenshot android" src="images/promo-12s.png"/>
      </div>
      <div class="images ios">
        <img class="screenshot ios" src="images/ios-1s.png"/>
        <img class="screenshot ios" src="images/ios-2s.png"/>
        <img class="screenshot ios" src="images/ios-3s.png"/>
        <img class="screenshot ios" src="images/ios-4s.png"/>
        <img class="screenshot ios" src="images/ios-5s.png"/>
      </div>
    </div>  
    <div class="screenshot-preview-holder"></div>
  </div>

  <div class="whatyousay">
    <div class="whatyousaycontainer">     
      <h2>What you say</h2>
      <div class="whatyousayblock">
        <div class="whatyousaymessage">
          <span>"I use openstreetmap &amp; osmandapp for hiking. Their new iD map editor is easy, so I added a few missing local footpaths."</span>
        </div>
        <div class="signature">
          <div class="name">Iain Cheyne</div>
          <div class="source">twitter: @Icheyne</div>
        </div>
      </div>          
      
      <div class="whatyousayblock ">
        <div class="whatyousaymessage">
          <span>"Saved me numerous times, I would not have survived the Philippines without it!"</span>
        </div>
        <div class="signature">
          <div class="name">Michelle Ann Levine</div>
          <div class="source">Play Market</div>
        </div>
      </div>
      
      <div class="whatyousayblock">
        <div class="whatyousaymessage">
          <span>"Installed on a whim while on a cycling trip : I was very impressed by the amount of detail!"</span>
        </div>
        <div class="signature">
          <div class="name">Fran&#231;ois-Xavier Thomas</div>
          <div class="source">Play Market</div>
        </div>
      </div>

      <div class="whatyousayblock">
        <div class="whatyousaymessage">
          <span>"Found osmandapp :) trip planning is incredible."</span>
        </div>
        <div class="signature">
          <div class="name">Joanne Donn</div>
          <div class="source">twitter: @GearChic</div>
        </div>
      </div>
      
      <div class="whatyousayblock">
        <div class="whatyousaymessage">
          <span>"Whenever I travel I always use it. Very useful."</span>
        </div>
        <div class="signature">
          <div class="name">Sonny Lacanlale</div>
          <div class="source">Play Market</div>
        </div>
      </div>
      
      <div class="whatyousayblock">
        <div class="whatyousaymessage">
          <span>"Great navigation app with offline maps from open street map with e.g. lane by lane navigation while driving, the UI is a bit difficult to navigate but it's a must app for vacation abroad."</span>
        </div>
        <div class="signature">
          <div class="name">Jan Igerud</div>
          <div class="source">Play Market</div>
        </div>
      </div>

      <div class="badgescontainer">
        <div class="badges">
          <a data-gatag="googleplay" href="https://play.google.com/store/apps/details?id=net.osmand.plus"><img alt="Get it on Google Play" src="https://play.google.com/intl/en_us/badges/images/generic/en-play-badge.png" /></a>
          <a data-gatag="amazon" href="http://www.amazon.com/gp/product/B00D0SEGMC/ref=mas_pm_OsmAnd-Maps-Navigation"><img alt="Get it on Amazon" src="images/amazon-apps-store.png" /></a>
          <a data-gatag="ios" class="appstoretopbadge" href="https://itunes.apple.com/app/apple-store/id934850257?pt=2123532&ct=WebSite&mt=8"><img src="images/app-store-badge.png"/></a>
        </div>
      </div>
    </div>
  </div>

  <div class="mapexample">
    <div class="mapexampleheader">  
      <h2>Map example</h2>
    </div>
    <div class="mapcontainer">
      <div class="selectbox">
        <div class="selecttitle first">MAP STYLE</div>
        <ul class="theme-selector">
          <li>
            <label class="active"><input data-gatag="osmand" type="radio" name="style" value="default" checked="true" />OsmAnd</label>
          </li>
          <li>
            <label><input data-gatag="osmand_night" type="radio" name="style" value="night"/>OsmAnd - night</label>
          </li>      
        </ul>
        <div class="selecttitle">SHOW</div>
        <ul class="map-selector">
          <li>
            <label><input data-gatag="city_map" type="radio" name="show" value="citymap" checked="true"/>City map</label>
          </li>
          <li>
            <label><input data-gatag="cycling_routes" type="radio" name="show" value="cycling"/>Cycling routes</label>
          </li>
          <li>
            <label><input data-gatag="detailed_map" type="radio" name="show" value="detailedmap"/>Detailed map</label>
          </li>
          <li>
            <label><input data-gatag="hiking" type="radio" name="show" value="hiking"/>Hiking</label>
          </li>
          <li>
            <label><input data-gatag="public_transport" type="radio" name="show" value="subway" />Public transport</label>
          </li>
          <li>
            <label><input data-gatag="road_surface" type="radio" name="show" value="roadsurface"/>Road surface</label>
          </li>
          <li>
            <label><input data-gatag="nautical_sea" type="radio" name="show" value="nauticalsea"/>Nautical - sea</label>
          </li>
          <li>
            <label><input data-gatag="nautical_canals" type="radio" name="show" value="nauticalcanals"/>Nautical - canals</label>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="blogcontainerwrap">
    <div class="blogcontainer">
      <div>
        <?php include 'blocks/main_news.html'; ?>
      </div>
      <div>
        <?php include 'blocks/main_poll.html';?>
      </div>
    </div>
  </div>

  <div id="fb-root"></div>
  <script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.3";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  </script>

  <div class="blogcontainerwrap social-widgets">
    <div class="blogcontainer">
      <div>
        <h2>Facebook</h2>
        <div class="fb-page" data-href="https://www.facebook.com/osmandapp" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"  data-width="500" >
          <div class="fb-xfbml-parse-ignore">
            <blockquote cite="https://www.facebook.com/osmandapp"><a href="https://www.facebook.com/facebook">OsmAnd</a></blockquote>
          </div>
        </div>
      </div>
      <div>
        <h2>Twitter</h2>
        <a class="twitter-timeline" href="https://twitter.com/osmandapp" data-widget-id="598236050113372160" height="502">Tweets by @osmandapp</a>
        <script>
          !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
        </script>
      </div>
    </div>
  </div>

  <?php include 'blocks/footer.html';?>

</div>

<script type="text/javascript">
  var sl;
  var mapsel;
  var timeout = 50;

  $( document ).ready(function() {

    function setSliderSettings() {
      return {
        infinite: true,
        autoplaySpeed: 4000,
        arrows: true,
        slidesToShow: 4,
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 4,
              centerMode: true,
              arrows: false,
              autoplay: true
            }
          },
          {
            breakpoint: 900,
            settings: {
              slidesToShow: 3,
              arrows: false,
              autoplay: true
            }
          }
        ]
      }
    }

    $('.images.android').slick(setSliderSettings());

    $('.screenshot').on('click', function(e) {
      e.preventDefault();

      if ($(window).width() < 1200) {

        var currentScreenshot = $(this).clone()
                                       .removeClass('slick-slide slick-active slick-current')
                                       .addClass('in-preview')
                                       .attr('style', false);

        $('body').addClass('tech-oh');

        if (navigator.userAgent.match(/(iPhone|iPod|iPad)/i)) {
          $currentScrollPos = $(document).scrollTop();
          $('body').css({
            'position': 'fixed'
          });
          localStorage.cachedScrollPos = $currentScrollPos;
        }

        currentScreenshot.appendTo($('.screenshot-preview-holder'));
        $('.screenshot-preview-holder').fadeIn();

      }

    });

    $('.screenshot-preview-holder').on('click', function() {

      $('body').removeClass('tech-oh');

      if (navigator.userAgent.match(/(iPhone|iPod|iPad)/i)) {
        $('body').css({
          'position': 'static'
        });
        $('body').scrollTop(localStorage.cachedScrollPos);
      }

      $(this).fadeOut('slow').empty();

    });

    $('.switch .button').on('click', function(e) {
      if ($(this).hasClass('active')) {
        return;
      } else {
        e.preventDefault();
        var platform = $(this).data('gatag').split('_')[0];
        $('.switch .button').removeClass('active');
        $(this).addClass('active');
        $('.images.slick-slider').slick('unslick').hide();
        $('.images.' + platform).show().slick(setSliderSettings());
      }
    });

    $('.menu-humburger').on('click', function() {
      $('.maincontainer').toggleClass('menu-open');
      if ($('.menu').hasClass('active')) {
        setTimeout(function() {
          $('.menu').removeClass('active')
        }, 500)
      } else {
        $('.menu').addClass('active');
      }
    });

    $('.selectbox').on('click', function() {
      $(this).toggleClass('active');
    });

    if ($(window).width() < 1100) {
      $('.selectbox .selecttitle.first').append('<p class="selected-map">' + getMapName($('.map-selector label').first()) + '</p>');
    }

    function getMapName(elem) {
      return elem.text();
    }

    function setMapName(elemText) {
      $('.selected-map').text(elemText);
    }

    $('.map-selector label').on('click', function(e) {
      e.stopPropagation();
      setMapName(getMapName($(this)));
      $('.selectbox').removeClass('active');
    })

    $('.theme-selector input').on('change', function() {
      if ($(window).width() < 1100) {
        $('.theme-selector label').removeClass('active');
        $(this).parent().addClass('active');
      }
    });

    mapsel = new mapselector($(".mapcontainer"));

    $(".specialevent").height($(".specialeventcontent").height() - 60);
    $(window).on('resize', function(){
        $(".specialevent").height($(".specialeventcontent").height()- 60);

        if (!$('.menu-humburger').is(':visible')) {
          $('.menu').removeClass('active');
          $('.maincontainer').removeClass('menu-open');
        }

        if ($(document).width() < 1100) {
          if (!$('.selected-map').is(':visible')) {
            $('.selectbox .selecttitle.first').append('<p class="selected-map">' + getMapName($('.map-selector label').first()) + '</p>');
          }
        } else {
          $('.selected-map').hide();
        }

    });

     
    setTimeout(applyPolStyles, timeout);

  });
</script>
</body>
</html>