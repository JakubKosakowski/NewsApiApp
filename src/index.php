<?php
require_once '../vendor/autoload.php';
require "lib/common.php";
require "lib/install.php";

use jcobhams\NewsApi\NewsApi;

session_start();
$_SESSION['show-countries'] = true;

$newsapi = new NewsAPI(getApiKey());

$selectedLanguage="en";
if(isset($_GET['language'])) {
  $selectedLanguage = $_GET['language'];
}
$i = 1;

$selectedCategory="general";

// $usTopHeadlines = $newsapi->getTopHeadLines($country=$selectedCountry);]
$usTopHeadlines = $newsapi->getTopHeadlines($country="us");
$articles = $usTopHeadlines->articles;

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <div class="container">
      <div class="row">
        <?php foreach($articles as $article): ?>
          <?php if($i == 4): ?>
            </div>
            <div class="row">
            <?php $i = 1; ?>
          <?php endif ?>
          <?php if($article->title != "[Removed]"): ?>
            <div class="col">
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?=$article->urlToImage?>" alt="Article">
                <div class="card-body">
                  <h5 class="card-title"><?=$article->title?></h5>
                  <p class="card-text"><?=$article->description?></p>
                  <a href="<?=$article->url?>" class="btn btn-primary" target=”_blank”>Read article</a>
                </div>
              </div>
            </div>
            <?php $i += 1; ?>
          <?php endif ?>
        <?php endforeach ?>
      </div>
    </div>
    <?php require "templates/footer.php"; ?>
  </body>
</html>
