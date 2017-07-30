<?php
  session_start();
  include('service/connection.php');
  $userid  $_SESSION['userid'];
  $rows = mysqli_query($conn,"SELECT * FROM ceque.learning_program where teacher_id='$userid';");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SME Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assests/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assests/adminlte/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

 
  <!-- Page Header & SideBar -->
  <div id="header"></div>
  <!-- /.Page Header & SideBar -->

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assests/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
        <li><a><i class="fa fa-book"></i> <span>Reviewed Lesson Plans</span></a></li>
        <li><a><i class="fa fa-book"></i> <span>Reviewed Videos</span></a></li>
        <li><a><i class="fa fa-book"></i> <span>Review Lesson Plans</span></a></li>
        <li><a><i class="fa fa-book"></i> <span>Review Videos</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Your Dashboard
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">SME Dashboard</a></li>
        <li class="active">Home</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <!-- LIST STARTS HERE -->
                <thead>
                <tr>
                  <th>Program Name</th>
                  <th>Subject</th>
                  <th>Grade</th>
                  <th>Date Added</th>
                  <th>Language</th>
                  <th>Teacher</th>
                </tr>
                </thead>
                <?php if(mysqli_num_rows($rows) == 0){
                  echo '<th> No data to show </th><th></th><th></th><th></th><th></th>';
                }else {?>
                <tbody>
                <?php 
                  
                  while($row = mysqli_fetch_assoc($rows)){
                    $td = mysqli_fetch_assoc(mysqli_query($conn,'SELECT user_firstname,user_lastname FROM user WHERE user_id = '.$row['teacher_id'].';'));
                      $lp_id = $row['lp_id'];
                    // print_r($row);
                  ?>
                <tr onclick="window.location.href=sme-view-lp.php?lp_id=<?=$lp_id?>">
                  <td><?=$row['lp_name']?></td>
                  <td><?=$row['lp_subject']?></td>
                  <td><?=$row['lp_grade']?></td>
                  <td><?=$row['ts']?></td>
                  <td><?=$row['lp_language']?></td>
                  <td><?=$td['user_firstname'].' '.$td['user_lastname']?></td>
                </tr>
                <?php } }?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Page Footer -->
  <div id="footer"></div>
  <!-- /.Page Footer -->
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="assests/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assests/bootstrap/js/bootstrap.min.js"></script>

<!-- Load Header & Footer -->
<script src="js/headerfooter.js"></script>
<!-- SlimScroll -->
<script src="assests/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assests/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assests/adminlte/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assests/adminlte/js/demo.js"></script>

<script src="assests/datatables/jquery.dataTables.min.js"></script>
<script src="assests/datatables/dataTables.bootstrap.js"></script>
    
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
