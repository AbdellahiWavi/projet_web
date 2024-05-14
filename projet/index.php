<?php
require '../inc/functions.php';
require '../inc/db.php';
session_start();
@$nom_film = $_FILES['img']['name'];
@$tmp_film = $_FILES['img']['tmp_name'];
@$video = $_FILES['film']['name'];
@$tmp_vid = $_FILES['film']['tmp_name'];
@$src = "assets/films/".$nom_film;
(!empty($video)) ? @$url = "lirefilms/films/".$video : @$url = '';
@$type_film = explode(".", $nom_film)[1];
@$correct = array("png","jpg","jpeg");
if(!empty($_SESSION['admin'])) {
  if(isset($nom_film)) {
    if(in_array($type_film, $correct)) {
      move_uploaded_file($tmp_film,$src);
      move_uploaded_file($tmp_vid,$url);
      $req = $pdo->prepare('INSERT INTO films SET nom_film = ?, src = ?, date_sortie = ?, vue = ?, duration = ?, note = ?, url = ?, Description = ?, diffusion = ?');
      if($_POST['diffusion'] === 'SERIE TV'){
        $res = $req->execute([$_POST['nom'],$src,$_POST['annee'],$_POST['vue'],$_POST['duration'],$_POST['note'],$url,$_POST['message'],$_POST['diffusion'].'-'.$_POST['nom']]);
      } 
      elseif($_POST['diffusion'] === 'episode'){
        $res = $req->execute([$_POST['nom'],$src,$_POST['annee'].'-'.$_POST['nom'],$_POST['vue'],$_POST['duration'],$_POST['note'],$url,$_POST['message'],$_POST['diffusion']]);
      }
      else {
        $res = $req->execute([$_POST['nom'],$src,$_POST['annee'],$_POST['vue'],$_POST['duration'],$_POST['note'],$url,$_POST['message'],$_POST['diffusion']]);
      }
      if($res) {
        $_SESSION['flash']['success'] = "le fichier est chargé avec success";
        header("location: ../admin/index.php?ajouter");
        exit();
      }
    } else {
        $_SESSION['flash']['danger'] = "le fichier charger est invalide";
        header("location: ../admin/index.php?ajouter");
        exit();
    }
  }
}
$req = $pdo->prepare('SELECT * FROM films');
$req->execute();
$res = $req->fetchAll();
$result = $req->rowCount();

logged_only('auth');
require 'header.php';
?>
<br>
 <main>
    <article>
<!--------------------------------1er section-------------------------------------->
      <!-- 
        - #HERO
      -->
        <section class="hero">  
        <div class="container">
          <div class="hero-content"><br><br><br>
            <h1 class="h1 hero-title">
              Suivez les dernières actualités ,<strong>films</strong> Et programmes de divertissement & En plus
            </h1>
            <div class="meta-wrapper">
              <div class="badge-wrapper">                
                <div class="badge badge-outline">4K</div>
                <div class="badge badge-outline">HD</div>
              </div>
              <div class="ganre-wrapper">
                <a href="#">FILMS,</a>

                <a href="#">SPORTS</a>
              </div>
            </div>
            <button class="btn btn-primary" onclick="document.location='#regarder'">
              <ion-icon name="play"></ion-icon>
              <span>Regarder</span>
            </button>
          </div><br><br><br>

        </div>
      </section>
<!--------------------------------2eme section-------------------------------------->
      <!-- 
        - #UPCOMING------------A VENIR
      -->
      <section class="upcoming" id="regarder">
        <div class="container">
          <div class="flex-wrapper">
            <div class="title-wrapper">
              <p class="section-subtitle">Diffusion en ligne</p>
              <h2 class="h2 section-title">Films à venir</h2>
            </div>
            <ul class="filter-list">
              <li>
                <button class="filter-btn" onclick="document.location='#films'">Mieux Notés</button>
              </li>
              <li>
                <button class="filter-btn" onclick="document.location='#directe'">TV En Directe</button>
              </li>
              <li>
                <button class="filter-btn" onclick="document.location='#series'">Series</button>
              </li>
            </ul>
          </div>
          <ul class="movies-list  has-scrollbar">
          <?php 
            $i = 0;
            $j = $result;
              while($result){
                if($res[$i]->diffusion === 'liste') {
                  movie_card($res[$i]->src, $res[$i]->nom_film, $res[$i]->date_sortie);
                }
              $result--;
              $i++;
            }
            ?>
          </ul>
        </div>
      </section>

<!--------------------------------3er section-------------------------------------->

<!--------------------------------4er section-------------------------------------->
      <!-- 
        - #TOP RATED           Mieu Note-->
      <section class="top-rated" id="films">
        <div class="container">
          <p class="section-subtitle">DIFFUSION EN LIGNE</p>
          <h2 class="h2 section-title">Films Les Mieux Notés</h2>
          <ul class="movies-list">
            <?php 
            $i = 0;
            $k = $j;
              while($j){
                if($res[$i]->diffusion === 'Mieux Notes') {
                  movie_duration($res[$i]->src, $res[$i]->nom_film, $res[$i]->date_sortie,$res[$i]->vue, $res[$i]->duration, $res[$i]->note, $res[$i]->id_films);
                }
              $j--;
              $i++;
            }
            ?>
          </ul>
        </div>
      </section>
<!--------------------------------5eme section-------------------------------------->
 <!-- 
        - #TV SERIES------------TV DIRECTE
      -->
      <section class="tv-series" id="directe">
        <div class="container">
          <p class="section-subtitle">TV DIRECTE</p>
          <h2 class="h2 section-title">Regardez les meilleures chaînes de divertissement et de sport</h2>
          <ul class="movies-list">
          <?php 
            $i = 0;
            $h = $k;
              while($k){
                if($res[$i]->diffusion === 'TV DIRECTE') {
                  movie_directe($res[$i]->src, $res[$i]->nom_film,$res[$i]->id_films);
                }
                $k--;
                $i++;
              }
          ?>
          </ul>
        </div>
      </section>
<!--------------------------------6eme section-------------------------------------->
      <!-- 
        - #TV SERIES
      -->
      <section class="tv-series" id="series">
        <div class="container">
          <p class="section-subtitle">MEILLEURE SÉRIE TV</p>
          <h2 class="h2 section-title">Meilleure série télévisée du monde
          </h2>
          <ul class="movies-list">
          <?php 
            $i = 0;
              while($h){
                $diff = explode("-",$res[$i]->diffusion)[0];
                if($diff === 'SERIE TV') {
                  movie_duration($res[$i]->src, $res[$i]->nom_film, $res[$i]->date_sortie, $res[$i]->vue, $res[$i]->duration, $res[$i]->note, $res[$i]->id_films,'lireserie/serie_tv.php');
                }
              $h--;
              $i++;
            }
          ?>
          </ul>
        </div>
      </section>
<?php require 'footer.php' ?>