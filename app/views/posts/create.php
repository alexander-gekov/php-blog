<?php include APPROOT . '/views/inc/header.php'?>
<?php include APPROOT . '/views/inc/nav.php' ?>

<div class="wrapper form-wrapper">
    <a href="<?php echo URLROOT;?>/posts" class="button-black m-20">Back</a>
    <h2>Create Post</h2>
    <form name="createForm" id="createForm" enctype="multipart/form-data" action="<?php echo URLROOT . '/posts/create'; ?>" method="post">
        <div>
            <p>
                <label for="title"><b>Title: </b><sup>*</sup></label>
                <input type="text" name="title" value="<?php echo $data['title']; ?>">
                <span><?php echo $data['title_err'] ?></span>
            </p>
        </div>
        <div>
            <p>
                <label for="text"><b>Text: </b><sup>*</sup></label>
                <textarea name="editor" id="editor"><?php echo $data['text'] ?></textarea>
                <span><?php echo $data['text_err']; ?></span>
            </p>
        </div>
        <div>
            <p>
                <label for="image"><b>Image: </b><sup>*</sup></label>
                <input type="file" name="image" id="image">
            </p>
        </div>
        <div>
            <input type="submit" class="button-black" name="Submit" value="Submit">
        </div>
    </form>
</div>

<?php include APPROOT . '/views/inc/footer.php' ?>