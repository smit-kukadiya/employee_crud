<?php 
    $conn = mysqli_connect("localhost", "root", "", "employee");
    if(!$conn) {
        die("connection faild: ". mysqli_connect_error());
    }
?>