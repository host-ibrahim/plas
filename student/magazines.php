<?php
include_once("includes/authstudent.php");
include_once("../constant.php");
include_once("../connection.php");

// Retrieve magazine data from the database
$sql = "SELECT * FROM magazines";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $magazines = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                            <h1 class="m-0">All Magazines</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">All Magazines</li>
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
                                    <h4>List of Magazines</h4>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Title</th>
                                                <th>Publisher</th>
                                                <th>Publication Date</th>
                                                <th>Available Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($magazines as $i => $magazine) : ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $magazine['title'] ?></td>
                                                    <td><?= $magazine['publisher'] ?></td>
                                                    <td><?= $magazine['publication_date'] ?></td>
                                                    <td><?= $magazine['available_quantity'] ?></td>
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
