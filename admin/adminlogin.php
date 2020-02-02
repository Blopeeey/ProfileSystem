<html lang="en">

<head>
    <link rel="shortcut icon" href="https://www.wame.nl/build/images/tech_vue.png">
    <title>Admin</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../css/adminstyles.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <form action="includes/login.inc.php" method="post">
        <div class="admin-login">
            <h4>Admin login</h4><br/>
            <div class="form-group">
                <input type="text" class="form-control" name="admin-username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="admin-password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary" name="admin-login">Login</button>
        </div>
    </form>
</body>

</html>