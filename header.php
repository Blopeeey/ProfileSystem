<?php
session_start();
?>
<head>
    <link rel="shortcut icon" href="https://www.wame.nl/build/images/tech_vue.png">
    <title>V-web</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#dropdown").click(function(){
                $(".drop-inhoud").slideToggle();
            });
        });
    </script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="index.php">
            <img src="https://www.wame.nl/build/images/tech_vue.png" width="40" height="40" alt="logo"">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="searchuser.php">Search users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Placeholder</a>
                </li>
            </ul>
        </div>



        <?php
        if(isset($_SESSION['customer_id'])) {
            ?>

            <a href="post.php" style="margin-right: 4%;">Add post</a>

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        include "includes/dbh.php";
                        $sql = "SELECT customer_name FROM customer WHERE customer_id = " . $_SESSION['customer_id'];
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['customer_name']
                        ?>
                        &nbsp
                        <img src="<?php
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
                                echo $row['customer_pfp'];
                            }
                        }
                        ?>" class="img-pfp" width="40" height="40" alt="pfp">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="viewacc.php">View profile</a>
                        <a class="dropdown-item" href="account.php">Edit profile</a>
                        <a class="dropdown-item" href="ownposts.php">Posts/Comments</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="includes/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <?php
        }
        elseif(!isset($_SESSION['customer_id'])) {
            ?>
            <form action="includes/login.inc.php" method="post" class="form-inline my-2 my-lg-0">
                <input type="text" name="login_username" placeholder="Username/E-mail" class="form-control mr-sm-2">
                <input type="password" name="login_password" placeholder="Password" class="form-control mr-sm-2">
                <button type="submit" name="login" class="btn btn-outline-success my-2 my-sm-0">Login</button>
                &nbsp
                <a href="signup.php">Signup</a>
            </form>
            <?php
        }
        ?>
    </nav>

<?php
if(isset($_GET['login']) && $_GET['login'] == "succes") {
    echo "<script>swal('Login success', '', 'info'); </script>";
}
if(isset($_GET['logout']) && $_GET['logout'] == "succes") {
    echo "<script>swal('Logout success', '', 'info'); </script>";
    }

if(isset($_GET['error'])) {
    if ($_GET['error'] == "emptyfieldslogin") {
        echo "<script>swal('Something went wrong', 'You forgot some fields', 'warning'); </script>";
        exit();
    }
    elseif($_GET['error'] == "password"){
        echo "<script>swal('Something went wrong', 'The password is wrong', 'warning'); </script>";
        exit();
    }
    elseif($_GET['error'] == "nouser"){
        echo "<script>swal('Something went wrong', 'User isn\'t found', 'warning'); </script>";
        exit();
    }
}
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>