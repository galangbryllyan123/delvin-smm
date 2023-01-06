<?php
session_start();
require_once('require/mainconfig.php');
require_once('require/header.phtml');
if(!isset($_SESSION['account'])){ ?>
	<body class="hold-transition login-page">
		<div class="login-box">
		  <div class="login-logo">
			<a href="<?=$site->url;?>"><?=$site->name;?></a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">

			<form action="act.php?login" method="post" id="login">
			<div id="result"></div>
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Username" id="username" name="username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" id="password" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			  <div class="text-right">
				<button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat">Sign In</button>
			  </div>
			</form>
			
			Silahkan buat akun gratis! klik <a href="registration.php">Disini DAFTAR GRATIS SEKARANG~</a>
		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

<? } else { $sess = $_SESSION['account']; $h = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM members WHERE username = '$sess[username]'")); ?>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">

		  <header class="main-header">
			<!-- Logo -->
			<a href="index2.html" class="logo">
			  <!-- mini logo for sidebar mini 50x50 pixels -->
			  <span class="logo-mini"><b>H</b>S</span>
			  <!-- logo for regular state and mobile devices -->
			  <span class="logo-lg"><?=$site->name;?></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
			  <!-- Sidebar toggle button-->
			  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			  </a>

			  <div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
				  <!-- Messages: style can be found in dropdown.less-->
				  <li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <img src="<?=$site->url;?>cdn/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
					  <span class="hidden-xs"><?=$h['nama'];?></span>
					</a>
					<ul class="dropdown-menu">
					  <!-- User image -->
					  <li class="user-header">
						<img src="<?=$site->url;?>cdn/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

						<p>
						  <?=$h['nama'];?> - <?=$h['level'];?>
						  <small><?=$h['level'];?> since <?=$h['regdate'];?></small>
						</p>
					  </li>
					  <!-- Menu Footer-->
					  <li class="user-footer">
						<div class="pull-left">
						  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
						</div>
						<div class="pull-right">
						  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
						</div>
					  </li>
					</ul>
				  </li>
				</ul>
			  </div>
			</nav>
			<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/57c446fc0e2ec4134ce32790/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
		  </header>
		  <!-- Left side column. contains the logo and sidebar -->
		  <aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			  <?php require_once('require/sidebar.phtml'); ?>
			</section>
			<!-- /.sidebar -->
		  </aside>

		  <!-- Content Wrapper. Contains page content -->
		  <div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			  <h1>
				Dashboard
				<small>Control panel</small>
			  </h1>
			  <ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Dashboard</li>
			  </ol>
			</section>

			<!-- Main content -->
			<section class="content">
			  <!-- Small boxes (Stat box) -->
			  <div class="row">
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-red">
					<div class="inner">
					  <h3><?=$h['saldo'];?></h3>

					  <p>Total Saldo</p>
					</div>
					<div class="icon">
					  <i class="fa fa-dollar"></i>
					</div>
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-purple">
					<div class="inner">
					  <h3><?=mysqli_num_rows(mysqli_query($db, "SELECT * FROM history WHERE uplink = '$sess[username]'"));?></h3>

					  <p>Total Pesanan</p>
					</div>
					<div class="icon">
					  <i class="fa fa-folder-o"></i>
					</div>
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-blue">
					<div class="inner">
					  <h3><?=mysqli_num_rows(mysqli_query($db, "SELECT * FROM history WHERE uplink = '$sess[username]' AND status = '2'"));?></h3>

					  <p>Total Pesanan Sukses</p>
					</div>
					<div class="icon">
					  <i class="fa fa-shopping-cart"></i>
					</div>
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-green">
					<div class="inner">
					  <h3>0</h3>

					  <p>Total Jumlah Deposit</p>
					</div>
					<div class="icon">
					  <i class="fa fa-credit-card"></i>
					</div>
				  </div>
				</div>
				<!-- ./col -->
			  </div>
			  <!-- /.row -->
			  <!-- Main row -->
			  <div class="row">
				<div class="col-md-12">
					<?php require_once('require/information.phtml'); ?>
					<div class="box box-success box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">7 INFORMASI TERAKHIR</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <table class="table table-bordered">
							<tr>
								<th>Tanggal</th>
								<th>Bagian</th>
								<th>Info</th>
							</tr>
							<tr>
								<?php
								$q_it = mysqli_query($db, "SELECT * FROM informasi ORDER BY id DESC LIMIT 7");
								if(mysqli_num_rows($q_it)<1){
									echo '<tr>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									</tr>';
								} else {
									while($rrx = mysqli_fetch_assoc($q_it)){
										echo '<tr>
										<td>'.$rrx['date'].'</td>
										<td>'.$rrx['bagian'].'</td>
										<td>'.$rrx['informasi'].'</td>
										</tr>';
									}
								}
								?>
							</tr>
						  </table>
						</div>
						<!-- /.box-body -->
					</div>
					<div class="box box-warning box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">7 PESANAN TERAKHIR</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <table class="table table-bordered">
							<tr>
								<th>Order ID</th>
								<th>Link</th>
								<th>Start</th>
								<th>Remain</th>
								<th>Order</th>
								<th>Status</th>
								<th>Harga</th>
								<th>Tanggal</th>
							</tr>
							<tr>
								<?php
								$q_pt = mysqli_query($db, "SELECT * FROM history WHERE uplink = '$sess[username]' ORDER BY order_id DESC LIMIT 7");
								if(mysqli_num_rows($q_pt)<1){
									echo '<tr>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									</tr>';
								} else {
									while($raw = mysqli_fetch_assoc($q_pt)){
										echo '<tr>
										<td>'.$raw['order_id'].'</td>
										<td>'.$raw['data'].'</td>
										<td>'.$raw['start'].'</td>
										<td>'.$raw['remain'].'</td>
										<td>'.$raw['service_name'].'</td>';
										if($raw['status'] == "1"){
											$setatus = '<span class="badge badge-warning">Pending</span>';
										} else if($raw['status'] == "2"){
											$setatus = '<span class="badge badge-success">Completed</span>';
										} else if($raw['status'] == "3"){
											$setatus = '<span class="badge badge-info">Partial</span>';
										} else if($raw['status'] == "4"){
											$setatus = '<span class="badge badge-info">In Progress</span>';
										} else if($raw['status'] == "5"){
											$setatus = '<span class="badge badge-info">Canceled</span>';
										} else if($raw['status'] == "6"){
											$setatus = '<span class="badge badge-info">Proccessing</span>';
										}
										echo '<td>'.$setatus.'</td>
										<td>'.$raw['price'].'</td>
										<td>'.$raw['date'].'</td>';
									}
								}
								?>
							</tr>
						  </table>
						</div>
						<!-- /.box-body -->
					</div>
					<div class="box box-info box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">7 PEMBAYARAN TERAKHIR</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
						  <table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th>Tanggal</th>
								<th>VIA</th>
								<th>Jumlah</th>
								<th>Detail Pengirim</th>
								<th>Bukti Pembayaran</th>
								<th>Status</th>
								<th>Approved By</th>
							</tr>
							<tr>
								<?php
								$q_ptr = mysqli_query($db, "SELECT * FROM deposit WHERE uplink = '$sess[username]' ORDER BY id DESC LIMIT 7");
								if(mysqli_num_rows($q_ptr)<1){
									echo '<tr>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									<td>No Data</td>
									</tr>';
								} else {
									while($row = mysqli_fetch_assoc($q_ptr)){
										echo '<tr>
										<td>'.$row['id'].'</td>
										<td>'.$row['date'].'</td>
										<td>'.$row['via'].'</td>
										<td>'.$row['jumlah'].'</td>
										<td>'.$row['via_detail'].'</td>
										<td>'.$row['proof'].'</td>
										<td>'.$row['status'].'</td>
										<td>'.$row['approved_by'].'</td>
										</tr>';
									}
								}
								?>
							</tr>
						  </table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
			  </div>
			  <!-- /.row (main row) -->

			</section>
			<!-- /.content -->
		  </div>
		  <!-- /.content-wrapper -->
		  <footer class="main-footer">
			<div class="pull-right hidden-xs">
			  <b>AdminLTE</b> 2.3.4
			</div>
			<strong>Copyright &copy; 2016 <a href="<?=$site->url;?>"><?=$site->name;?></a></strong> All rights
			reserved.
		  </footer>
		</div>
		<!-- ./wrapper -->
<? } require_once('require/footer.phtml'); ?>