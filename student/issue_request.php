<?php
include_once("includes/authstudent.php");
include_once("../constant.php");
include_once("../connection.php");

$stdid = $_SESSION['student123'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $student_id = $_POST['student_id'];
    $book_id = $_POST['book_id'];

    // Insert book request data into the database
    $sql = "INSERT INTO book_requests (student_id, book_id, request_date, status)
            VALUES ('$student_id', '$book_id', NOW(), 'Pending')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: issue_request.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve book data from the database
$sql = "SELECT * FROM books WHERE `available_quantity` > 0";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error: " . mysqli_error($conn);
}


// Retrieve student data from the database
$sql = "SELECT * FROM book_requests join books WHERE book_requests.book_id = books.book_id && book_requests.student_id = '$stdid'";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $bookrequset = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Retrieve student data from the database
$sql = "SELECT * FROM students WHERE student_id = '$stdid'";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $student = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
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
                            <h1 class="m-0">All Books</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">All Books</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex">
                                    <h4>List of Books</h4>
                                    <div class="card-tools ml-auto">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-book">
                                            <span class="fas fa-plus"></span>&nbsp;&nbsp;Request Book
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Student Name</th>
                                                <th>Book</th>
                                                <th>Request Date</th>
                                                <th>Status</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bookrequset as $i => $bookreq) : ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $student['first_name'] . ' ' . $student['last_name'] ?></td>
                                                    <td><?= $bookreq['title'] ?></td>
                                                    <td><?= date('d-m-Y g:i A', strtotime($bookreq['request_date'])) ?></td>
                                                    <td><?= $bookreq['status'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Book Modal -->
        <div class="modal fade" id="modal-book" tabindex="-1" role="dialog" aria-labelledby="modal-book-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-book-title">Request Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="student_name">Student Name</label>
                                <input type="hidden" id="student_id" name="student_id" value="<?= $stdid ?>" readonly />
                                <input type="text" class="form-control" id="student_name" name="student_name" value="<?= $student['first_name'] . ' ' . $student['last_name'] ?>" readonly />
                            </div>
                            <div class="form-group">
                                <label for="book_id">Book</label>
                                <select class="form-control" id="book_id" name="book_id" required>
                                    <option value="">Select Book</option>
                                    <?php foreach ($books as $book) : ?>
                                        <option value="<?= $book['book_id'] ?>"><?= $book['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Request Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once("includes/footer.php"); ?>
    </div>
    <?php include_once("includes/bottom.php"); ?>
</body>

</html>