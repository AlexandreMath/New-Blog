<?php
use App\Connection;
$pdo = new Connection();
//$pdo->delete($params['id']);
header('Location: ' . $router->url('admin') . '?delete=1');
?>
