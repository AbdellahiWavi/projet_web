<?php 
session_start();
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/functions.php';
logged_only('admin');
$title = 'Admins';
require 'header.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'inc/db.php';
?>
<div class="container">
    <div class="alert alert-info">
        Welcome <?= $_SESSION['admin'] ?>
    </div><br>
    <table class="table">
        <thead>
            <th>#ID_admin</th>
            <th>Nom_admin</th>
            <th>E-mail ou Contact</th>
            <th>Date_</th>
            <th style='text-align: center'>Actions</th>
        </thead>
        <tbody>
                <?php 
                $i=1; 
                while(posts($i,'admin','administrateur')) { ?>    
                <tr>
                    <td><?='#'.posts($i,'admin','administrateur') ?></td>
                    <td><?= posts($i,'username','administrateur') ?></td>
                    <td><?= posts($i,'email','administrateur') ?></td>
                    <td><?= posts($i,'confirmed_at','administrateur') ?></td>
                    <td style='text-align: center'>
                        <a class="btn btn-danger" href="delete.php?admin=<?= posts($i, 'admin','administrateur') ?>"
                        onclick ="return confirm('voulez vous suppimer cet admin ?')">
                        Supprimer
                        </a>
                    </td>
            </tr>
                <?php $i++;
                } ?>
        </tbody>
    </table>