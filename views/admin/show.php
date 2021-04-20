<?php 
use App\Connection;
use App\Model\{Category, Post};
use App\Controller\ImagesController;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = new Connection();

$post = $pdo->loadPost($id);

if($post === FALSE){
    throw new \Exception("Aucun article ne correspond à cet ID"); 
}

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location:' . $url);
}
$ids[] = $post->getId();
$categories = $pdo->loadCategories($ids);

//recup les images
$image = new ImagesController($post->getId());
$postImg = $image->getImages();

$title = $post->getName();
?>
<section class='uw-container'>
    <h1>Editer l'article <?= $id; ?></h1>
    <form action="" method="post" class="uw-container uw-row" id=articleForm>
        <div class="uw-container uw-col s12 m8">
            <div class="uw-section">
                <label class="uw-large" for="title"><i class="fas fa-pen"></i> Titre</label>
                <input type="text" name="title" id="title" class="uw-input uw-border uw-round" value="<?= htmlentities($post->getName()); ?>">
            </div>        
            <div class="uw-section">
                <label class="uw-large" for="message"><i class="fas fa-file-alt"></i> Text</label>
                <textarea class="uw-input uw-border uw-round" name="message" rows="12" id="Message"><?= str_replace('<br />', ' ', $post->getContent()); ?></textarea>
            </div>
            <div class="uw-section">
                <label class="uw-large" for="image"><i class="fas fa-file-image"></i> Images</label>
                    <input type="file" class="uw-input uw-border uw-round" name="image" id="image">
                <br>
                <?php if($postImg): ?>
                    <img src="<?= dirname('/public/') . $postImg->getSrc(); ?>" class="uw-margin-top" style="width:100px;height:100px;">
                <?php endif ?>
            </div>
        </div>
        <div class="uw-container uw-col s12 m4">
            <div class="uw-section">
                <label class="uw-large" for="category"><i class="far fa-folder-open"></i> Catégorie</label>
                <?php foreach ($categories as $category): ?>
                <input type="text" name="category" id="category" class="uw-input uw-border uw-round" value="<?= $category->getName(); ?>"><br>
                <?php endforeach; ?>
            </div>
            <div class="uw-section">
                <label class="uw-large" for="date"><i class="far fa-calendar-alt"></i> Date de l'article</label>
                <input type="date" name="date" id="date" class="uw-input uw-border uw-round" value="<?= $post->getCreatedAt()->format('Y-m-d'); ?>"><br>
            </div>
            <a href="<?= $router->url('admin'); ?>" class="uw-button uw-left uw-margin-bottom uw-blue" ><i class="fa fa-arrow-left"></i> Annuler</a>
            <button type="submit" class="uw-button uw-right uw-margin-bottom uw-green" id="myBtn"><i class="fas fa-check"></i> Modifier</button>
        </div>
    </form> 
</section>