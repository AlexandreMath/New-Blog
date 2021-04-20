<?php 
session_start();

use App\Controller\PaginatedQuery;
use App\Model\Post;

if(!isset($_SESSION['Admin'])){
    $path = $router->url('login');
    http_response_code(301);
    header('Location:' . $path); 
    exit();
}
/*$postAdmin = new PostAdminController();
$posts = $postAdmin->index();*/
$paginatedQuery = new PaginatedQuery(
    "SELECT * FROM post ORDER BY created_at",
    "SELECT COUNT(id) FROM post"
);
$posts = $paginatedQuery->getItems(Post::class);
$link = $router->url('admin');
?>

<section class="uw-container uw-white uw-margin-bottom">
    <?php if (isset($_GET['delete'])):?> 
        <div class="uw-panel uw-success-message">L'enrefistrement a bien été supprimé</div>
    <?php endif?>
    <table class="uw-table uw-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td>#<?= $post->getId() ?></td>
                <td><?= htmlentities($post->getName()); ?></td>
                <td><?= $post->getCreatedAt()->format('d F Y'); ?></td>
                <td> 
                    <a href="<?= $router->url('admin.edit',['id' => $post->getId(), 'slug' => $post->getSlug()]); ?>" class="uw-btn uw-round uw-orange uw-text-white"><i class="far fa-edit"></i> Editer</a>
                    <form action="<?= $router->url('admin.delete',['id' => $post->getId()]); ?>" method="post" onsubmit="return confirm('Voulez-vous vraiment effectuer cette action ?')" style="display:inline">
                        <button type="submit" class="uw-btn uw-round uw-red uw-text-white" ><i class="far fa-trash-alt"></i> Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <div class="uw-center uw-margin-bottom">
            <div class="uw-bar uw-xlarge">
                <?= $paginatedQuery->previousLink($link) ?>
                <?= $paginatedQuery->nextLink($link) ?>
            </div>
        </div>
</section>
