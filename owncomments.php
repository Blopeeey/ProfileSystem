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

$sql = "SELECT * FROM comments, customer WHERE comment_creator =".$_SESSION['customer_id'].' AND comment_creator = customer.customer_id ORDER BY comment_realid DESC';
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
</body>

</html>