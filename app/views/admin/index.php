<?php
include APPROOT . 'views/inc/header.php';
include APPROOT . 'views/inc/nav.php';
?>
<div class="row">
    <div class="container">
        <table id="users">
            <tr>
                <th>Id:</th>
                <th>Username:</th>
                <th>Number of Posts:</th>
                <th></th>
            </tr>
            <?php foreach ($data['users'] as $user) : ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $data['postCount']; ?></td>
                    <td><button class="button-red">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php include APPROOT . 'views/inc/footer.php'; ?>