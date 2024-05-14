<?php
$id = $_GET['id_films'];
session_start();
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/db.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/functions.php';
$req = $pdo->prepare('SELECT * FROM films WHERE id_films = ?');
$req->execute([$id]);
$film = $req->fetch();
#modifier le film correspondant
if(!empty($_POST)) {
    @$nom = $_FILES['img']['name'];
    @$tmp = $_FILES['img']['tmp_name'];
    @$video = $_FILES['vid']['name'];
    @$tmp_vid = $_FILES['vid']['tmp_name'];
    @$src = "assets/films/".$nom;
    (!empty($video)) ? @$url = "lirefilms/films/".$video : @$url = '';
    @$type = explode(".", $nom)[1];
    @$correct = array("png","jpg","jpeg");
    if(in_array($type, $correct)) {
        move_uploaded_file($tmp,'../projet/'.$src);
        move_uploaded_file($tmp_vid,'../projet/'.$url);        
        $req = $pdo->prepare('UPDATE films SET nom_film = :nom, src = :src, date_sortie = :date, vue = :vue, duration = :duree, note = :note, url = :url, Description = :des WHERE id_films = :id');
        $req->execute(['nom'=>$_POST['nom'],'src'=>$src,'date'=>$_POST['annee'],'vue'=>$_POST['vue'],'duree'=>$_POST['duration'],'note'=>$_POST['note'],'des'=>$_POST['message'],'url'=>$url,'id'=>$id]);
        $_SESSION['flash']['success'] = 'Le film a bien été modifié';
        header('location: index.php?afficher');
        exit();
    } else {
        $_SESSION['flash']['danger'] = "Erreur de chargement ou fichier invalide";
        header('location: modifier.php?id_films='.$id);
        exit();
    } 
} 
?>
<?php require 'header.php' ?>
<div class="container">    
    <div class="alert alert-info">
        Bienvenue <?= $_SESSION['admin'] ?>
    </div><br>
</div>
<form action="modifier.php?id_films=<?= $id ?>" method="post" enctype="multipart/form-data">
    <table align="center">
        <tr>
            <td><label for="">Image</label><input type="file" name="img"></td>
            <td><label for="">Filmes_Serie</label><input type="file" name="vid"></td>
            <td><input type="text" name="nom" value="<?= $film->nom_film ?>" required></td>
        </tr>
        <tr>
            <td><input type="text" name="annee" value="<?= $film->date_sortie ?>"></td>
            <td><input type="text" name="duration" value="<?= $film->duration ?>"></td>
            <td><input type="text" name="vue" value="<?= $film->vue ?>"><td>
        </tr>
        <tr >
                <td><input type="text" name="note" value="<?= $film->note ?>"></td>
                <td>
                    <textarea name="message" style="width: 400px; height: 79px;">
                        <?= $film->Description ?>
                    </textarea>
                </td>
                <td align="center">
                    <button type="submit" name="valider" style="width: 35%" class="btn btn-primary">
                        charger
                    </button>
                </td>
        </tr>
    </table>
    </form>