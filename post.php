<?php
include "header.php";
if(isset($_SESSION['customer_id'])){
?>
<!DOCTYPE html>
<html lang="en">

<body>
<div class="post-all">
    <h2 style="text-align: center;">Add post</h2>
    <form action="includes/post.inc.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Add title</label>
            <input type="text" name="post_title" class="form-control" placeholder="Enter Title">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Add text</label>
            <textarea rows="5" cols="50" class="form-control" name="post_text" placeholder="Enter Text"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" name="add" class="btn btn-outline-success my-2 my-sm-0">Post</button>
            <span style="margin-left: 30%;">
        <label for="exampleInputEmail1">Add image</label>
        <input type="file" name="post_file" class="btn btn-outline-info my-2 my-sm-0">
            </span>
        </div>
    </form>
</div>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyfields") {
        echo "<script>swal('Something went wrong', 'Some fields are empty', 'error'); </script>";
    } elseif ($_GET['error'] == "html") {
        echo "<script>swal('Something went wrong', 'NIET KANKER HTML ERIN PROBEREN TE DOEN', 'error'); </script>";
    } elseif ($_GET['error'] == "html2") {
        echo "<script>swal('Something went wrong', 'u gay lol', 'error'); </script>";
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
