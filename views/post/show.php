<?php 
use App\Connection;
use App\Model\Category;
use App\Model\Post;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM post WHERE id=:id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var POST|FALSE */
$post = $query->fetch();

if($post === FALSE){
    throw new \Exception("Aucun article ne correspond à cet ID"); 
}

if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location:' . $url);
}
// Récupère les catégories
$res = $pdo->prepare('SELECT c.id, c.name, c.slug FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id=:id');
$res->execute(['id' => $post->getId()]);
$res->setFetchMode(PDO::FETCH_CLASS, Category::class);
$categories = $res->fetchAll();

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
    </div>
</section>