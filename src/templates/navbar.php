<?php
$countries = $newsapi->getCountries();
$countriesJSON = json_decode(file_get_contents(dirname(__DIR__)."\countries.json"));
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
          <button class="btn btn-primary dropdown-toggle" type="button" id="country" data-bs-toggle="dropdown" aria-expanded="false">
            <img src=<?="https://newsapi.org/images/flags/$selectedCountry.svg"?> width="20" height="20" class="icon loaded" alt="<?=$countriesJSON->$selectedCountry?>"?>
          </button>
          <ul class="dropdown-menu" id="country_list" aria-labelledby="country" style="min-width: 400px;">
            <?php foreach($countries as $country): ?>
              <li style="display: inline-block">
                <a class="dropdown-item" href="?country=<?=$country?>" title="<?=$countriesJSON->$country?>">
                  <img src=<?="https://newsapi.org/images/flags/$country.svg"?> width="20" height="20" class="icon loaded" alt="<?=$countriesJSON->$country?>"?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </li>
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
