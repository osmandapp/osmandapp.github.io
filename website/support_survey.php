<?php
require './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$serviceAccount = ServiceAccount::fromJsonFile('./private/service.json');

$firebase = (new Factory)
->withServiceAccount($serviceAccount)
->withDatabaseUri('https://osmand-1e236.firebaseio.com/')
->create();

$database = $firebase->getDatabase();

$date = date('m Y');

$ip;
if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }

if ($_GET["response"] == 'good') {
  $newPost = $database
  ->getReference('satisfaction_reports/'.$date)
  ->push([
     'response' => 'good',
     'ip' => $ip,
     'timestamp' => time()
  ]);
}
elseif ($_GET["response"] == 'average') {
  $newPost = $database
  ->getReference('satisfaction_reports/'.$date)
  ->push([
     'response' => 'average',
     'ip' => $ip,
     'timestamp' => time()
  ]);
}
elseif ($_GET["response"] == 'bad') {
  $newPost = $database
  ->getReference('satisfaction_reports/'.$date)
  ->push([
     'response' => 'bad',
     'ip' => $ip,
     'timestamp' => time()
  ]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>OsmAnd Support</title>
 </head>
 <body>
  <table width="600px" cellspacing="0" cellpadding="0" border="0" style="margin:auto; padding-top:5%;">
   <tr>
    <td><img src="./images/img_messages.png" style="padding-top:20px;" width="130px" height="130px" alt="Message" /></td>
    <td style="font-size:35px; font-family:arial,helvetica,sans-serif; font-weight:bold; padding-left:50px;" >Thank you for the feedback!</td>
   </tr>
   <tr>
     <td></td>
     <td style="font-size:18px; font-family:arial,helvetica,sans-serif; padding-left:50px;">
      <?php
        if ($_GET["response"] == 'bad') {
          echo "Oh no! Something went wrong and you did not receive proper help? Please email us (<a href=\"mailto:contactus@osmand.net\">contactus@osmand.net</a>) and we will check the issue as soon as possible.";
        }
        else {
          echo "We are striving to make our support service better and faster!";
        }
        ?>
     </td>
   </tr>
   <tr>
     <td></td>
     <td style="padding-left:50px; padding-top:10px">
       <img src="./images/logo-grey.png" width="206px" height="90px" alt="OsmAnd Maps &amp; Navigation" />
      </td>
   </tr>
  </table>
 </body>
</html>
