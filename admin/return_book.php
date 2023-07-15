<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['issue_id'])) {
    $issueId = $_GET['issue_id'];

    // Retrieve the issued book details from the database
    $sql = "SELECT * FROM bookissues WHERE issue_id = '$issueId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $issuedBook = mysqli_fetch_assoc($result);

        // Perform necessary actions to mark the book as returned
        $returnDate = date("Y-m-d");
        $updateSql = "UPDATE bookissues SET return_date = '$returnDate' WHERE issue_id = '$issueId'";
        $bookId = $issuedBook['book_id'];

        $bookquantsql = "UPDATE `books` SET `available_quantity` = `available_quantity` + 1 WHERE book_id = $bookId";
        $bookresult = mysqli_query($conn, $bookquantsql);
        $updateResult = mysqli_query($conn, $updateSql);

        if ($updateResult) {
            // Redirect to the issued books page after returning the book
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
