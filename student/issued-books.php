<?php
include_once("includes/authstudent.php");
include_once("../constant.php");
include_once("../connection.php");
$stdid = $_SESSION['student123'];
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
                            <h1 class="m-0">Issued Books</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">Issued Books</li>
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
                                    <h4>List of Issued Books</h4>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Student Name</th>
                                                <th>Book Title</th>
                                                <th>Issue Date</th>
                                                <th>Return Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Retrieve issued books data from the database
                                            $sqlIssuedBooks = "SELECT b.issue_id, s.first_name, s.last_name, bk.title, b.issue_date, b.return_date
                                                FROM bookissues b
                                                JOIN students s ON b.student_id = s.student_id
                                                JOIN books bk ON b.book_id = bk.book_id WHERE s.student_id = '$stdid'";
                                            $resultIssuedBooks = mysqli_query($conn, $sqlIssuedBooks);

                                            // Check if query execution was successful
                                            if ($resultIssuedBooks) {
                                                $issuedBooks = mysqli_fetch_all($resultIssuedBooks, MYSQLI_ASSOC); ?>

                                                <!-- // Display the list of issued books -->
                                                <?php foreach ($issuedBooks as $i => $issuedBook) : ?>
                                                    <tr>
                                                        <td><?= $i + 1 ?></td>
                                                        <td><?= $issuedBook['first_name'] . ' ' . $issuedBook['last_name'] ?></td>
                                                        <td><?= $issuedBook['title'] ?></td>
                                                        <td><?= $issuedBook['issue_date'] ?></td>
                                                        <td><?= $issuedBook['return_date'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            <?php
                                                // Close the database connection
                                                mysqli_close($conn);
                                            } else {
                                                echo "Error: " . mysqli_error($conn);
                                            }
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