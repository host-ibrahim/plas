<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if magazine ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: magazines.php");
    exit();
}

$magazineId = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $publicationDate = $_POST['publication_date'];
    $availableQuantity = $_POST['available_quantity'];

    // Update magazine data in the database
    $sql = "UPDATE magazines SET title='$title', publisher='$publisher', publication_date='$publicationDate', available_quantity='$availableQuantity' WHERE magazine_id='$magazineId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: magazines.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve magazine data from the database
$sql = "SELECT * FROM magazines WHERE magazine_id='$magazineId'";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $magazine = mysqli_fetch_assoc($result);
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
                            <h1 class="m-0">Edit Magazine</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="magazine.php">All Magazines</a></li>
                                <li class="breadcrumb-item active">Edit Magazine</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Magazine</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="<?= $magazine['title'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="publisher">Publisher</label>
                                            <input type="text" class="form-control" id="publisher" name="publisher" value="<?= $magazine['publisher'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="publication_date">Publication Date</label>
                                            <input type="date" class="form-control" id="publication_date" name="publication_date" value="<?= $magazine['publication_date'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="available_quantity">Available Quantity</label>
                                            <input type="number" class="form-control" id="available_quantity" name="available_quantity" value="<?= $magazine['available_quantity'] ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Magazine</button>
                                    </form>
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
