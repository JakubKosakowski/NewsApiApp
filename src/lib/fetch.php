<?php

use jcobhams\NewsApi\NewsApi;

function fetchArticles($q, $source) {
    $newsapi = new NewsAPI(getApiKey());
    $topHeadlines = $newsapi->getEverything($q, $source);
    $articles = $topHeadlines->articles;
    return $articles;
}

?>
