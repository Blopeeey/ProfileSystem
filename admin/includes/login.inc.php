<?php
if(isset($_POST['admin-login'])){

    include "../../includes/dbh.php";

    $username = $_POST['admin-username'];
    $password = $_POST['admin-password'];

    if(empty($username) || empty($password)){
        header("Location: ../adminlogin.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT * FROM admin WHERE admin_username = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../adminlogin.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            echo $password;
            if($row = mysqli_fetch_assoc($result)){
                    $passver = password_verify($password, $row['admin_password']);
                    if($passver == false){
                        header("Location: ../adminlogin.php?error=pass");
                        exit();
                    }
                    elseif($passver == true){
                        session_start();
                        $_SESSION['admin_id'] = $row['admin_id'];
                        $_SESSION['admin_username'] = $row['admin_username'];
                        $_SESSION['admin_password'] = $row['admin_password'];
                        header("Location: ../adminhome.php?login=succes");
                        exit();
                    }
                }
            else{
                header("Location: ../adminlogin.php?error=nouser");
                exit();
            }
        }
    }
}