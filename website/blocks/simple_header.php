<div class="simpleheader">
  <div class="shadowline">
    <div class="menu-wrapper">
      <a href="/" class="headerlogo-link"><div class="headerlogo"></div></a>
      <ul class="menu">
        <li class="mobile-sign">Menu</li>
        <li class="<?php if($simpleheader_header == "FEATURES") echo "activeitem" ?>"><a data-gatag="header_features" href="/features">Features</a></li>
        <li class="<?php if($simpleheader_header == "BLOG") echo "activeitem" ?>"><a data-gatag="header_blog" href="/blog" >Blog</a></li>
        <li><a data-gatag="header_osm_live" href="/osm_live">OSM Live</a></li>
        <li class="<?php if($simpleheader_header == "HELP") echo "activeitem" ?>"><a data-gatag="header_help" href="/help-online">Help</a></li>
        <li><a data-gatag="header_dvr" href="http://dvr.osmand.net">DVR</a></li>
        <li class="mobile-only <?php if($simpleheader_header == "DOWNLOADS") echo "activeitem" ?>"><a data-gatag="header_downloads" href="/help-online?id=changes">Downloads</a></li>
      </ul>
      <div class="menu-hamburger"></div>
    </div>
  </div>
  <div class="header-caption">
    <div class="headertext"><?php echo $simpleheader_header ?></div>
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
</script>