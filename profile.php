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
			
			Buat akun gratis!, <a href="registration.php">Disini~</a>

		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

<? } else { $sess = $_SESSION['account']; $h = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM members WHERE username = '$sess[username]'")); 
$per_page=7;
if (isset($_GET["halaman"])) {
	$page = $_GET["halaman"];
} else {
	$page = 1;
}
?>
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
				<div class="col-md-3">
					<div class="box box-primary">
						<div class="box-body box-profile">
						  <img class="profile-user-img img-responsive img-circle" src="<?=$site->url;?>cdn/dist/img/user2-160x160.jpg" alt="User profile picture">

						  <h3 class="profile-username text-center"><?=$h['nama'];?></h3>

						  <p class="text-muted text-center"><?=$h['level'];?></p>

						  <ul class="list-group list-group-unbordered">
							<li class="list-group-item">
							  <b>Saldo</b> <a class="pull-right"><?=$h['saldo'];?></a>
							</li>
							<li class="list-group-item">
							  <b>Total Pesanan</b> <a class="pull-right"><?=mysqli_num_rows(mysqli_query($db, "SELECT * FROM history WHERE uplink = '$sess[username]'"));?></a>
							</li>
						  </ul>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<div class="col-md-9">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
						</ul>
						<div class="tab-content">
						  <div class="active tab-pane" id="settings">
							<form class="form-horizontal" method="post" action="">
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Nama</label>

								<div class="col-sm-10">
								  <input type="text" class="form-control" id="inputName" value="<?=$h['nama'];?>" disabled>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Username</label>

								<div class="col-sm-10">
								  <input type="text" class="form-control" id="inputUsername" value="<?=$h['username'];?>" disabled>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Akun dibuat</label>

								<div class="col-sm-10">
								  <input type="text" class="form-control" id="inputRegDate" value="<?=$h['regdate'];?>" disabled>
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">API Key</label>

								<div class="col-sm-10">
								  <input type="text" class="form-control" id="inputRegDate" value="<?=$h['api'];?>" disabled>
								</div>
							  </div>
							  <hr>
							  <?php
							  if(isset($_POST['password']) || isset($_POST['npassword']) || isset($_POST['rnpassword'])){
								$password = mysqli_real_escape_string($db, trim($_POST['password']));
								$npassword = mysqli_real_escape_string($db, trim($_POST['npassword']));
								$rnpassword = mysqli_real_escape_string($db, trim($_POST['rnpassword']));
								if($password == '' && $npassword == '' && $rnpassword == ''){
									echo '<div class="alert alert-warning">No Data</div>';
								} else {
									if(strlen($npassword)<4){
										echo '<div class="alert alert-warning">Password harus lebih dari 4 huruf!</div>';
									} else {
										if($npassword<>$rnpassword){
											echo '<div class="alert alert-warning">Konfirmasi password tidak sama!</div>';
										} else {
											$x = mysqli_query($db, "SELECT * FROM members WHERE username = '$sess[username]'");
											$s = mysqli_fetch_assoc($x);
											if($password<>$s['password']){
												echo '<div class="alert alert-warning">Data password tidak valid!</div>';
											} else {
												if($npassword==$s['password']){
													echo '<div class="alert alert-warning">Password baru tidak boleh sama dengan yang lama!</div>';
												} else {
													$change = mysqli_query($db, "UPDATE members SET password = '$npassword' WHERE username = '$sess[username]'");
													if($change){
														session_destroy();
														echo '<meta http-equiv="refresh" content="2;url=index.php"><div class="alert alert-success"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Kata Sandi berhasil diubah!</div>';
													}
												}
											}
										}
									}
								}
							  }
							  ?>
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Password</label>

								<div class="col-sm-10">
								  <input type="password" class="form-control" id="password" name="password">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">New Password</label>

								<div class="col-sm-10">
								  <input type="password" class="form-control" id="npassword" name="npassword">
								</div>
							  </div>
							  <div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Retype New Password</label>

								<div class="col-sm-10">
								  <input type="password" class="form-control" id="rnpassword" name="rnpassword">
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="submit" class="btn btn-danger">Submit</button>
								</div>
							  </div>
							</form>
						  </div>
						</div>
					</div>
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