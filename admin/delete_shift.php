<?php
include_once("../constant.php");
include_once("../connection.php");

// Retrieve shift ID from the query string
$shiftId = $_GET['id'];

// Delete shift from the database
$sql = "DELETE FROM shifts WHERE shift_id = '$shiftId'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: shift.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
