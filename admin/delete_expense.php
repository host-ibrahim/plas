<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if expense ID is provided
if (!isset($_GET['id'])) {
    header("Location: expense.php");
    exit();
}

// Get expense ID from the query string
$expenseId = $_GET['id'];

// Delete expense from the database
$sql = "DELETE FROM expenses WHERE expense_id = '$expenseId'";
$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: expense.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
