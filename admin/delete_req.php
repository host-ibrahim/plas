<?php
include_once("../constant.php");
include_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $reqId = $_GET['id'];

    // Retrieve the issued book details from the database
    $sql = "SELECT * FROM `book_requests` WHERE request_id = '$reqId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Perform necessary actions to delete the issued book
        $deleteSql = "DELETE FROM `book_requests` WHERE request_id = '$reqId'";
        $deleteResult = mysqli_query($conn, $deleteSql);

        if ($deleteResult) {
            // Redirect to the issued books page after deleting the issued book
            header("Location: issue_request.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Invalid Request ID";
    }
}

// Close the database connection
mysqli_close($conn);
?>
