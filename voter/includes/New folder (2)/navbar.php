<header class="main-header">
    <nav class="navbar navbar-static-top">
    <!-- Logo -->
    <a href="home.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>E</b>U</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="https://img.icons8.com/small/30/000000/elections.png"> <b> E-Undi </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->

        <!-- Sidebar toggle button-->

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo (!empty($voter['photo'])) ? '../images/'.$voter['photo'] : 'images/profile.jpg' ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $voter['firstname'].' '.$voter['lastname']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#profile" data-toggle="modal" class="btn btn-success btn-flat" id="admin_profile">Update</a>
                            </div>
                            <div class="pull-right">
                                <a href="logout.php" class="btn btn-danger btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>