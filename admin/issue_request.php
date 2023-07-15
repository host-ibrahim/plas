<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newStatus = $_POST['status'];
    $reqid = $_POST['request_id'];

    // Update the status in the database
    // Update the status in the database
    $updateSql = "UPDATE book_requests SET `status` = '$newStatus' WHERE request_id = $reqid";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($newStatus == "Approved") {
        // Retrieve student_id and book_id from book_requests table
        $fetchSql = "SELECT student_id, book_id FROM book_requests WHERE request_id = $reqid";
        $fetchResult = mysqli_query($conn, $fetchSql);
        $row = mysqli_fetch_assoc($fetchResult);
        $studentId = $row['student_id'];
        $bookId = $row['book_id'];

        $bookquantsql = "UPDATE `books` SET `available_quantity` = `available_quantity` - 1 WHERE book_id = $bookId";
        $bookresult = mysqli_query($conn, $bookquantsql);

        // Insert into bookissues table
        $issueDate = date('Y-m-d');
        $sql = "INSERT INTO bookissues (student_id, book_id, issue_date) VALUES ('$studentId', '$bookId', '$issueDate')";
        $result = mysqli_query($conn, $sql);
    }

    if ($updateResult) {
        // Status updated successfully
        // Redirect or display a success message
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve student data from the database
$sql = "SELECT * FROM book_requests b
JOIN students s ON b.student_id = s.student_id
JOIN books bk ON b.book_id = bk.book_id";

$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $bookrequset = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bookrequset as $i => $bookreq) : ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $bookreq['first_name'] . ' ' . $bookreq['last_name'] ?></td>
                                                    <td><?= $bookreq['title'] ?></td>
                                                    <td><?= date('d-m-Y g:i A', strtotime($bookreq['request_date'])) ?></td>
                                                    <td>
                                                        <form action="" class="d-flex" method="POST">
                                                            <input type="hidden" name="request_id" value="<?= $bookreq['request_id'] ?>">
                                                            <select class="form-control" name="status">
                                                                <option value="Pending" <?php if ($bookreq['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                                                <option value="Approved" <?php if ($bookreq['status'] == 'Approved') echo 'selected'; ?>>Approved</option>
                                                                <option value="Rejected" <?php if ($bookreq['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                                                            </select>
                                                            <input type="submit" class="btn btn-warning btn-sm ml-3" value="Update">
                                                        </form>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="delete_req.php?id=<?= $bookreq['request_id'] ?>" onclick="return confirm('Are you sure to delete this requset?')">
                                                            <span class="fas fa-trash text-danger"></span>
                                                        </a>
                                                    </td>
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

        <?php include_once("includes/footer.php"); ?>
    </div>
    <?php include_once("includes/bottom.php"); ?>
</body>

</html>