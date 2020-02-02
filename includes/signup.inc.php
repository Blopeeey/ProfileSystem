<?php
if(isset($_POST['signup'])){


    include "dbh.php";


    $username = $_POST['sign_username'];
    $email = $_POST['sign_email'];
    $desc = $_POST['sign_desc'];
    $password = $_POST['sign_password'];
    $repass = $_POST['sign_repass'];
    $pfp = "images/pfp/".$_FILES['sign_pfp']['name'];
    $currdate = date("d/m/Y");

    if(empty($username) || empty($email) || empty($desc) || empty($password) || empty($repass)){
        header("Location: ../signup.php?error=emptyfields&username=".$username."&email=".$email."&desc=".$desc);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9_ -]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9_ -]*$/", $desc)){
        header("Location: ../signup.php?error=usermaildesc");
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../signup.php?error=username&email=".$email."&desc=".$desc);
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=email&username=".$username."&desc=".$desc);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9_ -,.]*$/", $desc)){
        header("Location: ../signup.php?error=desc&username=".$username."&email=".$email);
        exit();
    }
    elseif($password != $repass){
        header("Location: ../signup.php?error=passmatch&username=".$username."&email=".$email);
        exit();
    }
    else{
        $sql = "SELECT customer_name FROM customer WHERE customer_name = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror1");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rescheck = mysqli_stmt_num_rows($stmt);
            if ($rescheck > 0){
                header("Location: ../signup.php?error=usertaken");
                exit();
            }
            else{
                $sql = "INSERT INTO customer(customer_name, customer_email, customer_desc, customer_password, customer_pfp, customer_join) VALUES(?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror2");
                    exit();
                }
                else{
                    if($pfp == "images/pfp/") {
                        $pfp = "images/pfp/userpfp.png";
                    }
                    $hashpass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $desc, $hashpass, $pfp, $currdate);
                    mysqli_stmt_execute($stmt);
                    move_uploaded_file($_FILES['sign_pfp']['tmp_name'], "../images/pfp/".$_FILES['sign_pfp']['name']);
                    header("Location: ../signup.php?signup=succes");
                    exit();
                }
            }
        }
    }
}
else{
    header("Location: ../signup.php?error=invalid");
    exit();
}