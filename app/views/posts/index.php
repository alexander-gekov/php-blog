<?php
include APPROOT . 'views/inc/header.php';
include APPROOT . 'views/inc/nav.php';
?>

<div class="wrapper wrapper-fix">
    <div class="row" style="width: 100%;">
        <?php flash('post_message'); ?>
    </div>
    <div class="row row-posts">
        <div class="column">
            <h1>Posts</h1>
        </div>
        <div class="column ">
            <a href="<?php echo URLROOT; ?>/posts/create" class="button-blue">Create Post</a>
            <button class="button-blue" id="my_posts">My Posts</button>
            <button class="button-blue" id="all_posts">All Posts</button>
        </div>
    </div>
    <div class="row">
        <?php flash('post_added'); ?>
    </div>
        <section id="posts_container" class="cards-wrapper">
            <?php foreach ($data['posts'] as $post) : ?>
                <div class="card-grid-space">
                    <a class="card" style="--bg-img: url(<?php echo URLROOT; ?>/img/<?php echo $post->imgPath?>)" href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId ?>">
                        <div>
                            <h1><?php echo $post->title ?></h1>
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

