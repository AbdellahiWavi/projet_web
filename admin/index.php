<?php
session_start();
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/functions.php';
logged_only('admin');
$title = 'Administration';
require 'header.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/db.php';
?>
<div class="container">
    <div class="alert alert-info">
        Bienvenue <?= $_SESSION['admin'] ?>
    </div><br>
    <?php if($_SERVER['REQUEST_URI'] === '/projet_web/admin/index.php'): ?>
    <div class="row-fluid mb-3 text-center">
        <h4>Voici les utilisateurs qui sont abonnées</h4>
        <p >Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus voluptas accusamus voluptatibus tempore ratione, cupiditate odit mollitia iure dolore magni eaque reiciendis repudiandae fugit neque delectus necessitatibus praesentium soluta a.</p>
        <button style="width: 35%" class="btn btn-primary" onclick="document.location=' ./?users'">
            <ion-icon name="play"></ion-icon>
            <span>utilisateur</span>
        </button>
    </div><br><br>
    <div class="row-fluid mb-3 text-center">
        <h4>Voici les films et les series de TV qui sont existes</h4>
        <p >Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus voluptas accusamus voluptatibus tempore ratione, cupiditate odit mollitia iure dolore magni eaque reiciendis repudiandae fugit neque delectus necessitatibus praesentium soluta a.</p>
        <button style="width: 35%; " class="btn btn-secondary" onclick="document.location='./?afficher'">
        <ion-icon name="play"></ion-icon>
        <span>Afficher Filmes_Serie TV</span>
        </button>
    </div><br><br>
    <?php else : ?>
    <div class="container">
        <button style="width: 35%" class="btn btn-primary" name="users" onclick="document.location=' ./?users'">
            <ion-icon name="play"></ion-icon>
            <span>utilisateur</span>
        </button>
        <button class="btn btn-info" onclick="document.location='./?afficher'">
            <ion-icon name="play"></ion-icon>
            <span>Afficher Filmes_Serie TV</span>
        </button>
    </div>
    <?php endif ?>
<?php if(isset($_GET['users'])): ?>
    <table class="table">
        <thead>
            <th>#ID_Utilisateur</th>
            <th>Nom_Utilisateur</th>
            <th>E-mail ou Contact</th>
            <th>payé</th>
            <th>Date_Confirmation</th>
            <th>Expire_abonnee</th>
            <th style='text-align: center'>Actions</th>
        </thead>
        <tbody>
                <?php 
                $i=0; 
                while(posts($i,'id','users')) { ?>    
                <tr>
                    <td><?='#'.posts($i,'id','users') ?></td>
                    <td><?= posts($i,'username','users') ?></td>
                    <td><?= posts($i,'email','users') ?></td>
                    <td><?= posts($i,'payment','users') ?></td>
                    <td><?= posts($i,'confirmed_at','users') ?></td>
                    <td><?= (posts($i,'payment','users') === 5.99.'$') ? date('Y-m-d H:m:s',strtotime(posts($i,'confirmed_at','users').'+30 day')) : date('Y-m-d H:m:s',strtotime(posts($i,'confirmed_at','users').'+365 day')) ?></td>
                    <td style='text-align: center'>
                    <a class="btn btn-primary" href="message_alert.php?id=<?= posts($i, 'id','users') ?>">
                        Message_alert
                    </a>
                    <?php if($_SESSION['admin'] === 'abdellahi'): ?>
                        <a class="btn btn-danger" href="delete.php?id=<?= posts($i, 'id','users') ?>"
                        onclick ="return confirm('voulez vous suppimer cet utilisateur ?')">
                        Supprimer
                        </a>
                    <?php endif ?>
                    </td>
                </tr>
                <?php $i++;
                } ?>
        </tbody>
        </table>
