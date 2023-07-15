<?php
include_once("../constant.php");
include_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['issue_id'])) {
    $issueId = $_GET['issue_id'];

    // Retrieve the issued book details from the database
    $sql = "SELECT * FROM bookissues WHERE issue_id = '$issueId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $issuedBook = mysqli_fetch_assoc($result);

        // Perform necessary actions to delete the issued book
        $deleteSql = "DELETE FROM bookissues WHERE issue_id = '$issueId'";
        $deleteResult = mysqli_query($conn, $deleteSql);

        if ($deleteResult) {
            // Redirect to the issued books page after deleting the issued book
            header("Location: issued-books.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Invalid issue ID";
    }
}

// Close the database connection
mysqli_close($conn);
?>
