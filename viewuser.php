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
        <a href="viewuser.php?id=<?php echo $cid; ?>">Posts</a> - <a href="viewcomments.php?id=<?php echo $cid; ?>">Comments</a>
    </div>
    <?php
    $sql = "SELECT * FROM post WHERE post_creator =".$cid." ORDER BY post_id DESC ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
    ?>
    <div class="container-account">
        <a href="fullpost.php?id=<?php echo $row['post_id']; ?>&c=<?php echo $row['post_creator']; ?>">
            <div class="post-index">
                <h5><?php echo $row['post_title']; ?></h5>
                <img src="<?php echo $row['post_image']; ?>" alt="post-img" width="110" height="110">
                <span style="margin: 10% auto;"><?php echo $row['post_text']; ?></span>
            </div>
        </a>
    </div>
    <?php
        }
    }
    ?>
</div>
</body>

</html>