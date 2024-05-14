<?php 
session_start();
unset($_SESSION['admin']);
$_SESSION['flash']['success'] = 'Vous étes maintenant déconnecté.';
header('location: ../Sign_in.php');