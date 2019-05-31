<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo:700|Montserrat:400,700" rel="stylesheet"> 
    <link rel="stylesheet" href="<?= $css .'UWCSS.css'?>">
    <link rel="stylesheet" href="<?= $css .'style.css'?>">
    <title><?= isset($title) ? htmlentities($title) : 'Mon site' ?></title>
</head>
<body>
    <nav class="uw-bar uw-green">
        <a href="<?= $router->url('home');?>" class="uw-bar-item uw-button uw-mobile uw-large">Mon site</a>
        <a href="<?= $router->url('contact');?>" class="uw-bar-item uw-mobile">Contacter</a>
        <?php if(!isset($_SESSION['Admin'])): ?>
        <a href="<?= $router->url('admin');?>" class="uw-bar-item uw-hover-text-orange uw-mobile uw-right">Se connecter</a>
        <?php else: ?>
        <a href="<?= $router->url('logout');?>" class="uw-bar-item uw-hover-text-orange uw-mobile uw-right">Se deconnecter</a>
        <?php endif; ?>
    </nav>
    <main class="uw-container uw-margin-top">
        <?= $content ?>
    </main>

    <footer class="uw-container uw-light-grey footer uw-padding uw-bottom"> 
        <div class="uw-container">
        <?php if(defined('DEBUG_TIME')): ?>
            Page générée en <?= round(1000 *(microtime(true) - DEBUG_TIME)); ?> ms
        <?php endif ?>
        </div>
    </footer>
</body>
</html>