<?php include APPROOT . '/views/inc/header.php' ?>
<?php include APPROOT . '/views/inc/nav.php' ?>
<div class="wrapper form-wrapper">
    <h2>My Profile</h2>
    <div>
        <img width="30%" src="<?php echo URLROOT . '/public/img/' . $data['user']->imgUrl; ?>" alt="">
    </div>

    <form action="<?php echo URLROOT . '/users/my_profile'; ?>" enctype="multipart/form-data" method="post">
        <div>
            <p>
                <label for="profileimage"><b>Image: </b><sup>*</sup></label>
                <input type="file" name="image" id="image">
            </p>
            <div>
                <input type="submit" class="button-black" name="Submit" value="Change Photo">
            </div>
        </div>
    </form>
    <h4>Name: <?php echo $data['user']->fname; ?></h4>
    <h4>Username: <?php echo $data['user']->username; ?></h4>
    <h4>Email: <?php echo $data['user']->email; ?></h4>
</div>
<?php include APPROOT . '/views/inc/footer.php'; ?>
</body>
</html>
