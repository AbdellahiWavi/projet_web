<?php 
$user_id = $_GET['admin'];
$token = $_GET['token'];
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/db.php';
$req = $pdo->prepare('SELECT * FROM administrateur WHERE admin = ?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();

if($user && $user->confirmation_token == $token){
    
    $pdo->prepare('UPDATE administrateur SET confirmation_token = NULL ,confirmed_at = NOW() WHERE admin = ?')->execute([$user_id]);
    $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
    $_SESSION['admin'] = $user->username; 
    header('location: index.php');
    
} else {
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header('Location: ../Sign_in.php');
}