<?php endif ?>
<?php if(isset($_GET['afficher'])): ?>
    <table class="table">
        <thead>
            <th>#ID_Film</th>
            <th>Nom_film</th>
            <th>date du sortie</th>
            <th>vue</th>
            <th>duration</th>
            <th>note</th>
            <th style='text-align: center'>Actions</th>
        </thead>
        <tbody>
            <?php 
            $i=0; 
            while(posts($i,'id_films','films')) { ?>    
            <tr>
                <td><?='#'.posts($i,'id_films','films') ?></td>
                <td><?= posts($i,'nom_film','films') ?></td>
                <td><?= posts($i,'date_sortie','films') ?></td>
                <td><?= posts($i,'vue','films') ?></td>
                <td><?= posts($i,'duration','films') ?></td>
                <td><?= posts($i,'note','films') ?></td>
                <td style='text-align: center'>
                <a class="btn btn-primary" href="modifier.php?id_films=<?= posts($i, 'id_films','films') ?>">
                    Modiffier
                </a>
                <?php if($_SESSION['admin'] === 'abdellahi'): ?>
                    <a class="btn btn-danger" href="delete.php?id_films=<?= posts($i, 'id_films','films') ?>"
                    onclick ="return confirm('voulez vous suppimer cet utilisateur ?')">
                    Supprimer
                    </a>
                <?php endif ?>
                </td>
            </tr>
            <?php $i++;
            } ?>
        </tbody>
        <tfooter>
            <tr>
                <td colspan="3">
                    <center>
                        <button style="width: 40%" class="btn btn-secondary" onclick="document.location='./?ajouter'">
                            <ion-icon name="play"></ion-icon>
                            <span>Ajouter Filmes_Serie TV</span> 
                        </button>
                    </center>
                <td>
                <td colspan="5">
                    <center>
                        <button style="width: 50%" class="btn btn-secondary" onclick="document.location='./?ajouter_tv'">
                            <ion-icon name="play"></ion-icon>
                            <span>Ajouter TV_DIRECTE</span> 
                        </button>
                    </center>
                <td>
            </tr>
        </tfooter>
    </table>
<?php endif ?>
<?php if(isset($_GET['ajouter']) || isset($_GET['ajouter_tv'])): ?>
    <br>
    <form action="../projet/index.php" method="post" enctype="multipart/form-data">
    <table align="center">
        <tr>
            <td>
                <label>Image :</label>
                <input type="file" name="img">
            </td>
            <?php if(!isset($_GET['ajouter_tv'])) : ?>
                <td>
                    <label>Filmes_Serie :</label>
                    <input type="file" name="film">
                </td>
            <?php endif ?>
            <td>
                <select name="diffusion" >
                    <option value="liste">Films a venir</option>
                    <option value="Mieux Notes">Mieux Notés</option>
                    <option value="TV DIRECTE">TV DIRECTE</option>
                    <option value="SERIE TV">SERIE TV</option>
                    <option value="episode">episode</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="text" name="nom" placeholder="nom du film" required></td>
            <td><input type="text" name="annee" placeholder="annee du sortir"></td>
            <td><input type="text" name="duration" placeholder="la duree du film"></td>
            
        </tr>
        <tr>
            <td><input type="text" name="vue" placeholder="Vue du film"></td>
            <td>
                <textarea name="message" style="width: 400px; height: 79px;">
                ajouter une description du film
                </textarea>
            </td>
            <td><input type="text" name="note" placeholder="Evaluation du film"></td> 
        </tr>
            
        <tr>
            <td colspan="3" align="right">
                <button type="submit" class="btn btn-primary" style="width: 30%">
                    charger
                </button>
            </td>
        </tr>

    </table>
    </form>
    <br><br>
        <tr>
            <td colspan="3" rowspan="4" align="center">
                <center><b>Vous pouvez aussi afficher les liste des films</b></center>
                <center>
                    <button style="width: 40%" class="btn btn-secondary" onclick="document.location='./?afficher'">
                        <ion-icon name="play"></ion-icon>
                        <span>Afficher Filmes_Serie TV</span>
                    </button>
                </center>
            </td>
        </tr>
<?php endif ?>