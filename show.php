<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Employees</title>
</head>

<body>
    <h1>Show Employees</h1>
    <table border="1">
        <thead>
            <td>ID</td>
            <td>Name</td>
            <td>email</td>
            <td>DOB</td>
            <td>HSC</td>
            <td>Gender</td>
            <td>Update</td>
            <td>Delete</td>
        </thead>
        <?php
        include "connection.php";
        $quary = "SELECT * FROM my_employees";
        $result = mysqli_query($conn, $quary);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
        ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["dob"]; ?></td>
                    <td><?php echo $row["hsc"]; ?></td>
                    <td><?php $gender = $row["gender"] ? "female" : "male";
                        echo $gender ?></td>
                    <td><button onclick="window.location.href='update.php?id=<?php echo $id; ?>'">
                            Update
                        </button></td>
                    <td><button onclick="window.location.href='delete.php?id=<?php echo $id; ?>'">
                            Delete
                        </button></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</body>

</html>