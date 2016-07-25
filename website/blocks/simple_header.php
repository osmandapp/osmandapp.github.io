<div class="simpleheader">
  <div class="shadowline">
    <div class="menu-wrapper">
      <a href="/" class="headerlogo-link"><div class="headerlogo"></div></a>
      <ul class="menu">
        <li class="mobile-sign">Menu</li>
        <li><a data-gatag="header_home" href="/">Home</a></li>   
        <li class="<?php if($simpleheader_header == "FEATURES") echo "activeitem" ?>"><a data-gatag="header_features" href="/features">Features</a></li>    
        <li class="<?php if($simpleheader_header == "BLOG") echo "activeitem" ?>"><a data-gatag="header_blog" href="/blog" >Blog</a></li>
        <li class="<?php if($simpleheader_header == "HELP") echo "activeitem" ?>"><a data-gatag="header_help" href="/help-online">Help</a></li>   
        <li><a data-gatag="header_dvr" href="http://dvr.osmand.net">DVR</a></li>
      </ul>
      <div class="menu-humburger"></div>
    </div>
  </div>
  <div class="header-caption">
    <div class="headertext"><?php echo $simpleheader_header ?></div>
  </div>
</div>

<script>
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

  $(window).on('resize', function(){

    if (!$('.menu-humburger').is(':visible')) {
      $('.menu').removeClass('active');
      $('.maincontainer').removeClass('menu-open');
    }

  });
</script>