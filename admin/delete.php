<?php
session_start();
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/db.php';

#suppression de l'utilisateur 
$req = $pdo->prepare('DELETE FROM users WHERE id = ?');
$res = $req->execute([$_GET['id']]);
#suppression de l'administrateur 
$req = $pdo->prepare('DELETE FROM administrateur WHERE admin = ?');
$res = $req->execute([$_GET['admin']]);
#suppression du film 
$req = $pdo->prepare('DELETE FROM films WHERE id_films = ?');
$res = $req->execute([$_GET['id_films']]);

#afficher le confirmation
if($_GET['id']){
    $_SESSION['flash']['success'] = "L'utilisateur à bien été supprimé.";
    header('location: index.php?users');
    exit();
} elseif($_GET['admin']){
    $_SESSION['flash']['success'] = "L'admin à bien été supprimé.";
    header('location: admin.php');
    exit();
} elseif($_GET['id_films']){
    $_SESSION['flash']['success'] = "Le film à bien été supprimé.";
    header('location: index.php?afficher');
    exit();
}
#cas contraire
