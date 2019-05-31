<?php 
session_start();
use App\URL;
use App\Controller\PaginatedQuery;
use App\Model\Post;

$title = 'Mon blog';

$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM post ORDER BY created_at",
    "SELECT COUNT(id) FROM post"
);
$posts = $paginatedQuery->getItems(Post::class);
$link = $router->url('home');
?>
<h1 class="uw-padding-small">Mon Blog</h1>

<section class="uw-container uw-row-padding uw-margin">
    <?php foreach ($posts as $post): ?>
    <div id="card" class="uw-col m4 uw-margin-bottom">
       <?php require 'card.php';?>
    </div>
    <?php endforeach?>
    <div class="uw-center uw-margin-bottom">
        <div class="uw-bar uw-xlarge">
            <?= $paginatedQuery->previousLink($link) ?>
            <?= $paginatedQuery->nextLink($link) ?>
        </div>
    </div>
</section>

