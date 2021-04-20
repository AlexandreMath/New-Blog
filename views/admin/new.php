<?php
//GET THE CATEGORIES
//COUNT THE NUMBER OF CATEGORIES
use App\Connection;
use App\URL;

$pdo = new Connection();

$title = 'Ajouter un article';
$categorie = $pdo->findAllCategory();
$postImg = '';
?>
<section class='uw-container'>
<h1>Créer un nouvelle article</h1>
    <form action="" method="post" class="uw-container uw-row" id=articleForm>
        <div class="uw-container uw-col s12 m8">
            <div class="uw-section">
                <label class="uw-large" for="title"><i class="fas fa-pen"></i> Titre</label>
                <input type="text" name="title" id="title" class="uw-input uw-border uw-round" value="">
            </div>        
            <div class="uw-section">
                <label class="uw-large" for="message"><i class="fas fa-file-alt"></i> Text</label>
                <textarea class="uw-input uw-border uw-round" name="message" rows="12" id="Message"></textarea>
            </div>
            <div class="uw-section">
                <label class="uw-large" for="image"><i class="fas fa-file-image"></i> Images</label>
                    <input type="file" class="uw-input uw-border uw-round" name="image" id="image">
                <br>
                <?php if(!empty($postImg)): ?>
                    <img src="" class="uw-margin-top" style="width:100px;height:100px;">
                <?php endif; ?>
            </div>
        </div>
        <div class="uw-container uw-col s12 m4">
            <div class="uw-section">
                <form action="" method="post" class="uw-container uw-row" id=categoryForm>
                    <label class="uw-large" for="category"><i class="far fa-folder-open"></i> Catégorie</label>
                    <input type="text" class="uw-input uw-border uw-round" name="category" id="category">
                    <button type="submit" class="uw-button uw-right uw-round uw-border uw-small" id="BtnCategory"><i class=""></i> Ajouter une catégorie</button>
                    <br> 
                </form>               
            </div>
            <div class="uw-section">
                <label class="uw-large" for="date"><i class="far fa-calendar-alt"></i> Date de l'article</label>
                <input type="date" name="date" id="date" class="uw-input uw-border uw-round" value=""><br>
            </div>
            <a href="<?= $router->url('admin'); ?>" class="uw-button uw-left uw-margin-bottom uw-blue" ><i class="fa fa-arrow-left"></i> Annuler</a>
            <button type="submit" class="uw-button uw-right uw-margin-bottom uw-green" id="myBtn"><i class="fas fa-check"></i> Ajouter</button>
        </div>
    </form> 
</section>