<?php
require_once '../vendor/autoload.php';
require "lib/common.php";
require "lib/install.php";

session_start();

use jcobhams\NewsApi\NewsApi;

$newsapi = new NewsAPI(getApiKey());

$selectedCountry="us";
if(isset($_GET['country'])) {
  $selectedCountry = $_GET['country'];
}

// $trumpHeadlines = $newsapi->getTopHeadLines($q="trump");
// var_dump($trumpHeadlines->articles);

$usTopHeadlines = $newsapi->getTopHeadLines($country=$selectedCountry);
$articles = $usTopHeadlines->articles;
var_dump($articles[0]);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <?php require "../src/templates/navbar.php"; ?>
    <h1>Hello, world!</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <div class="container">
      <?php foreach($articles as $article): ?>
        <?php if($article->title != "[Removed]"): ?>
          <h1><?=$article->title?></h1>
          <h3><?=$article->source->name?></h3>
        <?php endif ?>
      <?php endforeach ?>
    </div>
  </body>
</html>
