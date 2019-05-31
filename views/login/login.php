<?php
session_start();

use App\Helpers\Security;
use App\Controller\LoginController;

if(!empty($_POST['username']) && !empty($_POST['password'])){
    
    $username = Security::formatInput($_POST['username']);
    $password = Security::formatInput($_POST['password']);

    $getUser = New LoginController($username, $password);
    $user = $getUser->loadAdmin();
    
    if($user !== NULL){
        $_SESSION['Admin'] = array('userId' => $user->getId(), 'username' => $user->getUsername());
        header('location:' . $router->url('admin'));
        exit();
    }
    else{echo 'Aucun utilisateur trouvé';}
}
else{echo 'Donné manquante';}
$title = 'Se connecter';
?>
<h2>Se connecter</h2>
<form action="<?= $router->url('check'); ?>" method="post" class="uw-container">
    <h3><label for="username" class="uw-text-blue">Nom</label></h3>
    <input id="username" type="text" name="username" class="uw-input uw-border">
    <h3><label for="password" class="uw-text-blue">Mot de passe</label></h3>
    <input id="password" type="password" name="password" class="uw-input uw-border">
    <button type="submit" class="uw-btn uw-blue uw-margin-top">Se connecter</button>
</form>