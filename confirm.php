<?php 
$user_id = $_GET['user_id'];
$id = $_GET['id'];
require 'inc/db.php';
session_start();
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
if(!empty($user_id)){
    $req->execute([$user_id]);
    $user = $req->fetch();
    if($user) {
        $pdo->prepare('UPDATE users SET confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
        $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
        $_SESSION['auth'] = $user; 
        header('location: projet/index.php');
        exit();
    } else {
        $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
        header('Location: Sign_in.php');
        exit();
    }
}
if(!empty($id)){
    $req->execute([$id]);
    $user = $req->fetch();
    if($user) {
        $pdo->prepare('UPDATE users SET confirmed_at = NOW() WHERE id = ?')->execute([$id]);
        $_SESSION['flash']['success'] = ucfirst($_GET['user']).'est renouveler sa abonnement';
        $_SESSION['auth'] = $user; 
        header('location: projet/index.php');
        exit();
    } else {
        $_SESSION['flash']['danger'] = "Cette confirmation est valide une seule fois";
        header('Location: Sign_in.php');
        exit();
    }
}
