<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= SCRIPTS .'assets/dist/css/bootstrap.min.css' ?> ">
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/myapp">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link " aria-current="page" href="/myapp">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/myapp/posts">Last articles</a>
                </li>
            </ul>
            </div>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
              <?php  if(isset($_SESSION['auth']) && $_SESSION['auth']!=0): ?>
                <li class="nav-item">
                  <a class="nav-link" href="/myapp/logout">Logout</a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link " aria-current="page" href="/myapp/login">Connexion</a>
                </li>
              <?php endif ?>
            </ul>
        </div>
    </nav>
    <div class="container">
    
        <?= $content ?>

    </div>

    <footer>

    </footer>
    
    <script src="<?= SCRIPTS .'assets/dist/js/bootstrap.bundle.min.js' ?>"></script>
</body>
</html>