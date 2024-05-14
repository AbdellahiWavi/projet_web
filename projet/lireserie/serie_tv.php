<?php 
$id = $_GET['id'];
require '../../inc/functions.php';
require '../../inc/db.php';
$req = $pdo->prepare('SELECT * FROM films WHERE id_films = ?');
$req->execute([$id]);
$res = $req->fetch();
$actuel = $res;
$episod = @explode("-",$actuel->diffusion)[1];

logged_only('auth');
require '../header.php';
?>
  <main>
    <article>
      <!-- 
        - #TV SERIES
      -->
      <br>
      <?php if($episod != null) : ?>
      <section class="tv-series" id="series">
        <div class="container"> <br><br>
          <h2 class="h2 section-title"><?= $actuel->nom_film ?></h2>
          <ul class="movies-list">
          <?php
          $req = $pdo->prepare('SELECT * FROM films');
          $req->execute();
          $res = $req->fetchAll();
          $result = $req->rowCount();
          $i = 0;
            while($result){
              $epised = @explode("-",$res[$i]->date_sortie)[1];
              if($epised === $episod) {
                movie_duration('../'.$res[$i]->src, $res[$i]->nom_film, $res[$i]->date_sortie,$res[$i]->vue, $res[$i]->duration, $res[$i]->note, $res[$i]->id_films,'./lire/tv.php');
              }
            $result--;
            $i++;
            }
            ?>
          </ul>
        </div>
      </section>
      <?php else : ?>
        <br><br><br>
        <section class="movie-detail">
          <div class="container"> <br><br>
          <h2 class="h2 section-title" style="width:100%;color:#4CA0F9"><?= strtoupper($res->nom_film) ?></h2>
            <div class="container">
              <p class="storyline" style="color: white;width:100%; text-align:center">
                Désolè, <?= strtoupper($res->nom_film) ?> n'a pas encore rajouté merci pour votre comprhénsion. 
              </p>
            </div>
          </div>
        </section>
      <?php endif ?>
      
<?php require '../footer.php' ?>