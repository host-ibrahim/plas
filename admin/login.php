<?php
session_start();
// Check if the user is already logged in, redirect to home page
if (isset($_SESSION['admin123'])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST['login'])) {
    include_once("../constant.php");
    include_once("../connection.php");
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin_login` WHERE `username` = '$username' && `password` = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['admin123'] = "Admin";
        $_SESSION['loggedadmin'] = true;

        // Redirect to home page
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="h1"><b>Admin</b> Login </span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Log in to start your session</p>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" name="username" id="username" autocomplete="off" class="form-control shadow-none" placeholder="Enter Username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="input-group">
                            <input type="password" name="password" id="password" autocomplete="off" class="form-control shadow-none" placeholder="Enter Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <button type="submit" name="login" class="btn btn-outline-success btn-block">LOGIN</button>
                        </div>
                        <div class="col-5">
                            <a href="../" class="btn btn-outline-warning btn-block">Back To Home</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/adminlte.min.js"></script>
</body>

</html>