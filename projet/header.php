<?php 
if($_SERVER['SCRIPT_NAME'] === '/projet_web/projet/index.php') {
  $lien = './index.php';
  $contact = '';
  $logout = '../logout.php';
}
elseif($_SERVER['SCRIPT_NAME'] === '/projet_web/projet/lireserie/lire/tv.php'){
  $lien = '../../index.php';
  $contact = '../../';
  $logout = '../../../logout.php';
}
else {
  $lien = '../index.php';
  $contact = '../';
  $logout = '../../logout.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>prision-break</title>
  <link rel="stylesheet" href="style.css">
    <!-- Favicons -->
  <link rel="apple-touch-icon" href="svg/wavi-180.png" sizes="180x180">
  <link rel="icon" href="svg/wavi-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="svg/wavi-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="js/manifest.json">
  <link rel="mask-icon" href="svg/wavi.svg" color="#712cf9">
  <link rel="icon" href="svg/wavi-32x32.ico">
  <meta name="theme-color" content="#712cf9">
    
  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

        <a href="<?= $lien ?>" class="logo" text-color="#fff">
          VISION
        </a>

        <div class="header-actions">

            <button class="search-btn">
              <ion-icon name="search-outline"></ion-icon>
            </button>

          <div class="lang-wrapper">
              <select name="language" id="language">
                <option value="en">FR</option>
              </select>
          </div>
          <button class="btn btn-primary"><a style="color: #fff" href="<?= $logout ?>">Logout</a></button>
        </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <!--------------part top---------------------->

        <div class="navbar-top">

          <a href="<?= $lien ?>" class="logo" >
            VISION
          </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>
        <ul class="navbar-list">
          <li>
            <a href="<?= $lien ?>" class="navbar-link">Home</a>
          </li>
          <li>
            <a href="<?= $lien ?>#films" class="navbar-link">Films</a>
          </li>
          <li>
            <a href="<?= $lien ?>#series" class="navbar-link">Series</a>
          </li>
          <li>
            <a href="<?= $lien ?>#directe" class="navbar-link">TV Directe</a>
          </li>
          <li>
            <a href="<?= $contact ?>contact/contact.php" class="navbar-link">Contact</a>
          </li>
        </ul>
        <ul class="navbar-social-list">
          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>
          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>
          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>
          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>