<?php
include_once("../constant.php");
include_once("../connection.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $shiftId = $_POST['shift_id'];
    $name = $_POST['name'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];

    // Update shift data in the database
    $sql = "UPDATE shifts SET name = '$name', start_time = '$startTime', end_time = '$endTime' WHERE shift_id = '$shiftId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: shift.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Retrieve shift data from the database based on shift ID
    $shiftId = $_GET['id'];
    $sql = "SELECT * FROM shifts WHERE shift_id = '$shiftId'";
    $result = mysqli_query($conn, $sql);

    // Check if query execution was successful and retrieve shift details
    if ($result && mysqli_num_rows($result) > 0) {
        $shift = mysqli_fetch_assoc($result);
    } else {
        echo "Error: Shift not found";
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!-- Edit Shift Form -->
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
                            <h1 class="m-0">Edit Shift</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="shift.php">Shifts</a></li>
                                <li class="breadcrumb-item active">Edit Shift</li>
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
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Shift Details</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <input type="hidden" name="shift_id" value="<?= $shift['shift_id'] ?>">
                                        <div class="form-group">
                                            <label for="name">Shift Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= $shift['name'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="start_time">Start Time</label>
                                            <input type="time" class="form-control" id="start_time" name="start_time" value="<?= $shift['start_time'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="end_time">End Time</label>
                                            <input type="time" class="form-control" id="end_time" name="end_time" value="<?= $shift['end_time'] ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Shift</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Page Content -->

        <?php include_once("includes/footer.php"); ?>
    </div>
    <?php include_once("includes/bottom.php"); ?>
</body>

</html>
