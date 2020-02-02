<?php
ini_set('display_errors', 1);
if(isset($_POST['login'])){

    include "dbh.php";

    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    if(empty($username) || empty($password)){
        header("Location: ../index.php?error=emptyfieldslogin");
        exit();
    }
    else{
        $sql = "SELECT * FROM customer WHERE customer_name = ? OR customer_email = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $username, $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                    $passver = password_verify($password, $row['customer_password']);
                    if($passver == false){
                        header("Location: ../index.php?error=password");
                        exit();
                    }
                    elseif($passver == true){
                        session_start();
                        $_SESSION['customer_id'] = $row['customer_id'];
                        $_SESSION['customer_name'] = $row['customer_name'];
                        $_SESSION['customer_pfp'] = $row['customer_pfp'];

                        header("Location: ../index.php?login=succes");
                        exit();
                    }
                }
                else{
                    header("Location: ../index.php?error=nouser");
                    exit();
            }
        }
    }
}
else{
    header("Location: index.php");
    exit();
}