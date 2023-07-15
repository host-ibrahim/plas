<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if issue ID is provided in the URL
if (!isset($_GET['issue_id'])) {
    header("Location: issued-books.php");
    exit();
}

$issueId = $_GET['issue_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $studentId = $_POST['student_id'];
    $bookId = $_POST['book_id'];
    $issueDate = $_POST['issue_date'];

    // Update issue details in the database
    $sql = "UPDATE bookissues SET student_id='$studentId', book_id='$bookId', issue_date='$issueDate' WHERE issue_id='$issueId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: issued-books.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve issue details from the database
$sql = "SELECT * FROM bookissues WHERE issue_id='$issueId'";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $issuedBook = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>

<body class="sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">

        <?php include_once("includes/header.php"); ?>
        <?php include_once("includes/sidebar.php"); ?>
        <!-- There is My Page Code -->

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit Issued Book</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="issued-books.php">Issued Books</a></li>
                                <li class="breadcrumb-item active">Edit Issued Book</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Issued Book</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="student_id">Student ID</label>
                                            <select class="form-control" id="student_id" name="student_id" required>
                                                <option value="">Select Student</option>
                                                <?php
                                                // Retrieve student data from the database
                                                $studentSql = "SELECT * FROM students";
                                                $studentResult = mysqli_query($conn, $studentSql);

                                                // Check if query execution was successful
                                                if ($studentResult && mysqli_num_rows($studentResult) > 0) {
                                                    while ($student = mysqli_fetch_assoc($studentResult)) {
                                                        $selected = ($student['student_id'] == $issuedBook['student_id']) ? 'selected' : '';
                                                        echo "<option value='{$student['student_id']}' $selected>{$student['first_name']} {$student['last_name']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_id">Book ID</label>
                                            <select class="form-control" id="book_id" name="book_id" required>
                                                <option value="">Select Book</option>
                                                <?php
                                                // Retrieve book data from the database
                                                $bookSql = "SELECT * FROM books";
                                                $bookResult = mysqli_query($conn, $bookSql);

                                                // Check if query execution was successful
                                                if ($bookResult && mysqli_num_rows($bookResult) > 0) {
                                                    while ($book = mysqli_fetch_assoc($bookResult)) {
                                                        $selected = ($book['book_id'] == $issuedBook['book_id']) ? 'selected' : '';
                                                        echo "<option value='{$book['book_id']}' $selected>{$book['title']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="issue_date">Issue Date</label>
                                            <input type="date" class="form-control" id="issue_date" name="issue_date" value="<?= $issuedBook['issue_date'] ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Issued Book</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once("includes/footer.php"); ?>

    </div>
    <?php include_once("includes/bottom.php");
    // Close the database connection
    mysqli_close($conn); ?>
</body>

</html>