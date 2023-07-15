<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];

    // Insert shift data into the database
    $sql = "INSERT INTO shifts (name, start_time, end_time) VALUES ('$name', '$startTime', '$endTime')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: shift.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve shift data from the database
$sql = "SELECT * FROM shifts";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $shifts = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Shifts Page -->
<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>

<body class="sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">
        <?php include_once("includes/header.php"); ?>
        <?php include_once("includes/sidebar.php"); ?>

        <!-- Page Content -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">All Shifts</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Shifts</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content Header -->

            <!-- Main Content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex">
                                    <h4>List of Shifts</h4>
                                    <div class="card-tools ml-auto">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-shift">
                                            <span class="fas fa-plus"></span>&nbsp;&nbsp;Add New
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($shifts as $i => $shift) : ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $shift['name'] ?></td>
                                                    <td><?= date('g:i A', strtotime($shift['start_time'])) ?></td>
                                                    <td><?= date('g:i A', strtotime($shift['end_time'])) ?></td>
                                                    <td class="text-center">
                                                        <a href="edit_shift.php?id=<?= $shift['shift_id'] ?>"><span class="fas fa-edit text-primary"></span></a>
                                                        <a href="delete_shift.php?id=<?= $shift['shift_id'] ?>" class="ml-3" onclick="return confirm('Are you sure to delete this shift?')">
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
            <!-- End Main Content -->
        </div>
        <!-- End Page Content -->

        <!-- Add Shift Modal -->
        <div class="modal fade" id="modal-shift" tabindex="-1" role="dialog" aria-labelledby="modal-shift-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-shift-title">Add New Shift</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Shift Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time" required>
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Shift</button>
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
