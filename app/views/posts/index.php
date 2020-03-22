<?php
include APPROOT . 'views/inc/header.php';
include APPROOT . 'views/inc/nav.php';
?>

<div class="wrapper">
    <div class="row" style="width: 100%;">
        <?php flash('post_added'); ?>
    </div>
    <div class="row">
        <div class="column">
            <h1>Posts</h1>
        </div>
        <div class="column ">
            <a href="<?php echo URLROOT; ?>/posts/create" class="button-blue">Create Post</a>
        </div>
    </div>
    <div class="row">
        <?php flash('post_added'); ?>
    </div>
        <section class="cards-wrapper">
            <?php foreach ($data['posts'] as $post) : ?>
                <div class="card-grid-space">
                    <a class="card" style="--bg-img: url(<?php echo URLROOT; ?>/img/<?php echo $post->imgPath?>)" href="/posts/<?php echo $post->id ?>">
                        <div>
                            <h1><?php echo $post->title ?></h1>
                            <p><?php $s = substr($post->text, 0, 60); echo substr($s, 0, strrpos($s,' ')) ; ?> ...</p>
                            <div class="date"><?php echo date('d/m/Y', strtotime($post->created_at)) ?></div>
                            <div class="tags">
                                <div class="tag"><?php echo $post->username ?></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </section>
</div>

<?php include APPROOT . 'views/inc/footer.php'; ?>

