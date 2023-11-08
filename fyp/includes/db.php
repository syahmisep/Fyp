<?php 

$conn = mysqli_connect("localhost", "root", "", "datainternship");
// $conn = mysqli_connect("localhost", "root", "", "datainternship");

if(!$conn) {
    echo "Connection Failed";
    exit();
}

?>