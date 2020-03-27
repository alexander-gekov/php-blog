<?php include APPROOT . '/views/inc/header.php' ?>
<?php include APPROOT . '/views/inc/nav.php' ?>
<div class="row">
    <div class="container">
        <div class="article">
            <h1><?php echo $data['post']->title ?></h1>
            <img src="<?php echo URLROOT . '/public/img/' . $data['post']->imgPath ?>" alt="">
            <p><?php $s = substr($data['post']->text, 0, 60);
                echo substr($s, 0, strrpos($s, ' ')); ?></p>
            <p><?php $s = substr($data['post']->text, 61);
                echo $s; ?></p>
            <p>Written by: <a style="color: black; text-decoration: none"
                              href="#"><strong><?php echo $data['user']->username ?></strong> </a>
                on <?php echo $data['post']->created_at ?>
            </p>
        </div>
    </div>
</div>
<?php include APPROOT . '/views/inc/footer.php' ?>
