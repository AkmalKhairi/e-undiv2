<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
       <p>Welcome</p>
        <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"></li>
      <li class=""><a href="home.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="voters.php"><span class="glyphicon glyphicon-user"></span> <span>Admin</span></a></li>
      <li class=""><a href="election.php"><span class="fa fa-check"></span> <span> Election</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>