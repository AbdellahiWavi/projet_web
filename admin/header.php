<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php if(isset($title)){echo $title;}else {echo 'vision';} ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Abdellahi El Wavi">
    
    <!-- Favicons -->
<link rel="apple-touch-icon" href="svg/wavi-180.png" sizes="180x180">
<link rel="icon" href="svg/wavi-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="svg/wavi-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="js/manifest.json">
<link rel="mask-icon" href="svg/wavi.svg" color="#712cf9">
<link rel="icon" href="svg/wavi-32x32.ico">
<meta name="theme-color" content="#712cf9">
    <!-- Le styles -->
    <link href="css/style2.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/style.css" rel="stylesheet">
</head>

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a> 
          <a class="brand" href="./index.php"><?= strtoupper($_SESSION['admin']) ?></a>
          <div class="nav-collapse">
            <ul class="nav">
              <?php if($_SESSION['admin'] === 'abdellahi'): ?>
              <li class="">
                <a class="nav-link" href="../Sign_up.php?admin=abdellahi">Ajouter un admin</a>
              </li>
              <li class="">
                <a class="nav-link" href="admin.php">Afficher les Admins</a>
              </li>
              <?php endif ?>
              <li>
                <a class="nav-link" href="logout.php">Se déconnecter</a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
      <?php if(isset($_SESSION['flash'])): ?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type ?>">
              <?= $message ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']) ?>
      <?php endif ?>
    </div>