<?php
include_once("../constant.php");
include_once("../connection.php");

// Retrieve employee ID from the query string
$employeeId = $_GET['id'];

// Delete employee from the database
$sql = "DELETE FROM employees WHERE employee_id = '$employeeId'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: employee.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
