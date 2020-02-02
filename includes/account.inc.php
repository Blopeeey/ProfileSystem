<?php
session_start();
echo ini_get('display_errors');
if(isset($_POST['acc_edit'])) {

    include "dbh.php";

    $pfp = "images/pfp/" . $_FILES['acc_pfp']['name'];
    $username = $_POST['acc_username'];
    $email = $_POST['acc_email'];
    $desc = $_POST['acc_desc'];
    $password = $_POST['acc_password'];
    $repass = $_POST['acc_repass'];

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../account.php?error=usermail");
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../account.php?error=username");
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9_ -,.'\"\s]*$/", $desc)) {
        header("Location: ../account.php?error=html");
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../account.php?error=email");
        exit();
    }
    elseif($pfp == "images/pfp/" && empty($password)){
        $sql = "UPDATE customer SET customer_name = ?, customer_email = ?, customer_desc = ? WHERE customer_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../account.php?error=sqlerror");
            exit();
        }
        else{
            $cid = $_SESSION['customer_id'];
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $desc, $cid);
            mysqli_stmt_execute($stmt);
            echo $cid;
            header("Location: ../account.php?edit=succes1");
            exit();
        }
    }
    elseif($pfp == "images/pfp/"){
        $sql = "UPDATE customer SET customer_name = ?, customer_email = ?, customer_desc = ?, customer_password = ? WHERE customer_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../account.php?error=sqlerror");
            exit();
        }
        else{
            $hashpass = password_hash($password, PASSWORD_DEFAULT);
            $cid = $_SESSION['customer_id'];
            mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $desc, $hashpass, $cid);
            mysqli_stmt_execute($stmt);
            echo $cid;
            header("Location: ../account.php?edit=succes1");
            exit();
        }
    }
    elseif (empty($password) || empty($repass)) {
        $cid = $_SESSION['customer_id'];
        $sql = "UPDATE customer SET customer_name = ?, customer_email = ?, customer_desc = ?, customer_pfp = ? WHERE customer_id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../account.php?error=sqlerror2");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $desc, $pfp, $cid);
            mysqli_stmt_execute($stmt);
            move_uploaded_file($_FILES['acc_pfp']['tmp_name'], "../images/pfp/" . $_FILES['acc_pfp']['name']);
            header("Location: ../account.php?edit=succes1");
            exit();
        }
    }
    elseif ($password != $repass) {
        header("Location: ../account.php?error=passmatch");
        exit();
    }
    else {
        $cid = $_SESSION['customer_id'];
        $sql = "SELECT * FROM customer WHERE customer_id = '$cid'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            if ($username == $row['customer_name']) {
                $sql = "UPDATE customer SET customer_email = ?, customer_desc = ?, customer_password = ?, customer_pfp = ? WHERE customer_id = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../account.php?error=sqlerror2");
                    exit();
                } else {
                    $hashpass = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss", $email, $desc, $hashpass, $pfp, $cid);
                    mysqli_stmt_execute($stmt);
                    move_uploaded_file($_FILES['acc_pfp']['tmp_name'], "../images/pfp/" . $_FILES['acc_pfp']['name']);
                    header("Location: ../account.php?edit=succes2");
                    exit();
                }
            } else {
                $sql = "SELECT * FROM customer WHERE customer_name = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../account.php?error=sqlerror1");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        header("Location: ../account.php?error=usertaken");
                        exit();
                    } else {
                        $sql = "UPDATE customer SET customer_name = ?, customer_email = ?, customer_desc = ?, customer_password = ?, customer_pfp = ? WHERE customer_id = ?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../account.php?error=sqlerror2");
                            exit();
                        } else {
                                $hashpass = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "ssssss", $username, $email, $desc, $hashpass, $pfp, $cid);
                                mysqli_stmt_execute($stmt);
                                move_uploaded_file($_FILES['acc_pfp']['tmp_name'], "../images/pfp/" . $_FILES['acc_pfp']['name']);
                                header("Location: ../account.php?edit=succes3");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
elseif(isset($_POST['acc-delete'])){

    include "dbh.php";

    $cid = $_SESSION['customer_id'];
    $sql = "DELETE FROM customer WHERE customer_id = '$cid'";
    $result = mysqli_query($conn, $sql);
    session_unset();
    session_destroy();

    header("Location: ../index.php?account=deleted");
    exit();
}
elseif(isset($_POST['no-del'])){
    header("Location: ../account.php?account=nodel");
    exit();
}
else{
    header("Location: ../account.php");
    exit();
}