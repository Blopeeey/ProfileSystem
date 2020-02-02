<?php
include "header.php";

if(isset($_SESSION['customer_id'])) {
?>
  <head>
      <title>Search user</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script>
          function showHint(str) {
              if (str.length == 0) {
                  document.getElementById("txtHint").innerHTML = "";
                  return;
              } else {
                  var xmlhttp = new XMLHttpRequest();
                  xmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("txtHint").innerHTML = this.responseText;
                      }
                  };
                  xmlhttp.open("GET", "gethint.php?q=" + str, true);
                  xmlhttp.send();
              }
          }
      </script>
  </head>

<body>

<form>
<div class="search-username">
    <input type="text" name="search-username" class="form-control" id="search-username" onkeyup="showHint(this.value)" placeholder="Insert username">
    <div id="txtHint"></div>
</div>
</form>



<?php
}
?>

<div class="nologin">
    <?php
    if(!isset($_SESSION['customer_id'])){
        echo 'You have to sign in before you can search users';
    }
    ?>
</div>

</body>