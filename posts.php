<?php include('header.php'); ?>

<?php

if (isset($_SESSION['user_id']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == "admin"){
    $sql = "SELECT * FROM posts";
} else {
    $sql = "SELECT * FROM posts where user_id = " . $_SESSION['user_id'];
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $posts = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $posts = [];
}

$conn->close();
?>
<style>
    .limited-content {
        max-width: 200px; /* Adjust the value as per your design */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php include('sidebar.php'); ?>
    </section>
</aside>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Posts</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="add_post.php" class="btn btn-success">Add New Post</a>
                            </div>
                        </div>
                        <br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($posts as $post): ?>
                                    <tr>
                                        <td><?php echo $post['id']; ?></td>
                                        <td><?php echo $post['title']; ?></td>
                                        <td class="limited-content"><?php echo $post['content']; ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a>
                                            <a class="btn btn-danger" href="delete_post.php?id=<?php echo $post['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>

<?php include('footer.php'); ?>
