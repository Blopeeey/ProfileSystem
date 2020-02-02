<?php
if(isset($_POST['edit-post'])){

    include "dbh.php";

    $pid = $_GET['pid'];

    $sql = "SELECT * FROM post WHERE post_id =".

    $title = $_POST['editpost_title'];
    $text = $_POST['editpost_text'];
    $foto = 'images/post/'.$_FILES['editpost_file']['name'];

    if($foto == "images/post/"){
        $sql = "UPDATE post SET post_title = ?, post_text = ? WHERE post_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../ownposts.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssi", $title, $text, $pid);
            mysqli_stmt_execute($stmt);
            header("Location: ../ownposts.php?edit=succes");
            exit();
        }
    }
    else{
        $sql = "UPDATE post SET post_title = ?, post_text = ?, post_image = ? WHERE post_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../ownposts.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sssi", $title, $text, $foto, $pid);
            mysqli_stmt_execute($stmt);
            move_uploaded_file($_FILES['editpost_file']['tmp_name'], "../images/post/" . $_FILES['editpost_file']['name']);
            header("Location: ../ownposts.php?edit=succes");
            exit();
        }
    }
}
else{
    header("Location: ../ownposts.php");
    exit();
}