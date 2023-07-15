<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

$adid = $_GET['ad_id'];

// Retrieve admission data from the database
$sql = "SELECT * FROM admission WHERE admission_id = '$adid'";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $admission = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Retrieve admission data from the database

$stid = $admission['student_id'];
$sql = "SELECT * FROM students WHERE student_id = '$stid'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $student = mysqli_fetch_assoc($result);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>

<body>
    <style>
        @media print {
            .p-none {
                display: none;
            }

            .card {
                transform: scale(1.8);
                transform-origin: top center;
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card border border-dark border-width-3">
                    <div class="card-header text-center">
                        <h4>Automated Library System Admission Bill</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Admission ID :</th>
                                <td><?php echo $admission['admission_id']; ?></td>
                            </tr>
                            <tr>
                                <th>Student ID :</th>
                                <td><?php echo $admission['student_id']; ?></td>
                            </tr>
                            <tr>
                                <th>Student Name :</th>
                                <td><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Admission Date :</th>
                                <td><?php echo date('d-m-Y', strtotime($admission['created_at'])); ?></td>
                            </tr>
                            <tr>
                                <th>Valid Up To :</th>
                                <td><?php echo date('d-m-Y', strtotime($admission['valid_date'])); ?></td>
                            </tr>
                            <tr>
                                <th>Status :</th>
                                <td><?php echo $admission['status']; ?></td>
                            </tr>
                            <tr>
                                <th>Fees :</th>
                                <td><?php echo $admission['fees']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer p-none">
                        <button class="btn btn-primary p-none" onclick="window.print()">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>