<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if student ID is provided
if (!isset($_GET['id'])) {
    header("Location: student.php");
    exit();
}

// Retrieve student ID from the URL
$studentId = $_GET['id'];

// Delete student from the database
$sql = "DELETE FROM Students WHERE student_id = $studentId";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: student.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
