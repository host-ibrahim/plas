<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newStatus = $_POST['status'];
    $reqid = $_POST['admission_id'];

    // Update the status in the database
    // Update the status in the database
    $datenow = date('Y-m-d');
    $datevalid = date('Y-m-d', strtotime('+1 month', strtotime($datenow)));

    $updateSql = "UPDATE admission SET `created_at` = '$datenow', `valid_date` = '$datevalid', `status` = '$newStatus', bill_generated = 1 WHERE admission_id = $reqid";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($newStatus == "Approved") {
    }

    if ($updateResult) {
        header("Location: " . $_SERVER['PHP_SELF']);
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
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $student = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Retrieve admission data for the student from the database
$sql = "SELECT ad.*, sf.name FROM admission ad JOIN shifts sf ON ad.shift_id = sf.shift_id";
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
                                            <th>Bill</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($admission as $i => $adm) { ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $student['first_name'] . ' ' . $student['last_name'] ?></td>
                                                    <td><?= date('d-m-Y', strtotime($adm['created_at'])) ?></td>
                                                    <td><?= ($adm['valid_date'] !== null) ? date('d-m-Y', strtotime($adm['valid_date'])) : 'Pending' ?></td>
                                                    <td><?= $adm['name'] ?></td>
                                                    <td>
                                                        <form action="" class="d-flex" method="POST">
                                                            <input type="hidden" name="admission_id" value="<?= $adm['admission_id'] ?>">
                                                            <select class="form-control" name="status">
                                                                <option value="Pending" <?php if ($adm['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                                                <option value="Approved" <?php if ($adm['status'] == 'Approved') echo 'selected'; ?>>Approved</option>
                                                                <option value="Rejected" <?php if ($adm['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
                                                            </select>
                                                            <input type="submit" class="btn btn-warning btn-sm ml-3" value="Update">
                                                        </form>
                                                    </td>
                                                    <td><?= $adm['fees'] ?></td>
                                                    <td>
                                                        <?php if ($adm['bill_generated']) {
                                                            echo "<a href='bill.php?ad_id={$adm['admission_id']}' class='btn btn-sm btn-success'>View</a>";
                                                        } else {
                                                            echo '<button type="button" class="btn btn-sm btn-danger">Pending</button>';
                                                        } ?>
                                                    </td>
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


        <?php include_once("includes/footer.php"); ?>
    </div>
    <?php include_once("includes/bottom.php"); ?>
</body>

</html>