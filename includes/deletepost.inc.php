<?php
session_start();

if(isset($_POST['post-delete'])){

    include "dbh.php";

    $post_id = $_GET['pid'];

    $sql = "DELETE FROM post WHERE post_id =" . $post_id;
    $result = mysqli_query($conn, $sql);
    header("Location: ../ownposts.php?delete=succes");
    exit();
}
else{
    header("Location: ../ownposts.php");
    exit();
}


?>