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
if($h['level'] == "admin"){
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
					<?php
					if(isset($_GET['delete'])){
						$id = trim($_GET['delete']);
						$check_edit_q = mysqli_query($db, "SELECT * FROM category WHERE id = '$id'");
						if(mysqli_num_rows($check_edit_q)<1){
							echo '<div class="alert alert-warning">CategoryID tidak ada!</div>';
						} else {
							$check_edit_f = mysqli_fetch_assoc($check_edit_q);
							$simpan = mysqli_query($db, "DELETE FROM category WHERE id = '$id'");
							if($simpan){
								echo '<div class="alert alert-success">Berhasil didelete!</div><script>window.location.href = "?";</script>';
							} else {
								echo '<div class="alert alert-warning">Gagal didelete!</div></div>';
							}
							
						}
					}
					if(isset($_GET['edit'])){
						$id = trim($_GET['edit']);
						$check_edit_q = mysqli_query($db, "SELECT * FROM category WHERE id = '$id'");
						if(mysqli_num_rows($check_edit_q)<1){
							echo '<div class="alert alert-warning">CategoryID tidak ada!</div>';
						} else {
							$check_edit_f = mysqli_fetch_assoc($check_edit_q); ?>
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
								  <h3 class="box-title">Meng-edit category <?=$id;?> </h3>
								  <div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								  </div>
								  <!-- /.box-tools -->
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form method="post" action="act.php?editcategory" id="edit">
										<div id="result"></div>
										<input type="hidden" id="id" name="id" value="<?=$check_edit_f['id'];?>"/>
										<div class="form-group">
											<label>Name:</label>
											<input type="text" id="category_name" name="category_name" class="form-control" value="<?=$check_edit_f['category_name'];?>"/>
										</div>
										<div class="form-group">
											<label>Enable:</label>
											<select name="enable" id="enable" class="form-control">
												<option value="yes">Yes</option>
												<option value="no">No</option>
											</select>
										</div>
										<div class="text-center">
											<button type="submit" id="btn-login" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
						<? }
					}
					?>
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">Add Category</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<form action="" method="post">
							<?php
							if(isset($_POST['category_name']) || isset($_POST['enable'])){
								$category_name = mysqli_real_escape_string($db, trim($_POST['category_name']));
								$enable = mysqli_real_escape_string($db, trim($_POST['enable']));
								if(!$category_name || !$enable){
									echo '<div class="alert alert-warning">No Data</div>';
								} else {
									$cek = mysqli_query($db, "SELECT * FROM category WHERE category_name = '$category_name'");
									if(mysqli_num_rows($cek)<1){
										$simpan = mysqli_query($db, "INSERT INTO category VALUES('', '$category_name', '$enable')");
										if($simpan){
											echo '<div class="alert alert-success">Berhasi ditambahkan!</div>';
										} else {
											echo '<div class="alert alert-warning">Gagal ditambahkan!</div>';
										}
									} else {
										echo '<div class="alert alert-warning">Maaf, category ini sudah ada</div>';
									}
								}
							}
							?>
								<div class="form-group">
									<label>Name:</label>
									<input type="text" name="category_name" id="category_name" class="form-control"/>
								</div>
								<div class="form-group">
									<label>Enable:</label>
									<select name="enable" id="enable" class="form-control">
										<option value="yes">Yes</option>
										<option value="no">No</option>
									</select>
								</div>
								<div class="text-center">
									<button type="submit" id="btn-login" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">Manage Category</h3>
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
								<th>Name</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
							<? $q_x = mysqli_query($db, "SELECT * FROM category");
							if(mysqli_num_rows($q_x)<1){
								echo '<tr>
								<td>No Data</td>
								<td>No Data</td>
								<td>No Data</td>
								<td>No Data</td>
							</tr>';
							} else {
								while ($data = mysqli_fetch_assoc($q_x)) {
									echo '<tr>';
									echo '<td>'.$data['id'].'</td>';
									echo '<td>'.$data['category_name'].'</td>';
									echo '<td>'.$data['enable'].'</td>';
									echo '<td><a href="?edit='.$data['id'].'">Edit</a> / <a href="?delete='.$data['id'].'">Hapus</a></td>';
									echo '</tr>';
								}
							} ?>
						  </table>
						   <center><?php
							$start_from = ($page-1) * $per_page;
							$total_records = mysqli_num_rows($q_x);
							$total_pages = ceil($total_records / $per_page);
							echo '<ul class="pagination">';
							echo "<li><a href='?halaman=1'>First</a></li>";
							for ($i=1; $i<=$total_pages; $i++) {
								echo " <li><span><a href='?halaman=".$i."'>".$i."</a></span></li> ";
							};
							echo "<li><a href='?halaman=$total_pages'>Last Page</a></center></li>";
							echo '</ul>';
						  ?></center>
						</div>
						<!-- /.box-body -->
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
<? } else { echo 'bkn admin'; } } require_once('require/footer.phtml'); ?>