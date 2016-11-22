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
  <!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
</head>
<body>
  <!-- for FB-->
  <!-- <div id="fb-root"></div>
  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script> -->

  <div class="maincontainer">
    <div class="main">
    <?php 
      $simpleheader_header_id = "API";
      $simpleheader_header = "Use OsmAnd power<br/>for your needs";
      include 'blocks/simple_header.php';
    ?>
    <div class="articles api_main">
      <div class="articlescontainer">

        <div class="article">
          <section class="api-section">
            <h2>Use OsmAnd API</h2>
            <p>OsmAnd API Demo allows you to test integration with OsmAnd and funtioning of the main features</p>
            <p class="list-header">OsmAnd API features:</p>
            <ul class="list">
              <li>Adding favorites and markers to the map</li>
              <li>Creating audio/video/photo notes</li>
              <li>Starting and stopping GPX track recording</li>
              <li>Importing GPX tracks into OsmAnd and navigatin along them</li>
              <li>Navigation between locations</li>
            </ul>
          </section>

          <section class="highlighted-box sidebar-merge" id="demo-holder">
            <h3>Start your project</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore praesentium, id ut, iusto hic adipisci, possimus, accusamus iste autem sunt impedit. Officiis, repellendus, velit! Nisi dignissimos ipsum ex quam, odit!</p>
            <a href="https://github.com/osmandapp/osmand-api-demo" class="github-link">https://github.com/osmandapp/osmand-api-demo</a>

            <h3>License</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique harum voluptatum consequuntur architecto dolorum minus natus quod totam alias ut facilis voluptas dicta sapiente fugit, nisi, praesentium adipisci inventore quos.</p>
            <a href="https://github.com/osmandapp/Osmand/blob/master/LICENSE">https://github.com/osmandapp/Osmand/blob/master/LICENSE</a>
            <div class="api-demo">
              <h2>Download Demo</h2>
              <div class="img-preview"></div>
              <a href="#" class="api-download-btn google-play-demo"></a>
            </div>
          </section>

          <section class="api-section sidebar-merge" id="sample-holder">
            <h2>OsmAnd API sample</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem molestiae sapiente, eos natus atque vitae voluptate saepe! Optio porro sunt unde accusantium reprehenderit, dolor est perspiciatis ullam beatae architecto eveniet!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, dicta accusamus, esse molestiae doloribus excepturi consectetur voluptatem totam modi asperiores fuga tempore itaque enim expedita sapiente, facere! Quasi, dignissimos, sit.</p>
            <div class="api-sample">
              <h2>Download Sample</h2>
              <div class="img-preview"></div>
              <a href="#" class="api-download-btn download-sample">Download</a>
            </div>
            <h3>License</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At facere, magni voluptate saepe, deleniti aliquid aut. Fugiat quas, <a class="mail-link" href="mailto:bussines@osmand.net">bussines@osmand.net</a> perspiciatis deserunt, ducimus ipsum eius atque ipsa aspernatur accusamus voluptatum aliquid!</p>
            <a href="https://github.com/osmandapp/Osmand/blob/master/LICENSE">https://github.com/osmandapp/Osmand/blob/master/LICENSE</a>
          </section>

          <section class="api-section">
            <h2>Create new rendering style</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati, saepe error illum alias minus necessitatibus delectus officia laudantium, dignissimos adipisci tenetur quaerat suscipit consequuntur, eum rerum harum vel, consectetur quo!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam maiores illum pariatur eos rerum omnis quos itaque sapiente nesciunt ipsam aliquid atque nam, nobis mollitia eaque natus praesentium ipsum nemo.</p>
          </section>

          <section class="api-section">
            <h2>Customize routing engine</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis id vel repudiandae soluta, quaerat excepturi, doloribus quibusdam quod ducimus vitae, similique sunt perspiciatis blanditiis nobis dolores. Labore delectus natus, facere.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique vero, recusandae perferendis enim labore laudantium quaerat culpa deserunt aperiam quisquam id maxime optio tempora nostrum saepe aliquam beatae nesciunt corporis?</p>
          </section>

          <section class="api-section">
            <div class="highlighted-box">
              <h3>Contact us for development</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis illo ipsum id natus cupiditate nobis, expedita, magnam nam dolorem <a class="mail-link" href="mailto:bussines@osmand.net">bussines@osmand.net</a>! Saepe quasi eos dolor adipisci? Numquam eveniet iure dicta delectus!</p>
            </div>
          </section>
        </div>

        <div class="article-menu-wrapper">
          <div class="modal-menu-button"></div>
          <div class="article-menu">
            <div class="acticlestitles">
              <h2>Build It</h2>
              <ul class="articlelinklist">
                <li><a data-gatag='use' href="/build_it?id=use">Use OsmAnd API</a></li>
                <li><a data-gatag='core' href="/build_it?id=core">Build app using OsmAnd Core</a></li>
                <li><a data-gatag='rendering' href="/build_it?id=rendering">Create new rendering style</a></li>
                <li><a data-gatag='routing' href="/build_it?id=routing">Customize routing engine</a></li>
                <li><a data-gatag='license' href="/build_it?id=license">License</a></li>
              </ul>
            </div>
          </div>
          <div class="sidebar-holder api-demo">
            <h2>Download Demo</h2>
            <div class="img-preview"></div>
            <a href="#" class="api-download-btn google-play-demo"></a>
          </div>
          <div class="sidebar-holder api-sample">
            <h2>Download Sample</h2>
            <div class="img-preview"></div>
            <a href="#" class="api-download-btn download-sample">Download</a>
          </div>
        </div>

      </div>
    </div>
    <?php include 'blocks/footer.html';  ?>
  </div>
</div>

<!-- for twitter-->
<!-- <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script> -->
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

  $(window).on('resize', function() {
    if ($(document).width() > 900) {
      $('.article-menu').attr('style', false);
      setDemoSidebarPosition();
      setSampleSidebarPosition();
    }
  });

  $('.article-menu-wrapper').on('click', function(e) {
    e.stopPropagation();
  });

  function setDemoSidebarPosition() {
    var demo = $('.sidebar-holder.api-demo'),
        demoHeight = demo.height(),
        demoHolder = $('#demo-holder'),
        demoHolderHeight = demoHolder.height(),
        demoHolderTop = demoHolder.offset().top,
        sidebarTop = $('.article-menu-wrapper').offset().top,
        demoTop = sidebarTop;
    
    if (demoHolderTop > demoTop) {
      demo.css({'top': demoHolderTop - demoTop })
    }
    if (demoHeight > demoHolderHeight) {
      demoHolder.css({'min-height': demoHeight + 30})
    }
  }

  function setSampleSidebarPosition() {
    var sample = $('.sidebar-holder.api-sample'),
        sampleHeight = sample.height(),
        sampleHolder = $('#sample-holder'),
        sampleHolderHeight = sampleHolder.height(),
        sampleHolderTop = sampleHolder.offset().top,
        sidebarTop = $('.article-menu-wrapper').offset().top,
        sampleTop = sidebarTop;
    
    if (sampleHolderTop > sampleTop) {
      sample.css({'top': sampleHolderTop - sampleTop })
    }
    if (sampleHeight > sampleHolderHeight) {
      sampleHolder.css({'min-height': sampleHeight + 30})
    }
  }

  if ($(document).width() > 900) {
    setDemoSidebarPosition();
    setSampleSidebarPosition();
  }
</script>
</body>
</html>