<?php 
$id = $_GET['id'];
require '../../../inc/functions.php';
require '../../../inc/db.php';
$req = $pdo->prepare('SELECT * FROM films WHERE id_films = ?');
$req->execute([$id]);
$res = $req->fetch();
$actuel = $res;
require '../../header.php';
?>
<main>
  <article>
      <!-- 
        - #MOVIE DETAIL
      -->
<?php if($res->url) : ?>
  <br><br><br>
<section class="movie-detail">
  <div class="container">
    <!-- modiffier cette src -->
    <iframe width="40%" height="360" src="<?= '../../'.$res->url ?>"
    title="<?= $res->nom_film ?>" frameborder="1" 
    allow="accelerometer; autoplay; clipboard-write; 
    encrypted-media; gyroscope; picture-in-picture; web-share" 
    allowfullscreen></iframe>
    <div class="movie-detail-content">

      <p class="detail-subtitle"><?= strtoupper($res->nom_film) ?></p>

      <div class="meta-wrapper">

        <div class="badge-wrapper">
          
          <div class="badge badge-outline"><?= $res->vue ?></div>
        </div>

        <div class="ganre-wrapper">
          

          <a href="#">Film,</a>

          <a href="#">action,</a>

          <a href="#">Thriller</a>
          
        </div>

        <div class="date-time">

          <div>
            <ion-icon name="calendar-outline"></ion-icon>

            <time datetime="2022"><?= $res->date_sortie ?></time>
          </div>

          <div>
            <ion-icon name="time-outline"></ion-icon>

            <time datetime="PT115M"><?= $res->duration ?></time>
          </div>

        </div>

      </div>

      <p class="storyline">
        <?= $res->Description ?>
      </p>

      <div class="details-actions">

        <button class="share">
          <ion-icon name="share-social"></ion-icon>

          <span>Partager</span>
        </button>

        
        <button class="btn btn-primary" onclick="document.location='#plus'">
          <ion-icon name="chevron-down-outline"></ion-icon>
            <span>Voir plus</span>
          
        </button>

      </div>


    </div>

  </div>

</section>

      <!-- 
        - #TV SERIES
      -->

    <section class="tv-series" id="plus">
      <div class="container">
        <p class="section-subtitle">Regardez le meilleur</p>
        <h2 class="h2 section-title">Films</h2>
        <ul class="movies-list">
        <?php 
          $req = $pdo->prepare('SELECT * FROM films');
          $req->execute();
          $res = $req->fetchAll();
          $result = $req->rowCount();
            $i = 0;
            while($result){
              if($res[$i]->diffusion === 'episode') {
                if($res[$i]->nom_film != $actuel->nom_film){
                  movie_duration('../../'.$res[$i]->src, $res[$i]->nom_film, $res[$i]->date_sortie,$res[$i]->vue, $res[$i]->duration, $res[$i]->note, $res[$i]->id_films,'./tv.php');
                }
              }
            $result--;
            $i++;
            }
        ?>
      </div>
    </section>
  </article>
</main>
<?php else : ?>
    <br><br>
  <main>
    <article>
      <section class="movie-detail">
        <p class="detail-subtitle" style="width:100%; text-align:center;">
          <?= strtoupper($res->nom_film) ?>
        </p>
        <div class="container">
          <div class="container">
            <p class="storyline" style="width:100%; text-align:center; color:white; margin:auto">
              Désolè, <?= strtoupper($res->nom_film) ?> n'a pas encore <strong>rajouté</strong> merci pour votre comprhénsion.
            </p>
          </div>
        </div>
      </section>
    </article>
  </main>
<?php endif ?>
<?php require '../../footer.php' ?>