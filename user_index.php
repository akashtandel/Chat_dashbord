<?php
session_start();
error_reporting(0);
include("connect.php");
require_once "testing_1.php";

//global variable user_profile from login to display user details
$user_profile = $_SESSION['name'];
if($user_profile==true)
{
	
}
else
{
	echo "<script type='text/javascript'>";
	echo "window.location.href='login.php';";
	echo "</script>";
}
//query for user profile
$usersql=mysqli_query($con,"select * from table_user where user_name='$user_profile'");
$resuser=mysqli_fetch_assoc($usersql);
$senderid=$resuser['user_id'];
$username=$resuser['user_name'];
$useremail=$resuser['user_email'];
$imageme=$resuser['image'];

//get from url
$sid=$_GET['sid'];
$rid=$_GET['rid'];
//contact list query
$result=mysqli_query($con,"select * from table_user  where user_name != '$user_profile' ORDER BY user_name ASC");

//Rec query
$sqlf=mysqli_query($con,"select * from table_chat where S_id=$rid and R_id=$sid");
//time management
//$sqlt=mysqli_query($con,"select * from table_chat where S_id=$rid and R_id=$sid");

//send query
$sqlsen=mysqli_query($con,"select * from table_chat where S_id=$sid and R_id=$rid");	

//section for contact image and name global veriable
$sqlh=mysqli_query($con,"select * from table_user where user_id=$rid");
while($resh=mysqli_fetch_assoc($sqlh))
{
	$name=$resh['user_name'];
	$image=$resh['image'];
}	
					  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div >
  <!-- Navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">   
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $imageme;?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <p class="d-block" style="color:white;" ><?php echo $username; ?><a href="logout.php" class="d-block"><img src="./images/icons/icons.png" height="40" width="40"/></a></p>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<?php
				/* fetch associative array */
				while ($row = $result->fetch_assoc())
					{
					$receid=$row["user_id"];
					$imageu=$row["image"];
				?>
          <li class="nav-item has-treeview menu-open">
            <!--<a href="#" class="nav-link active">-->
            <a href='user_index.php?sid=<?php echo $senderid?>&&rid=<?php echo $receid ?>' class="nav-link">
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
				<img src="<?php echo $imageu;?>" class="img-circle elevation-2" alt="User Image">
				<?php
					printf ("%s\n", $row["user_name"]);
			   //echo $cname;
			   ?>
				</div>
				</div>
            </a> 
          </li>
		  <?php
				}
		  ?>
          <!--comment for chatch contact  from table-->
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">DAS chat</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
       <center>
          <section class="col-lg-auto connectedSortable">
			
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary col-lg-auto">
              <div class="card-header">
				<a href="<?php echo $image;?>">
				<div class="user-panel mt-10 pb-9 mb-3 d-flex">
				<div class="image-left">
				<img src="<?php echo $image;?>" class="img-circle elevation-2" alt="User Image">				
				<h3 class="card-title-"><?php echo $name;?></h3>
				</div>
				</a>
				<?php
				/* comment for future to display total messages
				$res1 = mysqli_query($con,"select max(C_id) from table_chat");
				$fid=0;
				while($r1=mysqli_fetch_row($res1))
				{
					$fid=$r1[0];
				}
				$fid;*/
				?>
                <div class="card-tools">
                  <!--<span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"><?php //echo $fid;?></span>-->
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
				</div>
              </div>
			 <!-- /.card-header 
            <div class="card-body">
            <div class="direct-chat-messages">-->
				<?php
				//	
				//reicever part
					$sqlf=mysqli_query($con,"select * from table_chat where (S_id=$sid and R_id=$rid) or (S_id=$rid and R_id=$sid)");
					while($resf=mysqli_fetch_assoc($sqlf))
					{
						//$cid=$resf['C_id'];
							$cid=$resf['C_id'];
							$rec_id = $resf['R_id'];
							$send_id = $resf['S_id'];
							$re=$resf['C_text'];
							//$remsg=substr(str_rot($re,$deshift), 0, 10);
							$remsg=str_rot($re,$deshift);
							$date=$resf['date'];
							$time=$resf['time'];
							$s2=$resf['status'];
							//echo $remsg."\n";

							if($s2=="yes"){
								?>
								<div class="direct-text float-center">
								  <?php echo $date;?>
								</div>
								<?php
								
								if($send_id==$sid){
								?>
								
									<div class="direct-chat-msg right">
									<div class="direct-chat-infos clearfix">
									  <span class="direct-chat-name float-right"><?php echo $username; ?></span>	
									</div>
									<a href="<?php echo $imageme;?>">
									<img class="direct-chat-img" src="<?php echo $imageme;?>" alt="message user image">
									</a>
									<div class="direct-chat-text float-right">
										<?php
											echo $remsg;
										?>
										&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="direct-chat-timestamp float-right"> <small><?php echo $time;?></small></span>
									</div>
								  </div>
								<?php
								}else if($rec_id=$rid){
								?>
									<?php// echo $remsg;?>
									<div class="direct-chat-msg">
									<div class="direct-chat-infos clearfix">
									  <span class="direct-chat-name float-left"><?php echo $name;?></span>
									</div>
									<a href="<?php echo $image;?>">
									<img class="direct-chat-img" src="<?php echo $image;?>" alt="message user image">
									</a>
									<div class="direct-chat-text float-left">
									  <?php echo $remsg;?>
								   &nbsp;&nbsp;&nbsp;&nbsp;
									<!-- to delete the message
									<span class="direct-chat-timestamp float-right">
									<a href="./"><input type="submit" class="btn btn-tool" name="delmsg"><i class="fas fa-times"></i></a>
									</span>-->
								  <span class="direct-chat-timestamp float-right"> <small><?php echo $time;?></small></span>
								 </div>
								</div>
								<?php
								}
								}
							
							
					}
				?>
						<!--sender send-->
						
			  </div>
                  <!-- /.direct-chat-msg -->
              <!-- /.card-body -->
              <div class="card-footer">
                <form  method="post">
                  <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                      <input type="submit" name="reply" class="btn btn-primary" value="Send">
                    </span>
                  </div>
                </form>
              <!-- /.card-footer-->
            <!--/.direct-chat -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	   <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
<!--to insert record/message in table-->
<?php
if(isset($_POST['reply']))
{
	$r=$_POST['message'];
	$reply=str_rot($r,$shift);
	$date = date('d/m/Y', time());
	$time = date('h:i:s a', time());
	$res1 = mysqli_query($con,"select max(C_id) from table_chat");
	$cid=0;
	while($r1=mysqli_fetch_row($res1))
	{
		$cid=$r1[0];
	}
	$cid++;
	$sqlmsg=mysqli_query($con,"insert into table_chat values('$cid','$sid','$rid','$reply','$time','$date','yes')");
	if($sqlmsg)
	{
		echo "<script type='text/javascript'>";
		echo "window.location.href='user_index.php?sid=$sid&&rid=$rid';";
		echo "</script>";
	}
}
?>
        
