<?php 
use App\Connection;
use App\Model\{Category, Post};
use App\Controller\ImagesController;

$id = (int)$params['id'];
$slug = $params['slug'];
//Recupere les posts
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

$categories = $pdo->loadCategories($post->getId());

//recup les images
$image = new ImagesController($post->getId());
$postImg = $image->getImages();

$title = $post->getName();
?>
<section class='uw-container'>
    <h1 class='uw-blue'><?= htmlentities($post->getName()); ?></h1>
    <p class="uw-opacity"><?= $post->getCreatedAt()->format('d F Y'); ?></p>
    <?php foreach ($categories as $category): 
        $category_url = $router->url('category', ['slug' => $category->getSlug(),'id' => $category->getId()]) ?> 
    <a href="<?= $category_url ?>" class="uw-button uw-blue uw-small"><?= $category->getName(); ?></a>
    <?php endforeach; ?>
    <div class="uw-container">
        <p><?= $post->getContent(); ?></p>
        <?php if($postImg): ?>
            <img src="<?='../' . $postImg->getSrc(); ?>" class="uw-margin-bottom" style="width:100px;height:100px;">
        <?php endif ?>
    </div>
</section>