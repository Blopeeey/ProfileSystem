<?php
include "header.php";

include "includes/dbh.php";
?>
<!DOCTYPE html>
<html lang="en">

<body>
<div class="acc-left">
    <?php
    $sql = "SELECT * FROM customer WHERE customer_id =".$_SESSION['customer_id'];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo '<img src='.$row['customer_pfp'].' alt="pfp" class="img-pfp"><br/>';
            echo $row['customer_name'];
        }
    }
    ?>
</div>

<div class="acc-right">
    <span class="acc-desc">Description</span><br/><br/>
    <?php
    $sql = "SELECT * FROM customer WHERE customer_id =".$_SESSION['customer_id'];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo nl2br($row['customer_desc']);
        }
    }
    ?>
</div>
<div class="acc-right-2">
    <span class="acc-info">Other info</span><br/><br/>
    <?php
    $sql = "SELECT * FROM customer WHERE customer_id =".$_SESSION['customer_id'];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo 'Username: '. $row['customer_name']. '<br/>';
            echo 'E-mail: '. $row['customer_email']. '<br/>';
            echo 'Date joined: '. $row['customer_join']. '<br/>';
        }
    }
    ?>
</div>
</body>

</html>