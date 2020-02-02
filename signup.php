<?php
include "header.php"
?>
<!DOCTYPE html>
<html lang="en">

<body>
<form action="includes/signup.inc.php" method="post" enctype="multipart/form-data">
    <div class="center-form">
        <div class="form-group">
            <h3>Signup</h3>
            <input type="file" class="form-file" name="sign_pfp">
        </div>
        <div class="form-group">
                <input type="text" class="form-control" name="sign_username" placeholder="Username" value="<?php if(isset($_GET['username'])){ echo $_GET['username'];} ?>">
        </div>
        <div class="form-group">
                <input type="text" class="form-control" name="sign_email" placeholder="E-mail" value="<?php if(isset($_GET['email'])){ echo $_GET['email'];} ?>">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="sign_desc" placeholder="Description" style="text-align: center;"><?php if(isset($_GET['desc'])){ echo $_GET['desc'];} ?></textarea>
        </div>
        <div class="form-group">
                <input type="password" class="form-control" name="sign_password" placeholder="Password">
        </div>
        <div class="form-group">
                <input type="password" class="form-control" name="sign_repass" placeholder="Repeat password">
        </div>
        <button type="submit" class="btn btn-outline-success my-2 my-sm-0" name="signup">Signup</button><br/>

        <?php
        if(isset($_GET['error'])){
            if($_GET['error'] == "emptyfields"){
                echo "<script>swal('Something went wrong', 'You forgot some fields', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "usermaildesc"){
                echo "<script>swal('Something went wrong', 'The username,e-mail and description are invalid', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "username"){
                echo "<script>swal('Something went wrong', 'The username is invalid', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "email"){
                echo "<script>swal('Something went wrong', 'The E-mail is invalid', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "desc"){
                echo "<script>swal('Something went wrong', 'The description is invalid', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "passmatch"){
                echo "<script>swal('Something went wrong', 'The passwords dont match', 'error'); </script>";
                exit();
            }
            elseif($_GET['error'] == "usertaken"){
                echo "<script>swal('Something went wrong', 'The username is already taken', 'error'); </script>";
                exit();
            }
        }

        if(isset($_GET['signup'])){
            if($_GET['signup'] == "succes"){
                echo "<script>swal('Success', 'Account created. you can now login!', 'success'); </script>";
                exit();
            }
        }
        ?>
    </div>
</form>
</body>

</html>