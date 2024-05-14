<?php
require_once 'inc/db.php';
require_once 'inc/functions.php';
session_start();
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    if(!empty($_GET['name']) || !empty($_GET['username'])) {
        $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
        $req->execute(['username' => $_POST['username']]);
        $user = $req->fetch();
        if(@password_verify($_POST['password'],$user->password)) {
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = 'Vous etes maintenant connecté';
            header('location: projet/index.php');
            exit();
        } else {
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
        }
    } else { 
        $req = $pdo->prepare('SELECT * FROM administrateur WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
        $req->execute(['username' => $_POST['username']]);
        $user = $req->fetch();
        if(@password_verify($_POST['password'],$user->password)) {
            $_SESSION['admin'] = $user->username;
            $_SESSION['flash']['success'] = 'Vous etes maintenant connecté';
            header('location: admin/index.php');
            exit();
        } else {
            throw new Exception('Accès interdit');
        }
    }
 } else {
    if(!empty($_GET['username'])) {
        $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
        $req->execute(['username' => $_GET['username']]);
        $user = $req->fetch();
        if(@password_verify($_GET['password'],$user->password)) {
            $_SESSION['auth'] = $user;
            //$_SESSION['flash']['success'] = 'Vous etes maintenant connecté';
            header('location: projet/index.php');
            exit();
        } else {
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
        }
    } 
}
$title = 'Sign-In';
require 'header.php';
?>
<div class="col-4 pb-md-4 mx-auto text-center">
    
<div class="p-5 pb-md-4 mx-auto text-center">
    <form class="form-control" action="" method="post">
    <h1 class="display-5 fw-normal text-start">Sign in</h1>
        <div class="form-group ">
            <label for="">Username or Email Address</label><br>
            <input type="text" name="username" class="form-control border-dark-subtle border" autofocus>
        </div>
    
        <div class="form-group">
            <label for="">Password</label><br>
            <input type="password" name="password" class="form-control border-dark-subtle">
        </div>
        <br>
        <button type="submit" class="w-50 btn btn-primary">Register</button>
        <p >By continuing, you agree to the Prime <a class="link-primary text-decoration-none" herf="#">Conditions of Use and Privacy Notice</a>.</p>
        <button type="button" class="btn" >
            <a class="icon-link icon-link-hover link-underline-opacity-25 text-decoration-none" >
                Need help?
                <svg xmlns="svg/arrow-right.svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                </svg>
            </a>
        </button> 
        </form></br>
        <p class="line-divide"><span> New to Prime? </span></p>
        <button type="submit" class="w-100 btn btn-md border btn-light"><a class="nav-link" href="Sign_up.php?name=<?=@$_GET['name']?>">Create your Prime account</a></button>
</div>
</div>
<?php require 'footer.php' ?>