<?php 
use App\Connection;
use App\PaginatedQuery;
use App\Model\{Category, Post};

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM category WHERE id=:id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var POST|FALSE */
$category = $query->fetch();

if($category === FALSE){
    throw new \Exception("Aucune catégorie ne correspond à cet ID"); 
}

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location:' . $url);
}
//IMPORT CLASS
$paginatedQuery = new PaginatedQuery(
    "SELECT p.* FROM post p JOIN post_category pc ON  pc.post_id = p.id WHERE pc.category_id = {$category->getId()} ORDER BY created_at",
    "SELECT COUNT(category_id) FROM post_category WHERE category_id = {$category->getId()} "
);
/** @var Post[] */
$posts = $paginatedQuery->getItems(Post::class);

$title = "Catégorie {$category->getName()}";
$link = $router->url('category', ['slug' => $category->getSlug(), 'id' => $category->getID()]);
?>
<h1><?= htmlentities($title); ?></h1>
<section class="uw-container uw-row-padding uw-margin">
    <?php foreach ($posts as $post): ?>
    <div id="card" class="uw-col m4 uw-margin-bottom">
       <?php require dirname(__DIR__) . '/post/card.php';?>
    </div>
    <?php endforeach?>
    <div class="uw-center uw-margin-bottom">
        <div class="uw-bar uw-xlarge">
            <?= $paginatedQuery->previousLink($link) ?>
            <?= $paginatedQuery->nextLink($link) ?>
        </div>
    </div>
</section>