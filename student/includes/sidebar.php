<!-- Main Sidebar Container -->
<?php
$baseurl = BASEURL . "student/";
?>
<aside class="main-sidebar sidebar-light-cyan elevation-4">
    <a href="<?= $baseurl ?>" class="brand-link bg-cyan">
        <span class="text-white ml-3 font-weight-bold">Student Panel</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= $baseurl ?>index.php" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <p class="ml-3">
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $baseurl ?>books.php" class="nav-link">
                        <i class="fas fa-book"></i>
                        <p class="ml-3">
                            All Books
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $baseurl ?>newspaper.php" class="nav-link">
                        <i class="fas fa-newspaper"></i>
                        <p class="ml-3">
                            All Newspaper
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $baseurl ?>magazines.php" class="nav-link">
                        <i class="fas fa-book-open"></i>
                        <p class="ml-3">
                            All Magazine
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $baseurl ?>issued-books.php" class="nav-link">
                        <i class="fas fa-list"></i>
                        <p class="ml-3">
                            Book Issued List
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $baseurl ?>issue_request.php" class="nav-link">
                        <i class="fas fa-exclamation-circle"></i>
                        <p class="ml-3">
                            Issued Request List
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $baseurl ?>shift.php" class="nav-link">
                        <i class="fas fa-clock"></i>
                        <p class="ml-3">
                            Shift
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $baseurl ?>admission.php" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p class="ml-3">
                            Admission
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= $baseurl ?>logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p class="ml-3">
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>