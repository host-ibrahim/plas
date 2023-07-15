<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publication_date = $_POST['publication_date'];
    $available_quantity = $_POST['available_quantity'];

    // Insert book data into the database
    $sql = "INSERT INTO books (title, author, publication_date, available_quantity) VALUES ('$title', '$author', '$publication_date', '$available_quantity')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: books.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve book data from the database
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                            <h1 class="m-0">All Books</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">All Books</li>
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
                                    <h4>List of Books</h4>
                                    <div class="card-tools ml-auto">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-book">
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
                                                <th>Author</th>
                                                <th>Publication Date</th>
                                                <th>Available Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($books as $i => $book) : ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $book['title'] ?></td>
                                                    <td><?= $book['author'] ?></td>
                                                    <td><?= $book['publication_date'] ?></td>
                                                    <td><?= $book['available_quantity'] ?></td>
                                                    <td class="text-center">
                                                        <a href="edit_book.php?id=<?= $book['book_id'] ?>"><span class="fas fa-edit text-primary"></span></a>
                                                        <a href="delete_book.php?id=<?= $book['book_id'] ?>" class="ml-3" onclick="return confirm('Are you sure to delete this book?')">
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


        <!-- Add Book Modal -->
        <div class="modal fade" id="modal-book" tabindex="-1" role="dialog" aria-labelledby="modal-book-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-book-title">Add New Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" id="author" name="author">
                            </div>
                            <div class="form-group">
                                <label for="publication_date">Publication Date</label>
                                <input type="date" class="form-control" id="publication_date" name="publication_date">
                            </div>
                            <div class="form-group">
                                <label for="available_quantity">Available Quantity</label>
                                <input type="number" class="form-control" id="available_quantity" name="available_quantity">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Book</button>
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