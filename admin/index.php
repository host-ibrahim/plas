<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

// Retrieve data for the cards
$sqlTotalBooks = "SELECT COUNT(*) AS total_books FROM books";
$resultTotalBooks = mysqli_query($conn, $sqlTotalBooks);
$totalBooks = mysqli_fetch_assoc($resultTotalBooks)['total_books'];

$sqlTotalEmployees = "SELECT COUNT(*) AS total_employees FROM employees";
$resultTotalEmployees = mysqli_query($conn, $sqlTotalEmployees);
$totalEmployees = mysqli_fetch_assoc($resultTotalEmployees)['total_employees'];

$sqlTotalExpenses = "SELECT SUM(amount) AS total_expenses FROM expenses";
$resultTotalExpenses = mysqli_query($conn, $sqlTotalExpenses);
$totalExpenses = mysqli_fetch_assoc($resultTotalExpenses)['total_expenses'];

$sqlTotalStudents = "SELECT COUNT(*) AS total_students FROM students";
$resultTotalStudents = mysqli_query($conn, $sqlTotalStudents);
$totalStudents = mysqli_fetch_assoc($resultTotalStudents)['total_students'];

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

        <!-- Page Content -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
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
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Total Books</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center"><?= $totalBooks ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Total Employees</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center"><?= $totalEmployees ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Total Expenses</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center"><?php
                                                            if ($totalExpenses == null) {
                                                                echo "0";
                                                            } else {
                                                                echo $totalExpenses;
                                                            } ?></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Total Student</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center"><?= $totalStudents ?></h2>
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