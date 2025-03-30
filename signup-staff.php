<?php  
    $name = $_POST['stname'];
    $pass = $_POST['stpass'];
    $ic = $_POST['stic'];
    $category = $_POST['stcategory'];
    $email = $_POST['stemail'];
    $address = $_POST['staddress'];
    $phone = $_POST['stphone'];

    // Default values for sex and status (you can modify these as needed)
    $sex = "Not specified";
    $status = "Active";

    include "dbconnect.php";

    $sql = "INSERT INTO `temp_teacher`(`tmp_tcr_ic`, `tmp_tcr_password`, `tmp_tcr_name`, `tmp_tcr_sex`, `tmp_tcr_status`, `tmp_tcr_address`, `tmp_tcr_telnum`, `tmp_tcr_email`) 
            VALUES ('$ic', '$pass', '$name', '$sex', '$status', '$address', '$phone', '$email')";

    $result = mysqli_query($db, $sql);

    if ($result) {
        $sql2 = "SELECT `tmp_tcr_id` FROM `temp_teacher` ORDER BY `tmp_tcr_id` DESC LIMIT 1";
        $result2 = mysqli_query($db, $sql2);
        $row = mysqli_fetch_assoc($result2);
        $last_id = $row['tmp_tcr_id'];

        if ($category == "Teacher") {
            header("Location: signup-teacher.php?id=".$last_id);
        } else {
            header("Location: signup-admin.php?id=".$last_id);
        }
    } else {
        echo '<script>alert("Error! There was an issue during registration.");</script>';
        echo '<script>window.location.assign("signup-staff.html");</script>';
    }
?>
