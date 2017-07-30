<?php
session_start();
include('service/connection.php');

$lp_id = $_GET['lp_id'];

$sql = mysqli_query($conn,"SELECT * from learning_program where lp_id = $lp_id;");

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
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
        <div class="col-md-9">
          <!-- Box Comment -->
          <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                <span class="description">Shared publicly - 7:30 PM Today</span>
              </div>
              <!-- /.user-block -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <?php
                  if(mysqli_num_rows($sql) == 0) {
                      echo 'No Results to show';
                  }
                  else {
                      $row = mysqli_fetch_assoc($sql);
                      print_r($row);
                      ?>
                <dt>Name of the Plan</dt>
                <dd><?=$row['lp_name']?></dd>
                <dt>Subject</dt>
                <dd><?=$row['lp_subject']?></dd>
                <dt>Grade</dt>
                <dd><?=$row['lp_grade']?></dd>
                <dt>Language</dt>
                <dd><?=$row['lp_language']?>
                </dd>
                  <dt>Description</dt>
                  <dd><?=$row['lp_desc']?></dd>
                    }
              </dl>
            </div>
            <!-- /.box-body -->
        </div>


              <!-- Social sharing buttons -->
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button>
              <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
              <span class="pull-right text-muted">45 likes - 2 comments</span>
            </div>
            <!-- /.box-body -->
            <div class="box-footer box-comments">
              <div class="box-comment">
                <!-- User image -->

                <?php
                    $sql2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from feedback_lp where lp_id=".$lp_id.";")); 
                      <?php
                  if(mysqli_num_rows($sql2) == 0) {
                      echo 'No Results to show';
                  }
                  else {
                      $row2 = mysqli_fetch_assoc($sql2);
                      print_r($row2);
                      while($row2 = mysqli_fetch_assoc($sql2)) {
                          $sql3 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT user_firstname, user_lastname from user where user_id=".$row['sme_id'].";")); 
                          
                          if(mysqli_num_rows($sql3) == 0) {
                            echo 'No Results to show';
                            }
                          else {
                              $row3 = mysqli_fetch_assoc($sql3);
                              print_r($row3);
                      ?>
                ?>
                <div class="comment-text">
                      <span class="username">
                        <?=$row3['user_firstname']." ".$row3['user_lastname']; ?>
                        <span class="text-muted pull-right"><?=$row2['timestamp'] ?></span>
                      </span><!-- /.username -->
                  <?=row2['feedback']?>
                </div>
                  <?php } } } ?>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form action="#" method="post">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
