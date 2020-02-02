<?php
include "header.php"
?>
<!DOCTYPE html>
<html lang="en">

<body>
<?php
if(isset($_SESSION['customer_id'])) {

    include "includes/dbh.php";

    $sql = "SELECT * FROM post ORDER BY post_id DESC ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
    ?>
<div class="container">
    <a href="fullpost.php?id=<?php echo $row['post_id']; ?>&c=<?php echo $row['post_creator']; ?>">
    <div class="post-index">
        <span class="index-post-title"><?php echo $row['post_title']; ?></span><br/>
        <div class="flex">
        <span class="post-index-2">
        <img src="<?php echo $row['post_image'] ?>" alt="post-img" width="110" height="110">
        <span class="index-post-text"><?php echo $row['post_text']; ?></span></span>
        </div>
    </div>
    </a>
</div>
<?php
        }
    }
}
?>

<div class="nologin">
<?php
if(!isset($_SESSION['customer_id'])){
    echo 'You have to sign in before you can view posts';
}
?>
</div>

<?php
if(isset($_GET['post']) && $_GET['post'] == "succes"){
    echo "<script>swal('Success', 'Post added', 'success'); </script>";
}
?>
</body>

</html>
