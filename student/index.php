<?php
include_once("includes/authstudent.php");
include_once("../constant.php");
include_once("../connection.php");

$stdid = $_SESSION['student123'];
// Retrieve data for the cards
$sqlTotalBooks = "SELECT COUNT(*) AS total_books FROM books";
$resultTotalBooks = mysqli_query($conn, $sqlTotalBooks);
$totalBooks = mysqli_fetch_assoc($resultTotalBooks)['total_books'];

$sqlTotalNews = "SELECT COUNT(*) AS total_newspapers FROM newspapers";
$resultTotalNews = mysqli_query($conn, $sqlTotalNews);
$totalNews = mysqli_fetch_assoc($resultTotalNews)['total_newspapers'];

$sqlTotalMagazine = "SELECT COUNT(*) AS total_magazines FROM magazines";
$resultTotalMagazine = mysqli_query($conn, $sqlTotalMagazine);
$totalMagazine = mysqli_fetch_assoc($resultTotalMagazine)['total_magazines'];

$sqlstudent = "SELECT imageurl FROM students WHERE student_id = '$stdid'";
$resultstudent = mysqli_query($conn, $sqlstudent);
$student= mysqli_fetch_assoc($resultstudent)['imageurl'];

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
                                    <h3 class="card-title">Total Newspaper</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center"><?= $totalNews ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Total Magazines</h3>
                                </div>
                                <div class="card-body">
                                    <h2 class="text-center"><?= $totalMagazine ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <img src="../images/student/<?php echo $student ?>" height="250" width="200" alt="">
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
