<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Library Automation System</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="admin/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="stylemain.css">
</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Public Library Automation System</a>
            <!-- Add navigation links if needed -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./admin/login.php">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./student/login.php">Student Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" data-toggle="modal" data-target="#registrationModal" href="javascript:void(0);">Registration</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Slider section -->
    <section id="slider">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slider-image1.jpg" class="slide-img" alt="Slider Image 1">
                </div>
                <div class="carousel-item">
                    <img src="images/slider-image2.jpg" class="slide-img" alt="Slider Image 2">
                </div>
                <div class="carousel-item">
                    <img src="images/slider-image3.jpg" class="slide-img" alt="Slider Image 3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>


    <section id="about" class="container my-4">
        <h2>About Us</h2>
        <p>Welcome to our Public Library Automation System, a platform designed to streamline library operations and enhance the overall user experience.</p>

        <h3>Our Mission</h3>
        <p>Our mission is to provide efficient management and access to library resources, promote a love for reading, and foster a learning environment for our users.</p>

        <h3>Key Features</h3>
        <ul>
            <li>Easy and intuitive book search and checkout process</li>
            <li>Online catalog with detailed information about available books</li>
            <li>Automated reminders for overdue books and upcoming due dates</li>
            <li>Ability to reserve and renew books online</li>
            <li>Personalized user accounts for tracking reading history and preferences</li>
            <li>Access to digital resources such as e-books and audiobooks</li>
            <li>Collaboration with other libraries for interlibrary loan services</li>
        </ul>

        <h3>Contact Us</h3>
        <p>If you have any questions or need assistance, feel free to contact our friendly staff at <a href="mailto:library@example.com">library@example.com</a> or call us at <a href="tel:+123456789">+123456789</a>.</p>
    </section>

    <footer id="footer" class="container-fluid bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Contact Us</h3>
                    <p>If you have any questions or need assistance, feel free to contact our friendly staff:</p>
                    <ul>
                        <li><i class="fa fa-envelope"></i> Email: <a href="mailto:library@example.com">library@example.com</a></li>
                        <li><i class="fa fa-phone-alt"></i> Phone: <a href="tel:+123456789">+123456789</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Our Links</h3>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./admin/login.php">Admin Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./student/login.php">Student Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" data-toggle="modal" data-target="#registrationModal" href="javascript:void(0);">Registration</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>Location</h3>
                    <p>123 Library Street, City, Country</p>
                </div>
            </div>
        </div>
    </footer>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; 2023 Public Library Automation System. All Rights Reserved.</p>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModal-title" aria-hidden="true">
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

    <!-- Add Bootstrap JS scripts here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

