<div 
  class="<?php if($simpleheader_header_id == "MAIN" or $simpleheader_header_id == "DVR") 
      echo "header"; else echo "simpleheader"; ?>">
  <?php if ($simpleheader_header_id == "MAIN" or $simpleheader_header_id == "DVR")  { ?>
   <div class="header-map"></div>
  <?php } ?>
  <div class="shadowline">
    <div class="menu-wrapper">
      <a href="/" class="headerlogo-link"><div class="headerlogo"></div></a>
      <ul class="menu">
        <li class="mobile-sign">Menu</li>
        <li class="<?php if($simpleheader_header_id == "FEATURES") echo "activeitem" ?>"><a data-gatag="header_features" href="/features">Features</a></li>
        <li class="<?php if($simpleheader_header_id == "BLOG") echo "activeitem" ?>"><a data-gatag="header_blog" href="/blog" >Blog</a></li>
        <li class="<?php if($simpleheader_header_id == "OSMLIVE") echo "activeitem" ?>"><a data-gatag="header_osm_live" href="/osm_live">OSM Live</a></li>
        <li class="<?php if($simpleheader_header_id == "HELP") echo "activeitem" ?>"><a data-gatag="header_help" href="/help-online">Help</a></li>
        <li class="<?php if($simpleheader_header_id == "DVR") echo "activeitem" ?>"><a data-gatag="header_dvr" href="/dvr">DVR</a></li>
        <li class="mobile-only <?php if($simpleheader_header == "DOWNLOADS") echo "activeitem" ?>"><a data-gatag="header_downloads" href="/downloads">Downloads</a></li>
      </ul>
      <div class="menu-hamburger"></div>
    </div>
  </div>
  <div class="header-caption">
    <div class="headertext"><?php echo $simpleheader_header ?></div>

     <?php if ($simpleheader_header_id == "MAIN") { ?>
      <div class="badges">
          <!-- https://play.google.com/intl/en_us/badges/images/generic/en-play-badge.png -->
            <a data-gatag="googleplay" href="https://play.google.com/store/apps/details?id=net.osmand.plus"><img alt="Get it on Google Play" src="images/en-play-badge.png" /></a>
            <a data-gatag="amazon" href="http://www.amazon.com/gp/product/B00D0SEGMC/ref=mas_pm_OsmAnd-Maps-Navigation"><img alt="Get it on Amazon" src="images/amazon-apps-store.png" /></a>
            <a data-gatag="ios" class="appstoretopbadge" href="https://itunes.apple.com/app/apple-store/id934850257?pt=2123532&ct=WebSite&mt=8"><img src="images/app-store-badge.png"/></a>
          </li>
        </div>
      <?php } ?>
      <?php if ($simpleheader_header_id == "DVR") { ?>
       <div class="badges">
          <a class="appstoretopbadge" href="http://itunes.apple.com/us/app/id963873905"><img src="images/app-store-badge.png"></a>
        </div>
      <?php } ?>
  </div>
</div>

<script>
  $('.menu-hamburger').on('click', function() {
    $('.maincontainer').toggleClass('menu-open');
    if ($(document).width() < 321) {
      $(this).toggleClass('in-menu');
    }
    if ($('.menu').hasClass('active')) {
      setTimeout(function() {
        $('.menu').removeClass('active')
      }, 500)
    } else {
      $('.menu').addClass('active');
    }
  });

  $(window).on('resize', function(){

    if (!$('.menu-hamburger').is(':visible')) {
      $('.menu').removeClass('active');
      $('.maincontainer').removeClass('menu-open');
    }

  });

  $('body').on('click', function() {
    if ($('.maincontainer').hasClass('menu-open')) {
      $('.menu-hamburger').click();
    }
  });

  $('.menu-hamburger, .menu').on('click', function(e) {
    e.stopPropagation();
  });
  
  $('.download-btn').on('click', function(e) {
    e.stopPropagation();
  });
</script>
