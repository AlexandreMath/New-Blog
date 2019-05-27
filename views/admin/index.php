<?php 
session_start();

if(!isset($_SESSION['Admin'])){
    $path = $router->url('login');
    http_response_code(301);
    header('Location:' . $path); 
    exit();
}
?>
<h1>Hello Admin</h1>