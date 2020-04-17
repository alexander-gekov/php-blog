<?php include APPROOT . '/views/inc/header.php' ?>
<?php include APPROOT . '/views/inc/nav.php' ?>
<div class="row">
    <div class="container">
        <a href="<?php echo URLROOT;?>/posts" class="button-black m-20">Back</a>
        <div class="article">
            <h1><?php echo $data['post']->title ?></h1>
            <img src="<?php echo URLROOT . '/public/img/' . $data['post']->imgPath ?>" alt="">
            <?php echo $data['post']->text  ?>
            <p>Written by: <a style="color: black; text-decoration: none"
                              href="#"><strong><?php echo $data['user']->username ?></strong> </a>
                on <?php echo $data['post']->created_at ?>
            </p>
        </div>
        <?php
        if ($_SESSION['user_id'] == $data['post']->user_id || isAdmin()) : ?>
        <div class="row">
            <div class="column">
                <a href="<?php echo URLROOT . '/posts/edit/' . $data['post']->id ?>" class="button-green">Edit</a>
                <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id ?>" method="post">
                    <input style="max-width:100px" type="submit" value="Delete" class="button-red">
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php include APPROOT . '/views/inc/footer.php' ?>
