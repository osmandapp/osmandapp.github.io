<?php
require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('./private/service.json');

$firebase = (new Factory)
->withServiceAccount($serviceAccount)
->withDatabaseUri('https://osmand-1e236.firebaseio.com/')
->create();

$database = $firebase->getDatabase();

$date = date('M Y');

if ($_GET["response"] == 'good') {
  $newPost = $database
  ->getReference($date)
  ->push([
     'response' => 'good',
     'timestamp' => time()
  ]);
}
elseif ($_GET["response"] == 'average') {
  $newPost = $database
  ->getReference($date)
  ->push([
     'response' => 'average',
     'timestamp' => time()
  ]);
}
elseif ($_GET["response"] == 'bad') {
  $newPost = $database
  ->getReference($date)
  ->push([
     'response' => 'bad',
     'timestamp' => time()
  ]);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    include 'blocks/default_links.html';
  ?>
  <title>OsmAnd Survey</title>
</head>
<body>
  <style>
    .content {
     margin-top: 100px;
     margin-left: auto;
     margin-right: auto;
     width: 50em
    }

    .headline {
     font-size: 35px;
     font-size: 1.82vw;
     font-style: bold;
     margin-left: 100px;
     margin-right: 100px;
     margin-top: 20px
     width: 80em
    }
    
    .main_text {
     font-size: 16px;
     font-size: 0.83vw;
    }
  </style>
  <div class="content">
      <img src="./images/img_messages.png" alt="Message" align="left" style="width:200px;height:50%;margin-right:50px;">
      <div class="headline">
        <p>Thank you for the feedback!</p>
      </div>
      <div class="main_text">
        <?php
        if ($_GET["response"] == 'bad') {
          echo "<p>Oh no! Something went wrong and you did not receive proper help? Please email us (<a href=\"mailto:contactus@osmand.net\">contactus@osmand.net</a>) and we will check the issue as soon as possible.</p>";
        }
        else {
          echo "<p>We are striving to make our support service better and faster!</p>";
        }
        ?>
      </div>
      <img src="./images/logo-grey.png" alt="Logo" style="width:150px;height:50%;margin-top:20px">
  </div>
</body>
</html>
