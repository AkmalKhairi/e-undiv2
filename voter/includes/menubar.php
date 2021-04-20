<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo (!empty($voter['photo'])) ? '../images/'.$voter['photo'] : '../images/profile.jpg' ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Welcome</p>
                <p><?php echo $voter['firstname'].' '.$voter['lastname']; ?></p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"></li>
            <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class=""><a href="camera.php"><span class="fa fa-camera"></span> <span>Camera</span></a></li>
            <li class="header"></li>
            <li class=""><a href="#"><i class="fa fa-users"></i> <span>Test</span></a></li>
            <li class=""><a href="#"><i class="fa fa-tasks"></i> <span>Test</span></a></li>
            <li class=""><a href="#"><i class="fa fa-black-tie"></i> <span>Test</span></a></li>
            <!--       <li class="header"></li>
                  <li class=""><a href="ballot.php"><i class="fa fa-file-text"></i> <span>Ballot Position</span></a></li>
                  <li class=""><a href="#config" data-toggle="modal"><i class="fa fa-cog"></i> <span>Election Title</span></a></li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>