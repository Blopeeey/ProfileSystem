<?php
include "header.php";
if(isset($_SESSION['customer_id'])){
?>
<!DOCTYPE html>
<html lang="en">

<body>
<?php

$pid = $_GET['pid'];
$sql = "SELECT * FROM post WHERE post_id =" . $pid;
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="post-all">
            <h2 style="text-align: center;">Edit post</h2>
            <form action="includes/editpost.inc.php?pid=<?php echo $_GET['pid']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Add title</label>
                    <input type="text" name="editpost_title" class="form-control" placeholder="Enter Title" value="<?php echo $row['post_title']; ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Add text</label>
                    <textarea rows="5" cols="50" class="form-control" name="editpost_text"
                              placeholder="Enter Text"><?php echo $row['post_text']; ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" name="edit-post" class="btn btn-outline-info my-2 my-sm-0">Edit</button>
                    <span style="margin-left: 30%;">
                    <label for="exampleInputEmail1">Add image</label>
                    <input type="file" name="editpost_file" class="btn btn-outline-info my-2 my-sm-0">
                    </span>
                </div>
            </form>
        </div>
        <?php
    }
}
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyfields") {
        echo "<script>swal('Something went wrong', 'Some fields are empty', 'error'); </script>";
    } elseif ($_GET['error'] == "html") {
        echo "<script>swal('Something went wrong', 'NIET HTML ERIN PROBEREN TE DOEN', 'error'); </script>";
    }
}
}
else{
    header("index.php");
    exit();
}
?>
</body>

</html>