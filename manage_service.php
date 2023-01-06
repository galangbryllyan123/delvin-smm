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
if($h['level'] == 'admin') {
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
						$check_edit_q = mysqli_query($db, "SELECT * FROM service WHERE id = '$id'");
						if(mysqli_num_rows($check_edit_q)<1){
							echo '<div class="alert alert-warning">Service tidak ada!</div>';
						} else {
							$check_edit_f = mysqli_fetch_assoc($check_edit_q);
							$simpan = mysqli_query($db, "DELETE FROM service WHERE id = '$id'");
							if($simpan){
								echo '<div class="alert alert-success">Berhasil didelete!</div>';
							} else {
								echo '<div class="alert alert-warning">Gagal didelete!</div>';
							}
							
						}
					}
					if(isset($_GET['edit'])){
						$id = trim($_GET['edit']);
						$check_edit_q = mysqli_query($db, "SELECT * FROM service WHERE id = '$id'");
						if(mysqli_num_rows($check_edit_q)<1){
							echo '<div class="alert alert-warning">Service tidak ada!</div>';
						} else {
							$check_edit_f = mysqli_fetch_assoc($check_edit_q); ?>
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
								  <h3 class="box-title">Meng-edit service <?=$id;?> </h3>
								  <div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								  </div>
								  <!-- /.box-tools -->
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<form method="post" action="act.php?editservice" id="edit">
										<div id="result"></div>
										<div class="form-group">
											<label>API ID ( Provider API ID ):</label>
											<input type="hidden" name="id" id="id" class="form-control" value="<?=$check_edit_f['id'];?>"/>
											<input type="text" name="api_id" id="api_id" class="form-control" value="<?=$check_edit_f['api_id'];?>"/>
										</div>
										<div class="form-group">
											<label>API Server ID ( Provider Server API ID ) :</label>
											<select name="api_s_id" id="api_s_id" class="form-control">
												<?php
												$qcx = mysqli_query($db, "SELECT * FROM api_setting");
												if(mysqli_num_rows($qcx)<1){
													echo '<option>Tidak ada</option>';
												} else {
													while($fqcx = mysqli_fetch_assoc($qcx)){
														if($fqcx['id'] == $check_edit_f['api_s_id']){
															echo '<option value="'.$fqcx['id'].'" selected="selected">'.$fqcx['name'].'</option>';
														} else {
															echo '<option value="'.$fqcx['id'].'">'.$fqcx['name'].'</option>';
														}
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Service Name:</label>
											<input type="text" name="service_name" id="service_name" class="form-control" value="<?=$check_edit_f['service_name'];?>"/>
										</div>
										<div class="form-group">
											<label>Service Min:</label>
											<input type="number" name="service_min" id="service_min" class="form-control" value="<?=$check_edit_f['service_min'];?>"/>
										</div>
										<div class="form-group">
											<label>Service Max:</label>
											<input type="number" name="service_max" id="service_max" class="form-control" value="<?=$check_edit_f['service_max'];?>"/>
										</div>
										<div class="form-group">
											<label>Service Price/k:</label>
											<input type="number" name="service_price" id="service_price" class="form-control" value="<?=$check_edit_f['service_price'];?>"/>
										</div>
										<div class="form-group">
											<label>Closed:</label>
											<select name="closed" id="closed" class="form-control">
												<option value="no">No</option>
												<option value="yes">Yes</option>
											</select>
										</div>
										<div class="form-group">
											<label>Service Category:</label>
											<select name="service_category" id="service_category" class="form-control">
												<?php
												$qc = mysqli_query($db, "SELECT * FROM category WHERE enable = 'yes'");
												if(mysqli_num_rows($qc)<1){
													echo '<option>Tidak ada</option>';
												} else {
													while($fqc = mysqli_fetch_assoc($qc)){
														if($fqc['id'] == $check_edit_f['service_category']){
															echo '<option value="'.$fqc['id'].'" selected="selected">'.$fqc['category_name'].'</option>';
														} else {
															echo '<option value="'.$fqc['id'].'">'.$fqc['category_name'].'</option>';
														}
													}
												}
												?>
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
						  <h3 class="box-title">Add Service</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<form action="" method="post">
							<?php
							if(isset($_POST['api_id']) || isset($_POST['api_s_id']) || isset($_POST['service_name']) || isset($_POST['service_min']) || isset($_POST['service_max']) || isset($_POST['service_category'])){
								$api_id = mysqli_real_escape_string($db, trim((int)$_POST['api_id']));
								$api_s_id = mysqli_real_escape_string($db, trim((int)$_POST['api_s_id']));
								$service_name = mysqli_real_escape_string($db, trim($_POST['service_name']));
								$service_min = mysqli_real_escape_string($db, trim((int)$_POST['service_min']));
								$service_max = mysqli_real_escape_string($db, trim((int)$_POST['service_max']));
								$service_price = mysqli_real_escape_string($db, trim((int)$_POST['service_price']));
								$service_category = mysqli_real_escape_string($db, trim((int)$_POST['service_category']));
								if(!$api_id || !$api_s_id || !$service_name || !$service_min || !$service_max || !$service_price || !$service_category){
									echo '<div class="alert alert-warning">No Data</div>';
								} else {
									$cex = mysqli_query($db, "SELECT * FROM service WHERE api_id = '$api_id'");
									if(mysqli_num_rows($cex)<1){
										$simpan = mysqli_query($db, "INSERT INTO service VALUES('', '$api_id', '$api_s_id', '$service_name', '$service_min', '$service_max', '$service_price', '$service_category', 'no')");
										if($simpan){
											echo '<div class="alert alert-success">Berhasil ditambahkan!</div><script>window.location.href = "manage_service.php"; </script>';
										} else {
											echo '<div class="alert alert-warning">Gagal ditambahkan!</div><script>window.location.href = "manage_service.php"; </script>';
										}
									} else {
										echo '<div class="alert alert-warning">Maaf, service yang anda submit itu sudah ada!</div>';
									}
								}
							}
							?>
								<div class="form-group">
									<label>API ID ( Provider API ID ):</label>
									<input type="text" name="api_id" id="api_id" class="form-control"/>
								</div>
								<div class="form-group">
									<label>API Server ID ( Provider Server API ID ) :</label>
									<select name="api_s_id" id="api_s_id" class="form-control">
										<?php
										$qcx = mysqli_query($db, "SELECT * FROM api_setting");
										if(mysqli_num_rows($qcx)<1){
											echo '<option>Tidak ada</option>';
										} else {
											while($fqcx = mysqli_fetch_assoc($qcx)){
												echo '<option value="'.$fqcx['id'].'">'.$fqcx['name'].'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Service Name:</label>
									<input type="text" name="service_name" id="service_name" class="form-control"/>
								</div>
								<div class="form-group">
									<label>Service Min:</label>
									<input type="number" name="service_min" id="service_min" class="form-control"/>
								</div>
								<div class="form-group">
									<label>Service Max:</label>
									<input type="number" name="service_max" id="service_max" class="form-control"/>
								</div>
								<div class="form-group">
									<label>Service Price/k:</label>
									<input type="number" name="service_price" id="service_price" class="form-control"/>
								</div>
								<div class="form-group">
									<label>Service Category:</label>
									<select name="service_category" id="service_category" class="form-control">
										<?php
										$qc = mysqli_query($db, "SELECT * FROM category WHERE enable = 'yes'");
										if(mysqli_num_rows($qc)<1){
											echo '<option>Tidak ada</option>';
										} else {
											while($fqc = mysqli_fetch_assoc($qc)){
												echo '<option value="'.$fqc['id'].'">'.$fqc['category_name'].'</option>';
											}
										}
										?>
									</select>
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">Manage Service</h3>
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
								<th>Category</th>
								<th>Name</th>
								<th>Min</th>
								<th>Max</th>
								<th>Price/k</th>
								<th>Status</th>
								<th>API ID</th>
								<th>API Provider</th>
								<th>Action</th>
							</tr>
							<? $q_x = mysqli_query($db, "SELECT * FROM service");
							if(mysqli_num_rows($q_x)<1){
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
								<td>No Data</td>
							</tr>';
							} else {
								while ($data = mysqli_fetch_assoc($q_x)) {
									echo '<tr>';
									echo '<td>'.$data['id'].'</td>';
									$xs = mysqli_query($db, "SELECT * FROM category WHERE id = '$data[service_category]'");
									$sx = mysqli_fetch_array($xs);
									echo '<td>'.$sx['category_name'].'</td>';
									echo '<td>'.$data['service_name'].'</td>';
									echo '<td>'.$data['service_min'].'</td>';
									echo '<td>'.$data['service_max'].'</td>';
									echo '<td>'.$data['service_price'].'</td>';
									if($data['closed'] == 'no'){
										$fakstat = 'OPEN';
									} else if($data['closed'] == 'yes'){
										$fakstat = 'CLOSED';
									}
									echo '<td>'.$fakstat.'</td>';
									echo '<td>'.$data['api_id'].'</td>';
									echo '<td>'.$data['api_s_id'].'</td>';
									echo '<td><a href="?edit='.$data['id'].'">Edit</a> / <a href="?delete='.$data['id'].'">Delete</a></td>';
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