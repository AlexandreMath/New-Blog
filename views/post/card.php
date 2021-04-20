<?php
$categories = array_map(function($category) use ($router){
    $url = $router->url('category', ['slug' => $category->getSlug(), 'id' => $category->getID()]);
    return <<<HTML
        <a href="{$url}">{$category->getName()}</a>
HTML;
}, $post->getCategories());
?>
<article class="uw-card-2">
    <header class="uw-container uw-orange">
        <h5><?= htmlentities($post->getName()); ?></h5>
        <?php if (!empty($post->getCategories())):?>
            <div class="uw-opacity"><?= implode(',', $categories) ?></div>
        <?php endif?>
    </header>
    <div class="uw-container">
        <p><?= $post->getExcerpt(); ?></p>
    </div>
    <div class="uw-container uw-padding">
        <a href="<?= $router->url('post',['id' => $post->getId(), 'slug' => $post->getSlug()]); ?>" class="uw-button uw-orange uw-padding">Vers l'article</a>
        <div class="uw-opacity uw-right"><?= $post->getCreatedAt()->format('d F Y'); ?></div>
    </div>
  
</article>