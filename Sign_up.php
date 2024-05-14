<?php
require_once 'inc/functions.php';
session_start();
if(!empty($_POST)){
    $errors = array();
    require_once 'inc/db.php';
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
    } else {
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if($user){
            $errors['username'] = 'Ce pseudo est déjà pris';
        }
    }

    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Votre email n'est pas valide";
    } else {
         $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
         $req->execute([$_POST['email']]);
         $user = $req->fetch();
         if($user){
             $errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
         }
    }
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "Vous devez rentrer un mot de passe valide";
    }
    if (empty($errors)) {
        // pour Créer un admin
        if(!empty($_GET['admin'])) {
            $req = $pdo->prepare("INSERT INTO Administrateur SET username = ?, password = ?, email = ?, confirmation_token = ?");
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $token = str_random(65);
            $req->execute([$_POST['username'],$password,$_POST['email'], $token]);
            $user_id = $pdo->lastInsertId();
            mail($_POST['email'], 'confirmaton de votre compte', "Afin de valider votre compte merci de ce lien\n\nhttp://localhost/projet_web/admin/confirm.php?admin=$user_id&token=$token");
            $_SESSION['flash']['success'] = 'un email de confirmation vous a été envoyé pour valider votre compte';
            header('location: Sign_in.php');
            exit();
        }
        if(!empty($_GET['name'])){
            $res = $pdo->prepare("SELECT * FROM subscribe WHERE type = ? ");
            $res->execute([$_GET['name']]);
            $req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, ID_sub = ?, payment = ?");
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $result = $res->fetch();
            $req->execute([$_POST['username'],$password,$_POST['email'],$result->id,$result->payment]);
            $_SESSION['id'] = $pdo->lastInsertId();
            header('location: payment/index.php');
            exit();
        }
    }
}
?>
<?php
$title = 'Registration';
require 'header.php'; ?>
<div class="container">
<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
    <div class="col-5 pb-md-4 mx-auto text-center">
        <form class="form-control" action="" method="post">
            <h1 class="display-6 fw-normal text-body-emphasis">Create Account </h1>
            <div class="form-group">
                <label for="">Your name</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email or Contact</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" placeholder="At least 6 characters">
            </div>
            <div class="form-group">
                <label for="">Confirm your password</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="At least 6 characters">
            </div><br>
            <button type="submit" class="w-50 btn btn-primary">Continue</button><br>
            <p class="fs-6 text-body-secondary">To verify your number, we will send you a text message with a temporary code. Message and data rates may apply. </p>
            <p class="fs-6 text-body-secondary">
                Already have an account? <a class="link-primary fs-5" href="Sign_in.php">Sign in</a>
            </p>
        </form>
    </div>
</div>
<?php require 'footer.php' ?>