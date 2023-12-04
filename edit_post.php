<?php include('header.php'); ?>
<?php
// Check if post ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the posts page if post ID is not provided
    header("Location: posts.php");
    exit();
}

$post_id = mysqli_real_escape_string($conn, $_GET['id']);

// Retrieve post information from the database
$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    // Redirect to the posts page if the post is not found
    header("Location: posts.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs (you might want to add more validation)
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // Update data in the 'posts' table
    $update_sql = "UPDATE posts SET title = '$title', content = '$content' WHERE id = $post_id";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect to the posts page after successful update
        header("Location: posts.php");
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
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
                            <h3 class="box-title">Edit Post</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $post_id); ?>" method="post">
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content:</label>
                                    <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $post['content']; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Post</button>
                            </form>
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