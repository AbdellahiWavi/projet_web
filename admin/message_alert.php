<?php 
$title = 'Administrateur';
session_start();
$id = $_GET['id'];
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/db.php';
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$id]);
$res = $req->fetch();
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/functions.php';
$token = str_random(10,'0123456789');
if(isset($_POST['envoyer'])){
    $message = $_POST['message'];
    mail($res->email, 'Renouveler votre abonnement '.ucfirst($res->username), "VISION :\n$message@http://localhost/projet_web/payment/index.php?ren=$id&token=$token.\nMerci de renouveler votre abonnement.");
    $_SESSION['flash']['success'] = "le message est renvoyé vers $res->username avec success";
    header('location: message_alert.php?id='.$id);
    exit();
}
require 'header.php';
?>
<div class="container">
    <h1>Message de renouvelation d'abonnement</h1>
    <form action="message_alert.php?id=<?= $id ?>" method="post"> 
        <textarea name="message" rows="4" cols="100" style="width: 579px; height: 79px;">
         Cher abonne, n'oubliez pas de renouveler votre abonnement trois jours avant son expiration.
         lien pour renouvler votre abonnement:
        </textarea><br>
        <button type="submit" class="btn btn-primary" name="envoyer">Envoyer</button>
    </form>
</div>