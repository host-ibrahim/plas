<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if book ID is provided in the URL
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Delete book from the database
    $sql = "DELETE FROM books WHERE book_id = $bookId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: books.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Book ID not provided.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
