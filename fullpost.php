<?php
include "header.php";

include "includes/dbh.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
</head>
<body>
<div class="fullpost-back">

</div>
<div class="fullpost-all">
    <div class="container">
        <a href="index.php"><i class='fas fa-arrow-left'></i> Back to home page</a>
        <div class="post-creator">
            <?php
            $cid = $_GET['c'];
            $sql = "SELECT * FROM customer WHERE customer_id = '$cid'";
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result)){
                echo 'Post created by: <a href="viewuser.php?id='.$cid.'"><img src="'.$row['customer_pfp'].'" alt="creator image" width="70" height="70" class="img-pfp">';
                echo $row['customer_name'].'</a>';
            }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="full-post">
            <?php
            $pid = $_GET['id'];
            $sql = "SELECT * FROM post WHERE post_id = '$pid'";
            $result = mysqli_query($conn, $sql);
            if($row = mysqli_fetch_assoc($result)){
                echo '<span style="font-size: 25px;">'.$row['post_title'].'</span>';
                echo '<br/>';
                echo '<img src="'.$row['post_image'].'" alt="post image" width="300" height="300"> ';
                echo $row['post_text'];
            }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="commentcreate-post">
            <form action="includes/createcomment.inc.php?pid=<?php echo $_GET['id']; ?>&cid=<?php echo $_GET['c']; ?>" method="post">
                <h5>Place a comment</h5>
                <textarea class="comment-textarea" name="comment-text" placeholder="Insert comment" rows="4"></textarea>
                <button type="submit" name="comment" class="btn btn-outline-info my-2 my-sm-0">Place</button>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="commentshow-post">
            <?php
            $pid = $_GET['id'];
            $sql = "SELECT * FROM comments, customer WHERE comment_id =".$pid.' AND comment_creator = customer.customer_id ORDER BY comment_realid DESC';
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="comment-text">';
                    echo '<span class="comment-user">User: ' . $row['customer_name'].'</span><br/>';
                    echo '<span class="comment-inhoud">'.$row['comment_text'].'</span><br/>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>
</body>

</html>
