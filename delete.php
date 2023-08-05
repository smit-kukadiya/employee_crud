<?php
    include "connection.php";
    $id = $_GET['id'];
    $quary = "DELETE FROM my_employees WHERE id = $id";
    if(mysqli_query($conn, $quary)) {
        header("Location: show.php");
    } else {
        echo mysqli_error($conn);
    }
?>