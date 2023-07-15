<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if magazine ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: magazines.php");
    exit();
}

$magazineId = $_GET['id'];

// Delete the magazine from the database
$sql = "DELETE FROM magazines WHERE magazine_id='$magazineId'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: magazines.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
