<?php
include_once("includes/authstudent.php");
include_once("../constant.php");
include_once("../connection.php");

$stdid = $_SESSION['student123'];


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $student_id = $_POST['student_id'];
    $shift_id = $_POST['shift_id'];
    $fees = $_POST['fees'];

    // Insert admission data into the database
    $sql = "INSERT INTO admission (student_id, status, fees, bill_generated, shift_id, created_at, updated_at)
            VALUES ('$student_id', 'Pending', '$fees', 0, '$shift_id', NOW(), NOW())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: admission.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve student data from the database
$sql = "SELECT * FROM shifts";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $shifts = mysqli_fetch_all($result, MYSQLI_ASSOC);
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

// Retrieve admission data for the student from the database
$sql = "SELECT ad.*, sf.name FROM admission ad JOIN shifts sf ON ad.shift_id = sf.shift_id WHERE ad.student_id = '$stdid'";
$result = mysqli_query($conn, $sql);


// Check if query execution was successful
if ($result) {
    $admission = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                            <h1 class="m-0">Admission Details</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Admission Details</li>
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
                                    <h4>Admission Details</h4>
                                    <div class="card-tools ml-auto">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-admission">
                                            <span class="fas fa-plus"></span>&nbsp;&nbsp;Add Admission
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <th>S. No</th>
                                            <th>Student Name</th>
                                            <th>Admission Date</th>
                                            <th>Valid Up To</th>
                                            <th>Shift</th>
                                            <th>Status</th>
                                            <th>Fees</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($admission as $i => $adm) { ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $student['first_name'] . ' ' . $student['last_name'] ?></td>
                                                    <td><?= date('d-m-Y', strtotime($adm['created_at'])) ?></td>
                                                    <td><?= ($adm['valid_date'] !== null) ? date('d-m-Y', strtotime($adm['valid_date'])) : 'Pending' ?></td>
                                                    <td><?= $adm['name'] ?></td>
                                                    <td><?= $adm['status'] ?></td>
                                                    <td><?= $adm['fees'] ?></td>
                                                </tr>
                                            <?php }
                                            ?>
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
        <div class="modal fade" id="modal-admission" tabindex="-1" role="dialog" aria-labelledby="modal-admission-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-admission-title">Add Admission</h5>
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
                                <label for="shift_id">Shift</label>
                                <select class="form-control" id="shift_id" name="shift_id" required>
                                    <option value="">Select Shift</option>
                                    <?php foreach ($shifts as $shift) : ?>
                                        <option value="<?= $shift['shift_id'] ?>"><?= $shift['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fees">Fees</label>
                                <input type="number" class="form-control" id="fees" name="fees" value="500" readonly />
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
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