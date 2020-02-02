<?php
session_start();
echo ini_get('display_errors');
if(isset($_SESSION['customer_id'])) {
    if (isset($_POST['add'])) {

        include "dbh.php";

        $title = $_POST['post_title'];
        $text = $_POST['post_text'];
        $file = "images/post/".$_FILES['post_file']['name'];

        if(empty($title) || empty($text)){
            header("Location: ../post.php?error=emptyfields");
            exit();
        }
        elseif(!preg_match("/[a-zA-Z0-9\s.,]/", $title)){
            header("Location: ../post.php?error=html2");
            exit();
        }
        elseif(!preg_match("/^[a-zA-Z0-9\"\s.,]*$/", $text)){
            header("Location: ../post.php?error=html");
            exit();
        }
        else{
            $sql = "INSERT INTO post(post_creator, post_title, post_image, post_text) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../post.php?error=sqlerror");
                exit();
            }
            else{
                if($file == "images/post/"){
                    $file = "images/post/temp.jpg";
                }
                $cid = $_SESSION['customer_id'];
                mysqli_stmt_bind_param($stmt, "ssss", $cid, $title, $file, $text);
                mysqli_stmt_execute($stmt);
                move_uploaded_file($_FILES['post_file']['tmp_name'], "../images/post/".$_FILES['post_file']['name']);

                header("Location: ../index.php?post=succes");
                exit();
            }
        }
    }
    else {
        header("Location: ../post.php");
        exit();
    }
}
else {
    header("Location: ../index.php");
    exit();
}