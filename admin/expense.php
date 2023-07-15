<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    // Insert expense data into the database
    $sql = "INSERT INTO expenses (description, amount, date) VALUES ('$description', '$amount', '$date')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: expense.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve expense data from the database
$sql = "SELECT * FROM expenses";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result) {
    $expenses = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                            <h1 class="m-0">All Expenses</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">All Expenses</li>
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
                                    <h4>List of Expenses</h4>
                                    <div class="card-tools ml-auto">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-expense">
                                            <span class="fas fa-plus"></span>&nbsp;&nbsp;Add New
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($expenses as $i => $expense) : ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $expense['description'] ?></td>
                                                    <td><?= $expense['amount'] ?></td>
                                                    <td><?= $expense['date'] ?></td>
                                                    <td class="text-center">
                                                        <a href="edit_expense.php?id=<?= $expense['expense_id'] ?>"><span class="fas fa-edit text-primary"></span></a>
                                                        <a href="delete_expense.php?id=<?= $expense['expense_id'] ?>" class="ml-3" onclick="return confirm('Are you sure to delete this expense?')">
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


        <!-- Add Expense Modal -->
        <div class="modal fade" id="modal-expense" tabindex="-1" role="dialog" aria-labelledby="modal-expense-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-expense-title">Add New Expense</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount">
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Expense</button>
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
