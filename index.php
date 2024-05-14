<?php
$title="HOME Page";
require 'header.php';
?> 
</div>
<style>:root{font-size:100%;background-color:#00050d;}</style>
<style>
  #dv-c494NzF_e {
    height:96vh ;
    background-image:
      linear-gradient(
        to right,
        #00050d 40%,
        transparent 58%
      ),
      url(images/film.jpg);
    background-position: right top;
    background-size: cover;
    background-repeat: no-repeat;
    background-color: black;
    
  }
  #dv-c494NzF_e .mobile-bg-placeholder {
    background-image: none;
    background-repeat: no-repeat;
  }

  @media all and (max-width: 1024px) {
    #dv-c494NzF_e {
      background-size: cover;
    }
  }

  @media all and (max-width: 1024px) and (orientation: portrait) {
    #dv-c494NzF_e {
      background-color: black;
      background-image: none;
    }
    #dv-c494NzF_e .mobile-bg-placeholder {
      background-image:  linear-gradient(to top, black 0%, transparent 20%),
      url(images/film1.jpg);
    }
  }
</style>
<div class="welcome-banner" id="dv-c494NzF_e">
  <div class="row ps-5">
    <div class="col-sm-8 col-lg-5 left-sidebar">
      <h1>Welcome to vision</h1>
      <h4 >Join vision to watch the latest movies,exclusive TV showsas well as award-winning Amazon Originals</h4>
      <div class="row ">
        <div class="col-sm-7 text-center cta-block">
          <button type="button" class="btn btn-primary w-100"><a class="nav-link" href="Sign_in.php?name=month">Join Prime at $5.99 per month</a></button>
          <p>With any credit card or select debit cards</p>
          <p class="line-divider"><span> or </span></p>
          <button type="button" name="year" class="btn btn-primary w-100"><a class="nav-link" href="Sign_in.php?name=year">Join Prime at $47.88 per year</a></button>
          <p class="fs-6">With any credit card or select debit cards</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="banner-image-left">
    <div class="row ps-5">
      <div class="col-sm-offset-7 col-sm-5 right-sidebar cta-block-button">
        <h1>Great Entertainment</h1>
        <h4>With your Prime membership, you have access to exclusive Amazon Originals, blockbuster Bollywood movies.</h4>
        <button type="button" class="btn btn-primary">Get Started</button>
      </div>
    </div>
  </div>     

<div class="wrapper bg-white text-black pb-5">
  <div class="row text-center banner-middle">
    <div class="col-sm-4">
      <img src="https://i.postimg.cc/DwWRqWWh/1.png" alt="image" class="img-fluid"> 
      <h1>Watch anywhere</h1>
      <p>
        Enjoy from the web or with the Prime Video app on your phone, tablet, or select Smart TVs — on up to 3 devices at once.</p>
    </div>

    <div class="col-sm-4">
      <img src="https://i.postimg.cc/SN1w2LxV/2.jpg" alt="image" class="img-fluid">
      <h1>Download and go</h1>
      <p>Watch offline on the Prime Video app when you download titles to your iPhone, iPad, Tablet, or Android device</p>
    </div>
    <div class="col-sm-4">
      <img src="https://i.postimg.cc/zG96pJWg/3.png" alt="image" class="img-fluid">
      <h1>Data Saver</h1>
      <p>Control data usage while downloading and watching videoson select phones or tablets.</p>
    </div>
  </div>
</div>
</div>
<?php require 'footer.php' ?>