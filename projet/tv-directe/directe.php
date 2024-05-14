<?php 
$id = @$_GET['rev'];
require '../../inc/functions.php';
require '../../inc/db.php';
$req = $pdo->prepare('SELECT * FROM films WHERE id_films = ?');
$req->execute([$id]);
$res = $req->fetch();
$actuel = $res;
require '../header.php';
?>
<main>
  <article>
      <!-- 
        - #MOVIE DETAIL
      -->
<?php if(!empty($res->url)) : ?>
  <br><br><br><br>
<section class="movie-detail">
  <div class="container">
    <!-- modiffier cette src -->
    <iframe width="100%" height="360" src="<?= @$res->url ?>" 
      title="<?= @$res->nom_film ?>" frameborder="0" 
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; 
      picture-in-picture; web-share" allowfullscreen>
    </iframe>
    <div class="movie-detail-content">

      <p class="detail-subtitle"><?= @strtoupper($res->nom_film) ?></p>

      <div class="meta-wrapper">

        <div class="badge-wrapper">
          
          <div class="badge badge-outline"><?= @$res->vue ?></div>
        </div>

        <div class="ganre-wrapper">
          

          <a href="#">Film,</a>

          <a href="#">action,</a>

          <a href="#">Thriller</a>
          
        </div>

        <div class="date-time">

          <div>
            <ion-icon name="time-outline"></ion-icon>
            <div class="directe"><?= @strtoupper($res->duration) ?></div>
          </div>

        </div>

      </div>

      <p class="storyline">
        <?= @$res->Description ?>
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
          <p class="section-subtitle">TV DIRECTE</p>
          <h2 class="h2 section-title">Regardez le meilleur</h2>
          <ul class="movies-list">
          <?php 
            $req = $pdo->prepare('SELECT * FROM films');
            $req->execute();
            $res = $req->fetchAll();
            $result = $req->rowCount();
              $i = 0;
              $j = $result;
              while($j){
                if($res[$i]->diffusion === 'TV DIRECTE') {
                  if($res[$i] != $actuel){
                    movie_directe('../'.$res[$i]->src, $res[$i]->nom_film, $res[$i]->id_films,'./directe.php');
                  }
                }
              $j--;
              $i++;
              }
          ?>
      </div>
    </section>
  </article>
</main>
<?php else : ?>
  <main>
    <article>
      <section class="movie-detail">
        <p class="detail-subtitle" style="width:100%; text-align:center;">
          <?= @strtoupper($actuel->nom_film) ?>
        </p>
        <div class="container">
          <div class="container">
            <p class="storyline" style="color: white;width:100%; text-align:center">
              Désolè, <?= @strtoupper($actuel->nom_film) ?> n'a pas encore rajouté merci pour votre comprhénsion.
            </p>
          </div>
        </div>
      </section>
    </article>
  </main>
<?php endif ?>
<?php require '../footer.php' ?>