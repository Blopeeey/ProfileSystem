<?php
include "header.php";

include "includes/dbh.php";
?>
<!DOCTYPE html>
<html lang="en">

<body>
<br/>
<div class="acc-choice">
    <a href="ownposts.php">Posts</a> - <a href="owncomments.php">Comments</a>
</div>
<?php
if(isset($_SESSION['customer_id'])) {

    include "includes/dbh.php";

    $sql = "SELECT * FROM post WHERE post_creator = ".$_SESSION['customer_id']." ORDER BY post_id DESC ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['post_id'] == "") {
                echo "This user has no posts";
            } else {
                ?>
                <div class="container">
                    <a href="fullpost.php?id=<?php echo $row['post_id']; ?>&c=<?php echo $row['post_creator']; ?>">
                        <div class="post-index-3">
                            <span class="index-post-title"><?php echo $row['post_title']; ?></span><br/>
                            <img src="<?php echo $row['post_image'] ?>" alt="post-img" width="110" height="110">
                            <span class="index-post-text"><?php echo $row['post_text']; ?></span>

                            <form action="editpost.php?pid=<?php echo $row['post_id']; ?>" method="post">
                                <span class="edit-post"><button type="submit" class="btn btn-outline-info"
                                                                name="post-edit">Edit</button></span>
                            </form>

                            <form action="includes/deletepost.inc.php?pid=<?php echo $row['post_id']; ?>" method="post">
                                <span class="delete-post"><button type="submit" class="btn btn-outline-danger"
                                                                  name="post-delete">Delete</button></span>
                            </form>
                        </div>
                    </a>
                </div>
                <?php
            }
        }
    }
}
?>

<?php
if(isset($_GET['delete'])){
    if($_GET['delete'] == "succes"){
        echo "<script>swal('Success', 'Post deleted', 'success'); </script>";
        exit();
    }
}
if(isset($_GET['edit'])){
    if($_GET['edit'] == "succes"){
        echo "<script>swal('Success', 'Post updated', 'success'); </script>";
        exit();
    }
}
?>
</body>

</html>