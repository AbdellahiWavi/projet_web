<?php
session_start();
$id = @$_GET['ren'];
$token = @$_GET['token'];
if(!empty($_POST)){
    require_once '../inc/db.php';
    require_once '../inc/functions.php';
    $errors = array();
    if(empty($_POST['card_nombre']) || (strlen($_POST['card_nombre']) !== 16)){
        $errors['card_nombre'] = "Vous devez rentrer un nombre de carte validée";
    }
    if(empty($_POST['date']) || !validateDate($_POST['date'])){
        $errors['date'] = "date expirée ou incorrecte";
    } 
    if(empty($_POST['cvv']) || (strlen($_POST['cvv']) !== 3) || substr($_POST['card_nombre'],-3) !== $_POST['cvv']){
        $errors['card_nombre'] = "Vous devez rentrer un cvv validée";
    }
    if(empty($_POST['nom_card']) || !preg_match('/^[a-zA-Z]+$/', $_POST['nom_card'])){
        $errors['nom_card'] = "Ce card nom est invalide (alphanumérique)";
    }
    if(empty($errors)) {
        if(!empty($id)){
            #Recupere les identifiant du payement pour y modifier 
            $paye = $pdo->prepare("SELECT id_payment FROM paye WHERE id_user = ?");
            $paye->execute([$id]);
            $res_paye = $paye->fetch();
            $id_payment = $res_paye->id_payment;
            #Modifier les information du carte VISA
            $req = $pdo->prepare("UPDATE payment SET card_nombre = ?, date = ?, cvv = ?, nom_card = ? WHERE id = ?");
            $req->execute([$_POST['card_nombre'],$_POST['date'],$_POST['cvv'],$_POST['nom_card'],$id_payment]);
            #Modifier le payement de l'utilisateur correspondant
            $res = $pdo->prepare("UPDATE users SET payment = ? WHERE id = ?")->execute([$_POST['paye'],$id]);
            
            #Selectionnez l'utilisateur correspondant
            $res = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $res->execute([$id]);
            $email = $res->fetch();
            #Envoyer un email vers l'utilisateur
            mail($email->email, 'Abonnements sur VISION', "VISION : ".ucfirst($email->username)." votre code de securite est $token. Votre code expire dans 10 minutes.\n\nMerci de renouveler votre abonnement.\n\n@http://localhost/projet_web/confirm.php?id=$id&#$token&user=".$email->username);
            $_SESSION['flash']['success'] = 'un email de confirmation vous a été envoyé pour renouveler votre abonnement';
            header('location: ../Sign_in.php?name=user');
            exit();  
        } else {
            $req = $pdo->prepare("INSERT INTO payment SET card_nombre = ?, date = ?, cvv = ?, nom_card = ?");
            $req->execute([$_POST['card_nombre'],$_POST['date'],$_POST['cvv'],$_POST['nom_card']]);
            $id_payment = $pdo->lastInsertId();
            $user_id = $_SESSION['id'];
            $pdo->prepare("INSERT INTO paye SET id_payment = ?, id_user = ?")->execute([$id_payment,$user_id]);
            $token = str_random(6,'1234567890');
            $res = $pdo->prepare("SELECT * FROM users WHERE id = ?");    
            $res->execute([$user_id]);
            $email = $res->fetch();    
            mail($email->email, 'Abonnements sur VISION', "VISION : Votre code de securite est $token. Votre code expire dans 10 minutes.\n\nMerci de ne pas repondre.\n\n@http://localhost/projet_web/confirm.php?user_id=$user_id&#$token");
            $_SESSION['flash']['success'] = 'un email de confirmation vous a été envoyé pour valider votre abonnement';
            header('location: ../Sign_in.php?name=user');
            exit();
        }   
    }
}
?>
<?php require 'header.php' ?>

<div class="col-lg-7">
    <form action="<?= (!empty($_GET['ren'])) ? 'index.php?ren='.@$id.'&token='.@$token : '' ?>" method="post">
        <div class="row">
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
            <?php endif ?>
            </div>
            <div class="col-12">
                <div class="">
                    <label for="" class="">Card Number</label>
                    <input type="text" name="card_nombre" class="form-control" placeholder="Random" >
                </div>
            </div>

            <div class="col-6">
                <div class="">
                    <label for="" class="">MM / yy</label>
                    <input type="text" name="date" class="form-control" placeholder="01/2023">
                </div>
            </div>

            <div class="col-6">
                <div class="">
                    <label for="" class="">cvv code</label>
                    <input type="number" name="cvv" class="form-control" placeholder="Random">
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="">
                    <label for="" class="">name on the card</label>
                    <input type="text" name="nom_card" class="form-control" placeholder="VISA">
                </div>
            </div>
        <?php if(!empty($id)) : ?>
            <div class="col-6">
                <div class="">
                    <select name="paye">
                        <option value="$5.99">month:$5.99</option>
                        <option value="$47.88">year:$47.88</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <center><button class="btn btn-primary w-50">Sumbit</button></center>
            </div>
        <?php else : ?>
            <div class="col-12">
                <center><button class="btn btn-primary w-50">Sumbit</button></center>
            </div>
        <?php endif ?>
        </div>
    </form>
</div>
<?php require 'footer.php' ?>
