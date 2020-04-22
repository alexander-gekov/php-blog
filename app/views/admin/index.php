<?php
include APPROOT . 'views/inc/header.php';
include APPROOT . 'views/inc/nav.php';
?>
<div class="row">
    <div class="container">
        <div class="row" style="width: 100%;">
            <?php flash('admin_message'); ?>
        </div>
        <table id="users" align="center">
            <tr>
                <th>Id:</th>
                <th>Username:</th>
                <th>Email:</th>
                <th>Number of Posts:</th>
                <th></th>
            </tr>
            <?php foreach ($data['users'] as $user) : ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->postCount; ?></td>
                    <td><form action="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id ?>" method="post">
                        <input style="max-width:100px" type="submit" value="Delete" class="button-red">
                    </form></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php include APPROOT . 'views/inc/footer.php'; ?>