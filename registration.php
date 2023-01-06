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

			<form action="" method="post">
			<?php
			if($_SERVER['REQUEST_METHOD'] == "POST"){
				$nama = mysqli_real_escape_string($db, trim($_POST['nama']));
				$username = mysqli_real_escape_string($db, trim($_POST['username']));
				$password = mysqli_real_escape_string($db, trim($_POST['password']));
				if(!$nama || !$username || !$password){
					echo '<div class="alert alert-warning">No DatA</div>';
				} else {
					$c = mysqli_query($db, "SELECT * FROM members WHERE username = '$username'");
					if(mysqli_num_rows($c)<1){
						if(strlen($nama)<4 || strlen($username)<4 || strlen($password)<4){
							echo '<div class="alert alert-warning">Minimal 4Kata!</div>';
						} else {
							$tanggal = date('d-m-Y');
							$api = md5(sha1(md5(sha1('wildantamfan'.time()))));
							$simpan = mysqli_query($db, "INSERT INTO members VALUES('$nama', '$username', '$password', 'members', '0', 'server', '$tanggal', '', '$api')");
							if($simpan){
								echo '<div class="alert alert-success">Sukses</div>';
							} else {
								echo '<div class="alert alert-warning">Gagal</div>';
							}
						}
					} else {
						echo '<div class="alert alert-warning">Username sudah terdaftar</div>';
					}
				}
			}
			?>
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Nama" id="nama" name="nama">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Username" id="username" name="username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			  </div>
			  <div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" id="password" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			  <div class="text-right">
				<button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat">Sign Out</button>
			  </div>
			</form>
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
		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

<? } require_once('require/footer.phtml'); ?>