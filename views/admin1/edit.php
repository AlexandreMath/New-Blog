<?php 
use App\Connection;

$pdo = new Connection();

$post = $pdo->loadPost($params['id']);
?>

<h1>Editer l'artcile <?= $params['id'] ?></h1>