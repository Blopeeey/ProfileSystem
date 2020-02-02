<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="account-all">
        <h2>Edit profile</h2>

        <form action="includes/account.inc.php" method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="inputPfp3" class="col-sm-2 col-form-label">Pfp</label>
                <div class="col-sm-10">
                    <input type="file" name="acc_pfp" id="inputPfp3">
                    <?php
                    include "includes/dbh.php";
                    $sql = "SELECT customer_pfp FROM customer WHERE customer_id = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "fout";
                    }
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['customer_id']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<img src=".$row['customer_pfp']." width='100' height='100'>";
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="acc_username" class="form-control" id="inputUsername3" placeholder="Username" value="<?php
                    include "includes/dbh.php";
                    $sql = "SELECT customer_name FROM customer WHERE customer_id = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "fout";
                    }
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['customer_id']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo $row['customer_name'];
                        }
                    }
                    ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="acc_email" class="form-control" id="inputEmail3" placeholder="Email" value="<?php
                    include "includes/dbh.php";
                    $sql = "SELECT customer_email FROM customer WHERE customer_id = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "fout";
                    }
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['customer_id']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo $row['customer_email'];
                        }
                    }
                    ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="acc_desc" class="form-control" placeholder="Description" rows="3"><?php
                    include "includes/dbh.php";
                    $sql = "SELECT customer_desc FROM customer WHERE customer_id = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "fout";
                    }
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['customer_id']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo $row['customer_desc'];
                        }
                    }
                        ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="acc_password" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputrePassword3" class="col-sm-2 col-form-label">Repeat Password</label>
                <div class="col-sm-10">
                    <input type="password" name="acc_repass" class="form-control" id="inputrePassword3" placeholder="Repeat Password">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" name="acc_edit" class="btn btn-outline-success my-2 my-sm-0">Edit profile</button>
                </div>
            </div>

            <script>
                $(document).ready(function(){
                    $("#deleteacc").click(function(){
                        $(".confirmdel").show();
                        $("h2, nav, .form-group").addClass("blur");
                    });
                });
            </script>


            <div class="form-group row">
                <div class="col-sm-10">
                    <span class="btn btn-outline-danger" id="deleteacc">Delete account</span>
                </div>
            </div>

            <div class="confirmdel" style="display: none;">
                Are you sure you want to delete your account?<br/><br/>
                <button type="submit" class="btn btn-outline-danger" name="acc-delete">Delete</button>
                <button type="submit" class="btn btn-outline-success" name="no-del">Don't delete</button>
            </div>
        </form>
    </div>
    <?php
        if(isset($_GET['error'])){
            if($_GET['error'] == "usermail"){
                echo "<script>swal('Something went wrong', 'Username and E-mail are invalid', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "username"){
                echo "<script>swal('Something went wrong', 'Username is invalid', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "email"){
                echo "<script>swal('Something went wrong', 'E-mail is invalid', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "passmatch"){
                echo "<script>swal('Something went wrong', 'Passwords dont match', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "usertaken"){
                echo "<script>swal('Something went wrong', 'Username is already taken', 'error'); </script>";
                exit();
            }
        }
        if(isset($_GET['edit']) && $_GET['edit'] == "succes1"){
            echo "<script>swal('Success', 'Info has been edited', 'success'); </script>";
            exit();
        }
        if(isset($_GET['edit']) && $_GET['edit'] == "succes2"){
            echo "<script>swal('Success', 'Info has been edited', 'success'); </script>";
            exit();
        }
        if(isset($_GET['edit']) && $_GET['edit'] == "succes3"){
            echo "<script>swal('Success', 'Info has been edited', 'success'); </script>";
            exit();
        }

        if(isset($_GET['account']) && $_GET['account'] == "nodel"){
            echo "<script>swal('Success', 'Account not deleted', 'success'); </script>";
            exit();
        }
    ?>
</body>
</html>
