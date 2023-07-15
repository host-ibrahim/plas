<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $publicationDate = $_POST['publication_date'];
    $availableQuantity = $_POST['available_quantity'];

    // Insert magazine data into the database
    $sql = "INSERT INTO magazines (title, publisher, publication_date, available_quantity) VALUES ('$title', '$publisher', '$publicationDate', '$availableQuantity')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: magazines.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

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
                                    <div class="card-tools ml-auto">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-magazine">
                                            <span class="fas fa-plus"></span>&nbsp;&nbsp;Add New
                                        </button>
                                    </div>
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
                                                <th>Action</th>
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
                                                    <td class="text-center">
                                                        <a href="edit_magazine.php?id=<?= $magazine['magazine_id'] ?>"><span class="fas fa-edit text-primary"></span></a>
                                                        <a href="delete_magazine.php?id=<?= $magazine['magazine_id'] ?>" class="ml-3" onclick="return confirm('Are you sure to delete this magazine?')">
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

        <!-- Add Magazine Modal -->
        <div class="modal fade" id="modal-magazine" tabindex="-1" role="dialog" aria-labelledby="modal-magazine-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-magazine-title">Add New Magazine</h5>
                            <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="publisher">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher">
                            </div>
                            <div class="form-group">
                                <label for="publication_date">Publication Date</label>
                                <input type="date" class="form-control" id="publication_date" name="publication_date">
                            </div>
                            <div class="form-group">
                                <label for="available_quantity">Available Quantity</label>
                                <input type="number" class="form-control" id="available_quantity" name="available_quantity">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Magazine</button>
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
