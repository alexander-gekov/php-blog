<?php foreach ($data["my_posts"] as $post) : ?>
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