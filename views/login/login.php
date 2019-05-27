<?php
session_start();

use App\Helpers\Security;
use App\Security\AdminLogin;

if(!empty($_POST['username']) && !empty($_POST['password'])){
    
    $username = Security::formatInput($_POST['username']);
    $password = Security::formatInput($_POST['password']);
    dd($username, $password);
    $getUser = AdminLogin($username, $password);
    $user = $getUser->loadAdmin();
    if($user !== NULL){
        $_SESSION['Admin'] = array('userId' =>$user->getId(), 'username' => $user->getUser());
        header('location:' . $router->url('admin'));
        exit();
    }
    else{echo 'Aucun utilisateur trouvé';}
}
else{echo 'Erreur';}
$title = 'Se connecter';

?>
<h2>Se connecter</h2>
<form action="<?= '../views/login/'. $_SERVER['REQUEST_URI'] ?>" method="post" class="uw-container">
    <h3><label for="username" class="uw-text-blue">Nom</label></h3>
    <input id="username" type="text" name="username" class="uw-input uw-border">
    <h3><label for="password" class="uw-text-blue">Mot de passe</label></h3>
    <input id="password" type="password" name="password" class="uw-input uw-border">
    <button type="submit" class="uw-btn uw-blue uw-margin-top">Se connecter</button>
</form>