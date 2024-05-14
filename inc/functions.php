<?php
function debug($variable){
    echo '<pre class="text-dark">'. print_r($variable,true) .'</pre>';
}
function str_random($length,$alphabet = "0123456789azertyuiopqsdfghjklm<wxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN"){
    return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length);

}
function logged_only($user){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION[$user])) {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('location: ../Sign_in.php');
        exit();
    }
}
function movie_card($src, $nom, $date){
    echo <<<HTML
    <li>
    <div class="movie-card">
        <a href="#regarder">
            <figure class="card-banner">
                <img src="$src" alt="$nom">
            </figure>
        </a>

        <div class="title-wrapper">
            <a href="#regarder">
                <h3 class="card-title">$nom</h3>
            </a>

            <time datetime="$date">$date</time>
        </div>
    </div>
    </li>
HTML;
}
function movie_duration($src, $nom, $date, $badge, $min, $data, $id=null,$lien='lirefilms/film.php'){
    echo <<<HTML
    <li>
        <div class="movie-card">
            <a href="$lien?id=$id">
                <figure class="card-banner">
                <img src="$src" alt="$nom">
                </figure>
            </a>
        <div class="title-wrapper">
            <a href="$lien">
            <h3 class="card-title">$nom</h3>
            </a>
            <time datetime="$date">$date</time>
        </div>
        <div class="card-meta">
            <div class="badge badge-outline">$badge</div>
            <div class="duration">
            <ion-icon name="time-outline"></ion-icon>
            <time datetime="PT.$min.M">$min min</time>
            </div>
            <div class="rating duration">    
            <ion-icon name="star"></ion-icon>
            <data>$data</data>
            </div>
        </div>
        </div>
    </li>
HTML;
}
function movie_directe($src,$nom,$id,$lien="./tv-directe/directe.php"){
    echo <<<HTML
      <li>
        <div class="movie-card">
            <a href="$lien?rev=$id">
                <figure class="card-banner">
                <img src="$src" alt="$nom">
                </figure>
            </a>
            <div class="title-wrapper">
                <a href="$lien?rev=$id">
                <h3 class="card-title">$nom</h3>
                </a>
                <div class="directe">DIRECTE</div>
            </div>
            <div class="card-meta">
                <div class="badge badge-outline">HD</div>
                <div class="duration">              
                <button class="btn btn-primary" onclick="document.location='$lien?rev=$id'">       
                    <span>Regarder</span>
                </button>
                </div>
            </div>
        </div>
      </li>
HTML;
}
function posts($i,$col,$tab){
    require 'db.php';
    $req = $pdo->prepare("select * from $tab");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $res = $req->fetchAll();
    if(!empty($res[$i])){
        return $res[$i][$col];
    } else {
        return false;
    }
}
function validateDate($date, $format = 'm/Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}