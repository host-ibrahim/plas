<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if newspaper ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: newspaper.php");
    exit();
}

$newspaperId = $_GET['id'];

// Delete the newspaper from the database
$sql = "DELETE FROM Newspapers WHERE newspaper_id='$newspaperId'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: newspaper.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
