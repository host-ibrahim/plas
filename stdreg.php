<?php
include_once("constant.php");
include_once("connection.php");

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$username = $_POST['username'];
$password = $_POST['password'];

$imgurl = $_FILES['photo']['name'];
$targetDirectory = "images/student/";
$currentTimestamp = hrtime(true);

$targetFilePath = $targetDirectory.$currentTimestamp.basename($imgurl);

$imgurl = $currentTimestamp.basename($imgurl);
// File does not exist, proceed with insertion and move the uploaded file
if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
    // Insert data into students table
    $sql = "INSERT INTO students (first_name, last_name, email, phone, address, imageurl)
                VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', '$imgurl')";
    if (mysqli_query($conn, $sql)) {
        $student_id = mysqli_insert_id($conn); // Get the auto-generated student_id

        // Insert data into students_login table
        $sql = "INSERT INTO students_login (student_id, username, password)
                    VALUES ('$student_id', '$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            // Registration successful
            mysqli_close($conn);
            echo "<script>alert('Registration successful!'); window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error uploading the file.";
}

// Close the database connection
mysqli_close($conn);
