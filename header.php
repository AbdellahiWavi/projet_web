<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Abdellahi El Wavi">
    <title><?= $title ?></title>

    <link href="css/min.css" rel="stylesheet" >

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="svg/wavi-180.png" sizes="180x180">
    <link rel="icon" href="svg/wavi-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="svg/wavi-16x16.png" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="svg/wavi.svg" color="#712cf9">
    <link rel="icon" href="svg/wavi-32x32.ico">
    <meta name="theme-color" content="#712cf9">
  <!-- Custom styles for this template -->
<link href="css/pricing.css" rel="stylesheet">
</head>
<body>
<div class="container">
  <header>
    <?php if($_SERVER['SCRIPT_NAME']==='/projet_web/index.php') : ?>
    <div class="col-7 col-sm-7 col-md-7 d-flex flex-column flex-md-row align-items-center pb-3 mb-0">
      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a href="index.php" class="me-auto py-2 link-tertiary text-decoration-none">
          <span class="fs-3" >Vision</span>
        </a>
        <!-- Button trigger modal -->
        
        <button type="button" class="btn btn-black text-white ms-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <svg xmlns="svg/person-circle.svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
          </svg>  
        </button>

      <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title text-dark" id="staticBackdropLabel">Sign in</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
              <form class="form-control" method="get" action="Sign_in.php">
                  <div class="modal-title">  
                      <label for="" class="modal-title">Username or Email Address</label><br>
                      <input type="text" name="username" class="form-control">
                  </div>
                  <div class="modal-title">
                      <label for="" >Password</label><br>
                      <input type="password" name="password" class="form-control">
                  </div>  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <?php else : ?>
    <div class="row justify-content-center ">
      <div class="col-md-3 d-flex flex-column flex-md-row align-items-center">
        <div class=" text-center">
          <a href="index.php" class="d-flex align-items-center mx-auto py-2 link-body-emphasis text-decoration-none">
            <img class="me-2" src="svg/wavi.svg" alt="" width="40" height="32">
            <span class="fs-4">vision</span>
          </a>
        </div>
      </div>
    </div>
    <?php endif ?>
  </header>
</div>
<?php if(isset($_SESSION['flash'])): ?>
  <div class="container">  
    <?php foreach($_SESSION['flash'] as $type => $message): ?>
        <div class="alert alert-<?= $type; ?>">
          <?= $message; ?>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
  </div>
<?php endif ?>