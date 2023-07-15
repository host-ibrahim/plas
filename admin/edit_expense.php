<?php
include_once("../constant.php");
include_once("../connection.php");

// Check if expense ID is provided
if (!isset($_GET['id'])) {
    header("Location: expense.php");
    exit();
}

// Get expense ID from the query string
$expenseId = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    // Update expense data in the database
    $sql = "UPDATE expenses SET description = '$description', amount = '$amount', date = '$date' WHERE expense_id = '$expenseId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: expense.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve expense data from the database
$sql = "SELECT * FROM expenses WHERE expense_id = '$expenseId'";
$result = mysqli_query($conn, $sql);

// Check if query execution was successful
if ($result && mysqli_num_rows($result) > 0) {
    $expense = mysqli_fetch_assoc($result);
} else {
    echo "Expense not found.";
    exit();
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
                            <h1 class="m-0">Edit Expense</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="expense.php">All Expenses</a></li>
                                <li class="breadcrumb-item active">Edit Expense</li>
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
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" name="description" value="<?= $expense['description'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount" value="<?= $expense['amount'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" id="date" name="date" value="<?= $expense['date'] ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Expense</button>
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
