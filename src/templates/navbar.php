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