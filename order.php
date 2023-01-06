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
				<div class="col-lg-12">
					<?php require_once('require/information.phtml'); ?>
				</div>
				<div class="col-lg-6">
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">Order Baru</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<form action="act.php?order" method="post" id="order">
								<div id="result"></div>
								<div class="form-group">
									<label>Kategori:</label>
									<select name="category" id="category" class="form-control">
										<option>Pilih kategori</option>
										<? $c_q = mysqli_query($db, "SELECT * FROM category WHERE enable = 'yes'");
										if(mysqli_num_rows($c_q)<1){
											echo '<option>No Data</option>';
										} else {
											while($row = mysqli_fetch_assoc($c_q)){
												echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Layanan:</label>
									<select name="service" id="service" class="form-control"><option>Pilih terlebih dahulu category-nya</option></select>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Price/k:</label>
											<input type="text" name="pricek" id="pricek" class="form-control" disabled/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Min:</label>
											<input type="text" name="min" id="min" class="form-control" disabled/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Max:</label>
											<input type="text" name="max" id="max" class="form-control" disabled/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Data:</label>
									<input type="text" name="data" id="data" class="form-control"/>
								</div>
								<div class="form-group">
									<label>Jumlah:</label>
									<input type="number" name="jumlah" id="jumlah" class="form-control"/>
								</div>
								<div class="text-right">
									<button type="submit" id="btn-login" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">Peraturan</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<center><p><i><span style="color: red;">FYI</span> : Pastikan akun tersedia dan tidak private</i></p></center>
							<p>Berikut beberapa contoh data yang disesuaikan dengan produk :</p>
							<ul>								
								<li>Instagram Likes/Views Video : <b>https://www.instagram.com/p/BDnpC6dAB9U/</b></li>
								<li>Instagram Followers : <b>https://www.instagram.com/usernamekamu | atau usernamee :  usernamekamu ( samakan dengan perintah )</b></li>
								<li>Facebook Likes : <b>https://www.facebook.com/usernamekamu/posts/1753519224884662</b></li>
							</ul>
							<p>Pilih type layanan sesuai yang akan dibeli. sebelum submit pastikan akun tidak diprivate / link benar. <br>kesalahan submit akan mengakibatkan kerugian dan tidak bisa dicancel.</p>
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