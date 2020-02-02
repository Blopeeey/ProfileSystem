<?php
session_start();

if(isset($_SESSION['admin_id'])) {
?>

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

<nav class="navbar navbar-light">
    <div class="container">

    </div>
</nav>

</body>

<?php
}
?>
