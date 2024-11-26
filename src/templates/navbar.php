<?php
$countries = $newsapi->getCountries();
$languages = $newsapi->getLanguages();
$countriesJSON = json_decode(file_get_contents(dirname(__DIR__)."\countries.json"));
$languagesJSON = json_decode(file_get_contents(dirname(__DIR__)."\languages.json"));
$categories = $newsapi->getCategories();
?>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">NewsApiApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <button class="nav-link dropdown-toggle" id="navbarDropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </button>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach($categories as $category): ?>
              <a class="dropdown-item" href="/category-articles.php?category=<?=$category?>&language=<?=$selectedLanguage?>"><?=ucfirst($category)?></a>
            <?php endforeach ?>
          </div>
        </li>
        <li class="nav-item dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
            <img src=<?="https://newsapi.org/images/flags/".$languagesJSON->$selectedLanguage.".svg"?> width="20" height="20" class="icon loaded"?>
          </button>
          <ul class="dropdown-menu" id="language_list" aria-labelledby="country" style="min-width: 400px;">
            <?php foreach($languages as $language): ?>
              <li style="display: inline-block">
                <a class="dropdown-item" href="?language=<?=$language?>">
                  <img src=<?="https://newsapi.org/images/flags/".$languagesJSON->$language.".svg"?> width="20" height="20" class="icon loaded"?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </li>
        <?php if (str_contains($_SERVER['PHP_SELF'], "category")): ?>
          <form class="form-inline my-2 my-lg-0 d-flex ml-2" method="POST">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        <?php endif?>
      </ul>
      <?php if(isLoggedIn()): ?>
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" href="/logout.php">Logout</a>
                </li>
          </ul>
      <?php else: ?>
          <ul class="navbar-nav">
              <a class="nav-link" href="/login.php"><button class="btn btn-outline-success">Login</button></a>
          </ul>
          <ul class="navbar-nav">
            <a class="nav-link" href="/register.php"><button class="btn btn-outline-success">Register</button></a>
          </ul>
      <?php endif ?>
    </div>
  </div>
</nav>
