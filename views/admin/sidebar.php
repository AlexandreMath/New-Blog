<!-- Sidebar/menu -->
<nav class="uw-sidebar uw-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="uw-container uw-row">
        <div class="uw-col s4">
            <img src="/img/avatar.png" class="uw-circle uw-margin-right" style="width:46px">
        </div>
        <div class="uw-col s8 uw-bar">
            <span>Bonjour, <strong><?= $_SESSION['Admin']['username'] ?></strong></span><br>
            <a href="<?= $router->url('home');?>" class="uw-bar-item uw-button"><i class="fa fa-home"></i></a>
            <a href="#" class="uw-bar-item uw-button"><i class="fa fa-user"></i></a>
            <a href="#" class="uw-bar-item uw-button"><i class="fa fa-cog"></i></a>
        </div>
    </div>
    <hr>
    <div class="uw-container">
        <h5>Tableau de bord</h5>
    </div>
    <div class="uw-bar-block">
        <a href="#" class="uw-bar-item uw-button uw-padding-16 uw-hide-large uw-dark-grey uw-hover-black" onclick="uw_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
        <a href="#" class="uw-bar-item uw-button uw-padding uw-blue"><i class="fas fa-file-alt"></i>  Articles</a>
        <a href="#" class="uw-bar-item uw-button uw-padding"><i class="far fa-folder-open"></i>  Catégories</a>
        <a href="#" class="uw-bar-item uw-button uw-padding"><i class=" far fa-file-image"></i>  Media</a>
        <a href="#" class="uw-bar-item uw-button uw-padding uw-hide-large"><i class="fas fa-home"></i>  Accueil</a>
        <a href="#" class="uw-bar-item uw-button uw-padding uw-hide-large"><i class="far fa-envelope"></i>  Contact</a>
        <?php if(!isset($_SESSION['Admin'])): ?>
            <a href="<?= $router->url('admin');?>" class="uw-bar-item uw-padding"> <i class="fas fa-sign-in-alt"></i>  Se connecter</a>
        <?php else: ?>
            <a href="<?= $router->url('admin');?>" class="uw-bar-item uw-padding"><i class="far fa-address-card"></i>  Administration</a>
            <a href="<?= $router->url('logout');?>" class="uw-bar-item uw-padding"><i class="fas fa-sign-out-alt"></i>  Se deconnecter</a>
        <?php endif; ?>
    </div>
</nav>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="uw-overlay uw-hide-large uw-animate-opacity" onclick="uw_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
