<?php

include "includes/dbh.php";

$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $a[] = $row['customer_name'];
    }
}

$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = "<a href=''>$name</a>";
            } else {
                $hint .= "<br/><a href=''>$name</a>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no user found" : $hint;
?>
