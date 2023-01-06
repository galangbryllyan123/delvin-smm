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
			  <span class="logo-mini"><b>K</b>W</span>
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
                    <!-- Row-->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Order History</b></h4>
                            <p class="text-muted font-13 m-b-30">
                                "Setelah anda melakukan isi saldo, data akan tersimpan disini."
                            </p>
					<?php require_once('require/information.phtml'); ?>
					<div class="box box-info box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">Riwayat Deposit Saldo</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table class="table table-hover">
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
								<? $q_x = mysqli_query($db, "SELECT * FROM deposit WHERE uplink = '$sess[username]'");
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
							</tr>';
							} else {
								while ($data = mysqli_fetch_assoc($q_x)) {
									echo '<tr>';
									echo '<td>'.$data['id'].'</td>';
									echo '<td>'.$data['date'].'</td>';
									echo '<td>'.$data['via'].'</td>';
									echo '<td>'.$data['jumlah'].'</td>';
									echo '<td>'.$data['via_detail'].'</td>';
									echo '<td>'.$data['proof'].'</td>';
									echo '<td>'.$data['status'].'</td>';
									echo '<td>'.$data['approved_by'].'</td>';
									echo '</tr>';
								}
							} ?>
							</table><center><?php
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
					<div class="box box-primary box-solid">
						<div class="box-header with-border">
						  <h3 class="box-title">Deposit Saldo</h3>
						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						  </div>
						  <!-- /.box-tools -->
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<form method="post" enctype="multipart/form-data">
								<? if(!isset($_SESSION['proses'])){ ?>
								<?php 
								if(isset($_POST['to'])&&!empty($_POST['to'])&&isset($_POST['jumlah'])&&!empty($_POST['jumlah'])){
									$x = $_POST['to'];
									$xx = mysqli_query($db, "SELECT * FROM deposit_r WHERE tujuan = '$x'");
									if(mysqli_num_rows($xx)<1){
										echo '<div class="alert alert-warning">Metode pembayaran salah!</div>';
										exit();
									} else {
										$xx = mysqli_fetch_assoc($xx);
										$jumlah = (int)$_POST['jumlah'];
										$rate = round($jumlah*floatval($xx['rate']));
										$_SESSION['proses'] = true;
										$_SESSION['data'] = array('jumlah' => $jumlah, 'deposit' => $rate, 'tujuan' => $x, 'provider' => $xx['provider']);
										echo '<meta http-equiv="refresh" content="1;url=depo.php">Anda akan dialihkan...';
									}
								} else {
									echo '<div class="alert alert-info">Jangan transfer dana sebelum diberitahu, rate via pulsa 0.80, via bank 1.00. Proses saldo masuk dalam 1x24 jam.</div>';
								}
								?>
								<div class="form-group">
									<label>Tujuan:</label>
									<select name="to" id="to" class="form-control">
									<?php
									$x = mysqli_query($db, "SELECT * FROM deposit_r");
									while($datao = mysqli_fetch_assoc($x)){
										echo '<option value="'.$datao['tujuan'].'">'.$datao['provider'].' - '.$datao['tujuan'].' - '.$datao['rate'].'</option>';
									}
									?>
									</select>
								</div>
								<div class="form-group">
									<label>Jumlah:</label>
									<input type="number" class="form-control" id="jumlah" name="jumlah" />
								</div>
								<div class="form-group">
									<label>Saldo yang diterima:</label>
									<input type="number" class="form-control" id="received" disabled/>
								</div>
								<div class="text-right">
									<button class="btn btn-primary" type="submit">Deposit</button>
								</div>
								<? } else { 
								$data = json_decode(json_encode($_SESSION['data']));
								if(isset($_POST['sender']) || isset($_POST['file'])){
									$sender = mysqli_real_escape_string($db, trim($_POST['sender']));
									if(strlen($sender)<5){
										echo '<div class="alert alert-warning">Masukkan data yang benar!</div>';
									} else {
										$check = getimagesize($_FILES["img"]["tmp_name"]);
										if($check==false){
											echo '<div class="alert alert-warning">Bukti pembayaran harus berupa gambar</div>';
										} else {
											if($_FILES["img"]["size"] > 4096000){
												echo '<div class="alert alert-warning">Upload terlalu besar, MAX 4MB</div>';
											} else {
												$mime_list = array('image/jpeg', 'image/jpg', 'image/png');
												if(!in_array($check['mime'], $mime_list)){
													echo '<div class="alert alert-warning">Format file harus jpeg / jpg / png</div>';
												} else {
													if($check['mime']=='image/jpeg'){
														$ret = 'jpeg';
													} else if($check['mime']=='image/jpg'){
														$ret = 'jpg';
													} else if($check['mime']=='image/png'){
														$ret = 'png';
													}
													$proof = md5(time().rand());
													function ak_img_resize($target, $newcopy, $w, $h, $ext) {
														list($w_orig, $h_orig) = getimagesize($target);
														$scale_ratio = $w_orig / $h_orig;
														if (($w / $h) > $scale_ratio) {
															   $w = $h * $scale_ratio;
														} else {
															   $h = $w / $scale_ratio;
														}
														$img = "";
														$ext = strtolower($ext);
														if ($ext == "gif")
														  $img = imagecreatefromgif($target);
														else if($ext =="png")
														  $img = imagecreatefrompng($target);
														else
														  $img = imagecreatefromjpeg($target);
														$tci = imagecreatetruecolor($w, $h);
														imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
														imagejpeg($tci, $newcopy, 80);
													}
													ak_img_resize($_FILES["img"]["tmp_name"], 'payments/'.$proof.'.'.$ret, 480, 480, $ret);
													$tanggal = date('d-m-Y');
													$simpan = mysqli_query($db, "INSERT INTO deposit VALUES('', '$tanggal', '".$data->provider."', '".$sender."', '".$data->jumlah."', '".$data->rate."', '".$sender."', '".$proof.".".$ret."', '$sess[username]', 'pending', '')");
													if($simpan){
														unset($_SESSION['data']);
														unset($_SESSION['proses']);
														print '<meta http-equiv="refresh" content="5;url=depo.php"><div class="alert alert-success"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Sukses mensubmit informasi,silahkan tunggu sampai di konfirmasi Tim kami dalam 1x24 Jam</div>';														
													}
												}
											}
										}
									}
								}
								?>
									<h3>Detail Billing</h3><hr>
									<div class="form-group">
									  <label>Metode Pembayaran</label>
									  <span class="form-control"><?=$data->provider;?></span>
									</div>
									<div class="form-group">
									  <label>Tujuan</label>
									  <span class="form-control"><?=$data->tujuan;?></span>
									</div>
									<div class="form-group">
									  <label>Jumlah yang dibayar</label>
									  <span class="form-control">Rp. <?=number_format($data->jumlah,2,',','.')?>,-</span>
									</div>
									<div class="form-group">
									  <label>Jumlah yang di dapat</label>
									  <span class="form-control">Rp. <?=number_format($data->deposit,2,',','.')?>,-</span>
									</div><hr>
									Silahkan kirim dana, dan lengkapi form berikut :<br/>
									<div class="form-group">
									  <label>Sender ( Pengirim )</label>
									  <input type="text" name="sender" placeholder="081269723372 TSEL / 030213012903912 BRI" class="form-control"/>
									</div>
									<div class="form-group">
									  <label>Bukti Pembayaran</label>
									  <input id="img" type="file" class="file" name="img" data-preview-file-type="text"/>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-info">Konfirmasi</button>
									</div>
								<? } ?>
							</form>
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
<? } require_once('require/footer.phtml'); ?>