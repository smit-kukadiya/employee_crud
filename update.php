<?php
    include "connection.php";
    $id = $_GET['id'];
    $quary = "SELECT * FROM my_employees WHERE id = $id";
    $result = mysqli_query($conn, $quary);
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $email = $row['email'];
            $dob = $row['dob'];
            $hsc = $row['hsc'];
            $gender = $row['gender'];
        }
    } 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Employee</title>
</head>
<body>
    <h1>Update Employee</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td>First name</td>
                <td><input type="text" name="firstName" id="firstName" value="<?php echo $firstName; ?>"></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="lastName" id="lastName" value="<?php echo $lastName; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="mail" id="mail" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>DOB</td>
                <td><input type="date" name="dob" id="dob" value="<?php echo $dob; ?>"></td>
            </tr>
            <tr>
                <td>HSC</td>
                <td><input type="number" name="hsc" id="hsc" value="<?php echo $hsc; ?>"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" value="male" <?php if(!$gender) echo "checked"; ?>><label for="gender">Male</label>
                    <input type="radio" name="gender" value="female" <?php if($gender) echo "checked"; ?>><label for="gender">Female </label>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Submit"></td>
                <td><input type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>
    <?php
    if(isset($_POST["submit"])) {
        $check = 0;
        $firstName = $_POST['firstName'];
        $firstNamePattern = "/[a-zA-Z]{5}/i";
        if(!preg_match($firstNamePattern, $firstName)) {
            echo "firstName err ".$firstName;
            $check = 1;
        }
        $lastName = $_POST['lastName'];
        $lastNamePattern = "/[a-zA-Z]{5}/i";
        if(!preg_match($lastNamePattern, $lastName)) {
            echo "<br/>lastName err ".$lastName;
            $check = 1;
        }
        $email = $_POST['mail'];
        $emailPattern = "/^[a-zA-Z0-9.!#$%&*'+=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
        if(!preg_match($emailPattern, $email)) {
            echo "<br/>email err ".$email;
            $check = 1;
        }
        $hsc = $_POST['hsc'];
        $hscPattern = filter_var($hsc, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0, 'max_range' => 100)));
        if($hscPattern == false) {
            echo "<br/>hsc err ".$hsc;
            $check = 1;
        }
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        if($gender == "male")
            $genderBool = 0;
        else
            $genderBool = 1;
        if(!$check) {
            $update_q = "UPDATE my_employees SET first_name = '$firstName', last_name = '$lastName', email = '$email', dob = $dob, hsc = $hsc, gender = '$genderBool' WHERE id = $id";
            if(mysqli_query($conn, $update_q))
                header("Location: show.php");
            else
                echo mysqli_error($conn);
        }
    }
    ?>
</body>
</html>