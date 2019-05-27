<article class="uw-card-2">
    <header class="uw-container uw-orange">
        <h5><?= htmlentities($post->getName()); ?></h5>
    </header>
    <div class="uw-container">
        <p><?= $post->getExcerpt(); ?></p>
    </div>
    <div class="uw-container uw-padding">
        <a href="<?= $router->url('post',['id' => $post->getId(), 'slug' => $post->getSlug()]); ?>" class="uw-button uw-orange uw-padding">Vers l'article</a>
        <div class="uw-opacity uw-right"><?= $post->getCreatedAt()->format('d F Y'); ?></div>
    </div>
  
</article>