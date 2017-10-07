<?php

require "./vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/google-service-account.json');
$apiKey = 'AIzaSyCYcJNbJ4X6irZtS37VYtNJHMxv_nCf0vw';

$firebase = (new Factory)
    ->withServiceAccountAndApiKey($serviceAccount, $apiKey)
    ->withDatabaseUri('https://supportsurvey-72364.firebaseio.com/')
    ->create();

$database = $firebase->getDatabase();

$currMonth = date('M Y');

if ($_GET['answer'] == "good") {
    $newPost = $database
        ->getReference($currMonth)
        ->push([
            'timestamp' => time(),
            'response' => 'good'
        ]);
}
if ($_GET['answer'] == "average") {
    $newPost = $database
        ->getReference($currMonth)
        ->push([
            'timestamp' => time(),
            'response' => 'average'
        ]);
}
if ($_GET['answer'] == "bad") {
    $newPost = $database
        ->getReference($currMonth)
        ->push([
            'timestamp' => time(),
            'response' => 'bad'
        ]);
}
?>
