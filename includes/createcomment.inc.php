<?php
session_start();

if(isset($_POST['comment'])){
    if(isset($_SESSION['customer_id'])){

        include "dbh.php";

        $creator_id = $_GET['cid'];
        $post_id = $_GET['pid'];
        $commenttext = $_POST['comment-text'];

        if(empty($commenttext)){
            header("Location: ../fullpost.php?emptyfields&c=$creator_id&id=$post_id");
            exit();
        }
        elseif(!preg_match("/^[a-zA-Z0-9\s.]*$/", $commenttext)){
            header("Location: ../fullpost.php?mehmetisbol&c=$creator_id&id=$post_id");
            exit();
        }
        else{
            $sql = "INSERT INTO comments(comment_id, comment_creator, comment_text) VALUES(?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: fullpost.php?sqlerror&c=$creator_id&id=$post_id");
                exit();
            }
            else{
                $ownid = $_SESSION['customer_id'];
                mysqli_stmt_bind_param($stmt, "sss",$post_id,$ownid, $commenttext);
                mysqli_stmt_execute($stmt);

                header("Location: ../fullpost.php?comment=succes&c=$creator_id&id=$post_id");
                exit();
            }
        }
    }
}