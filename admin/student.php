<?php
include_once("includes/authadmin.php");
include_once("../constant.php");
include_once("../connection.php");

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once("includes/head.php"); ?>

<body class="sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">

        <?php include_once("includes/header.php"); ?>
        <?php include_once("includes/sidebar.php"); ?>
        <!-- There is My Page Code -->

        <?php
        // Retrieve student data from the database
        $sql = "SELECT * FROM Students";
        $result = mysqli_query($conn, $sql);

        // Check if query execution was successful
        if ($result) {
            $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">All Students</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active">All Students</li>
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
                                    <h4>List of Students</h4>
                                    <div class="card-tools ml-auto">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-student">
                                            <span class="fas fa-plus"></span>&nbsp;&nbsp;Add New
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-striped table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($students as $i => $student) : ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $student['first_name'] ?></td>
                                                    <td><?= $student['last_name'] ?></td>
                                                    <td><?= $student['email'] ?></td>
                                                    <td><?= $student['phone'] ?></td>
                                                    <td><?= $student['address'] ?></td>
                                                    <td class="text-center">
                                                        <a href="edit_student.php?id=<?= $student['student_id'] ?>"><span class="fas fa-edit text-primary"></span></a>
                                                        <a href="delete_student.php?id=<?= $student['student_id'] ?>" class="ml-3" onclick="return confirm('Are you sure to delete this student?')">
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


        <!-- Add Student Modal -->
        <div class="modal fade" id="modal-student" tabindex="-1" role="dialog" aria-labelledby="modal-student-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="stdreg.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registrationModal-title">New Registration</h5>
                            <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" autocomplete="off" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control-file" id="photo" name="photo" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Student</button>
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