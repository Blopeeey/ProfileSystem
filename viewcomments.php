<?php
include "header.php";

include "includes/dbh.php";
?>
<!DOCTYPE html>
<html lang="en">

<body>
<div class="profile">
    <div class="profile-account">
        <?php
        $cid = $_GET['id'];

        $sql = "SELECT * FROM customer WHERE customer_id = '$cid'";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)){
            echo '<img src="'.$row['customer_pfp'].'" alt="creator image" width="120" height="120" height="70"><br/> ';
            echo $row['customer_name'];
        }
        ?>
        </div>
            <div class="acc-choice">
                <a href="viewuser.php?id=<?php echo $cid; ?>">Posts</a> - <a href="">Comments</a>
            </div>
    <?php
        $sql = "SELECT * FROM comments, customer WHERE comment_creator =".$cid.' AND comment_creator = customer.customer_id ORDER BY comment_realid DESC';
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
        ?>

    <div class="container-account">
            <div class="post-index-show">
                <?php
                echo '<div class="comment-text-show">';
                echo '<span class="comment-user-show">User: ' . $row['customer_name'].'</span><br/>';
                echo '<span class="comment-inhoud-show">'.$row['comment_text'].'</span><br/>';
                echo '</div>';
                ?>
            </div>

    </div>
    <?php
    }
    }
    ?>
</div>
</body>

</html>