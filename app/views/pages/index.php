<?php
include APPROOT . 'views/inc/header.php';
include APPROOT . 'views/inc/nav.php'; ?>
<div class="row">
    <div class="container">
        <header>
            <h1><?php echo SITENAME ?></h1>
        </header>
        <img src="<?php echo URLROOT; ?>/public/img/arrow-left.png" alt="Prev" id="prev">
        <div id="slider">
            <div class="slide">
                <div class="slide-text">
                    <h2>Our Blog</h2>
                    <p>Come here to view lifestyle related content.</p>
                </div>
                <img src="<?php echo URLROOT ?>/public/img/tie.jpg" alt="">
            </div>
            <div class="slide">
                <div class="slide-text">
                    <h2>Register Now</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt dolor dolore
                        impedit in maxime tenetur unde? Est harum in ipsam magni nobis numquam perferendis quos
                        recusandae temporibus totam. Cupiditate!</p>
                </div>
                <img src="<?php echo URLROOT ?>/public/img/register.jpg" alt="">
            </div>
            <div class="slide">
                <div class="slide-text">
                    <h2>View Posts</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquam aspernatur cum
                        deserunt ducimus ea esse fugiat hic id nam odio porro quam quas rem tenetur unde vel voluptas,
                        voluptates?</p>
                </div>
                <img src="<?php echo URLROOT ?>/public/img/posts.jpg" alt="">
            </div>
            <div class="slide">
                <div class="slide-text">
                    <h2>Create Posts</h2>
                    <p>Come here to view lifestyle related content.</p>
                </div>
                <img src="<?php echo URLROOT ?>/public/img/createpost.jpg" alt="">
            </div>
            <div class="slide">
                <div class="slide-text">
                    <h2>PHP Based</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci aperiam asperiores
                        consequuntur dignissimos doloribus eius eveniet id inventore ipsum itaque nemo nulla officia
                        placeat quos reprehenderit vel, voluptatem voluptates.</p>
                </div>
                <img src="<?php echo URLROOT ?>/public/img/php.jpg" alt="">
            </div>
        </div>
        <img src="<?php echo URLROOT; ?>/public/img/arrow-right.png" alt="Prev" id="next">
    </div>
</div>

<?php include APPROOT . 'views/inc/footer.php'; ?>

