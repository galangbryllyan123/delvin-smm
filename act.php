<?php
session_start();
require_once('require/mainconfig.php');
if(isset($_GET['login'])){
	$username = mysqli_real_escape_string($db, trim($_POST['username']));
	$password = mysqli_real_escape_string($db, trim($_POST['password']));
	if($username == "" && $password == ""){
		echo '<div class="alert alert-warning">No Data</div>';
	} else {
		$c = mysqli_query($db, "SELECT * FROM members WHERE username = '$username'");
		if(mysqli_num_rows($c)<1){
			echo '<div class="alert alert-warning">Login gagal, username tidak terdaftar!</div>';
		} else {
			$f = mysqli_fetch_assoc($c);
			if($password<>$f['password']){
				echo '<div class="alert alert-warning">Login gagal, password salah !</div>';
			} else {
				$_SESSION['account'] = $f;
				echo '<div class="alert alert-success">Login sukses, akan di alihkan !</div><script>window.location.href = "/";</script>';
			}
		}
	}
} else if(isset($_GET['order'])){
	$sess = $_SESSION['account'];
	$myq = mysqli_query($db, "SELECT * FROM members WHERE username = '$sess[username]'");
	$myf = mysqli_fetch_assoc($myq);
	$category = mysqli_real_escape_string($db, trim($_POST['category']));
	$service = mysqli_real_escape_string($db, trim($_POST['service']));
	$data = mysqli_real_escape_string($db, trim($_POST['data']));
	$jumlah = mysqli_real_escape_string($db, trim($_POST['jumlah']));
	if(!$category || !$service || !$data || !$jumlah){
		echo '<div class="alert alert-warning">No Data</div>';
	} else {
		$s_q = mysqli_query($db, "SELECT * FROM service WHERE api_id = '$service'");
		if(mysqli_num_rows($s_q)<1){
			echo '<div class="alert alert-warning">Layanan tidak ditemukan</div>';
		} else {
			$f = mysqli_fetch_assoc($s_q);
			$harga = $jumlah*($f['service_price']/1000);
			if($jumlah < $f['service_min']){
				echo '<div class="alert alert-warning">Minimum pembelian adalah '.$f['service_min'].'</div>';
			} else if($jumlah > $f['service_max']){
				echo '<div class="alert alert-warning">Maximum pembelian adalah '.$f['service_max'].'</div>';
			} else if($myf['saldo'] < $harga){
				echo '<div class="alert alert-warning">Saldo anda kurang~</div>';
			} else {
				if(preg_match('#nstagram follower#', strtolower($f['service_name']))){
					if(preg_match('#www.instagram.com#', $data)){
						$ch = curl_init($data);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.76 Safari/537.36');
						$result = curl_exec($ch);$info = curl_getinfo($ch);curl_close($ch);
						if($info['http_code']<>200)
							$data = false;
					} else {
						$ch = curl_init('https://www.instagram.com/'.$data.'/');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.76 Safari/537.36');
						$result = curl_exec($ch);$info = curl_getinfo($ch);curl_close($ch);
						if($info['http_code']<>200)
							$data = false;
					}
					if($data){
						preg_match('#"followed_by": {"count": (.*?)}#',$result,$id);
						if(!$id[1]){
							$link = false;
						} else {
							$start_count = $id[1];
						}
					}
				} else if(preg_match('#nstagram like#', strtolower($f['service_name']))){
					if(!preg_match('#www.instagram.com#', $data)){
						$data = false;
					} else {
						$ch = curl_init($data);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
						curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.76 Safari/537.36');
						$result = curl_exec($ch);$info = curl_getinfo($ch);curl_close($ch);
						if($info['http_code']<>200)
							$data = false;
						else{
							preg_match('#"likes": {"count": (.*?), "viewer_has_liked"#', $result, $key);
							if(!$key[0])
								$data = false;
							else
								$start_count = $key[1];
						}
					}
				}
				if($data==false){
					echo '<div class="alert alert-warning">Data tidak benar!</div>';
				} else {
					if($category == '4'){
						$acak = rand(0, 99999);
						$tanggal = date('d-m-Y');
						$simpan = mysqli_query($db, "INSERT INTO history_manual VALUES('', '".$acak."', '$data', '$jumlah', '$start_count', '$jumlah', '$f[service_name]', '1', '$harga', '$sess[username]', '$f[api_id]', '$tanggal')");
						$simpan = mysqli_query($db, "INSERT INTO history VALUES('', '".$acak."', '$data', '$jumlah', '$start_count', '$jumlah', '$f[service_name]', '1', '$harga', '$sess[username]', '$f[api_id]', '$tanggal')");
						if($simpan){
							mysqli_query($db, "UPDATE members SET saldo = saldo-$harga WHERE username = '$sess[username]'");
							echo '<div class="alert alert-success"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Pembelian produk <b>'.$f['service_name'].'</b> dengan jumlah sebesar <b>'.$jumlah.'</b> berhasil dilakukan.Silahkan cek pesanan anda di<a href="history.php">sini</a></div>';
						}
					} else {
						require_once('require/smm.class.php');
						$ff = mysqli_query($db, "SELECT * FROM api_setting WHERE id = '$f[api_s_id]'");
						$fx = mysqli_fetch_assoc($ff);
						$api = new Api();
						$api->api_url = $fx['apiurl'];
						$api->api_key = $fx['apikey'];
						$order = $api->order(array('service' => $f['api_id'], 'link' => $data, 'quantity' => $jumlah));
						if(!isset($order->error)){
							$order_info = $api->status($order->order);
							$start_count = (!$start_count) ? $order_info->start_count : $start_count;
							if(!isset($order_info->error)){
								$setatus = $order_info->status;
								if($setatus=='Pending') {
									$status = 1;
								} else if($setatus=='In progress') {
									$status = 4;
								} else if($setatus=='Completed') {
									$status = 2;
								} else if($setatus=='Partial') {
									$status = 3;
								} else if($setatus=='Canceled') {
									$status = 5;
								} else if($setatus=='Processing') {
									$status = 6;
								}
								$tanggal = date('d-m-Y');
								mysqli_query($db, "INSERT INTO history VALUES('', '".$order->order."', '$data', '$jumlah', '$start_count', '".$order_info->remains."', '$f[service_name]', '$status', '$harga', '$sess[username]', '$f[api_id]', '$tanggal')");
							} else {
								mysqli_query($db, "INSERT INTO history VALUES('', '".$order->order."', '$data', '$jumlah', '', '', '$f[service_name]', '$status', '$harga', '$sess[username]', '$f[api_id]', '$tanggal')");
							}
							mysqli_query($db, "UPDATE members SET saldo = saldo-$harga WHERE username = '$sess[username]'");
							echo '<div class="alert alert-success"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Pembelian produk <b>'.$f['service_name'].'</b> dengan jumlah sebesar <b>'.$jumlah.'</b> berhasil dilakukan.Silahkan cek pesanan anda di<a href="history.php">sini</a></div>';
						} else {
							echo '<div class="alert alert-warning">Orderan gagal, saldo tidak akan mengurang~</div>';
						}
					}
				}
			}
		}
	}
} else if(isset($_GET['edit'])){
	$nama = mysqli_real_escape_string($db, trim($_POST['nama']));
	$username = mysqli_real_escape_string($db, trim($_POST['username']));
	$password = mysqli_real_escape_string($db, trim($_POST['password']));
	$level = mysqli_real_escape_string($db, trim($_POST['level']));
	$saldo = mysqli_real_escape_string($db, trim($_POST['saldo']));
	$api = mysqli_real_escape_string($db, trim($_POST['api']));
	$cekwa = mysqli_query($db, "SELECT * FROM members WHERE username = '$username'");
	if(mysqli_num_rows($cekwa)<1){
		echo '<div class="alert alert-warning">Member tidak terdaftar</div>';
	} else {
		$fetchwa = mysqli_fetch_assoc($cekwa);
		$simpan = mysqli_query($db, "UPDATE members SET nama = '$nama', password = '$password', level = '$level', saldo = '$saldo', api = '$api' WHERE username = '$username'");
		if($simpan){
			echo '<div class="alert alert-success">User berhasil diubah!</div>';
		} else {
			echo '<div class="alert alert-warning">User gagal diubah!</div>';
		}
	}
} else if(isset($_GET['editorder'])){
	$order_id = mysqli_real_escape_string($db, trim((int)$_POST['order_id']));
	$status = mysqli_real_escape_string($db, trim((int)$_POST['status']));
	$cek_order = mysqli_query($db, "SELECT * FROM history WHERE order_id = '$order_id'");
	if(mysqli_num_rows($cek_order)<1){
		echo '<div class="alert alert-warning">Orderan tidak terdaftar</div>';
	} else {
		$fetch_order = mysqli_fetch_assoc($cek_order);
		if($status == $fetch_order['status']){
			echo '<div class="alert alert-warning">Tidak bisa mengubah ke status yang sama!</div>';
		} else {
			if($status == '5'){
				$simpan = mysqli_query($db, "UPDATE history SET status = '$status' WHERE order_id = '$order_id'");
				$simpan = mysqli_query($db, "UPDATE members SET saldo = saldo+'$fetch_order[price]' WHERE username = '$fetch_order[uplink]'");
				if($simpan){
					echo '<div class="alert alert-success">Orderan berhasil diubah!</div><script>window.location.href = "manage_order.php";</script>';
				} else {
					echo '<div class="alert alert-warning">Orderan gagal diubah!</div>';
				}
			} else {
				$simpan = mysqli_query($db, "UPDATE history SET status = '$status' WHERE order_id = '$order_id'");
				if($simpan){
					echo '<div class="alert alert-success">Orderan berhasil diubah!</div><script>window.location.href = "manage_order.php";</script>';
				} else {
					echo '<div class="alert alert-warning">Orderan gagal diubah!</div>';
				}
			}
		}
	}
} else if(isset($_GET['editorderman'])){
	$order_id = mysqli_real_escape_string($db, trim((int)$_POST['order_id']));
	$status = mysqli_real_escape_string($db, trim((int)$_POST['status']));
	$cek_order = mysqli_query($db, "SELECT * FROM history_manual WHERE order_id = '$order_id'");
	if(mysqli_num_rows($cek_order)<1){
		echo '<div class="alert alert-warning">Orderan tidak terdaftar</div>';
	} else {
		$fetch_order = mysqli_fetch_assoc($cek_order);
		if($status == $fetch_order['status']){
			echo '<div class="alert alert-warning">Tidak bisa mengubah ke status yang sama!</div>';
		} else {
			if($status == '5'){
				$simpan = mysqli_query($db, "UPDATE history_manual SET status = '$status' WHERE order_id = '$order_id'");
				$simpan = mysqli_query($db, "UPDATE history SET status = '$status' WHERE order_id = '$order_id'");
				$simpan = mysqli_query($db, "UPDATE members SET saldo = saldo+'$fetch_order[price]' WHERE username = '$fetch_order[uplink]'");
				if($simpan){
					echo '<div class="alert alert-success">Orderan berhasil diubah!</div><script>window.location.href = "manage_order.php";</script>';
				} else {
					echo '<div class="alert alert-warning">Orderan gagal diubah!</div>';
				}
			} else {
				$simpan = mysqli_query($db, "UPDATE history_manual SET status = '$status' WHERE order_id = '$order_id'");
				if($simpan){
					echo '<div class="alert alert-success">Orderan berhasil diubah!</div><script>window.location.href = "manage_order.php";</script>';
				} else {
					echo '<div class="alert alert-warning">Orderan gagal diubah!</div>';
				}
			}
		}
	}
} else if(isset($_GET['editinfo'])){
	$id = mysqli_real_escape_string($db, trim((int)$_POST['id']));
	$informasi = mysqli_real_escape_string($db, trim($_POST['informasi']));
	$bagian = mysqli_real_escape_string($db, trim($_POST['bagian']));
	$date = mysqli_real_escape_string($db, trim($_POST['date']));
	$cek_info = mysqli_query($db, "SELECT * FROM informasi WHERE id = '$id'");
	if(mysqli_num_rows($cek_info)<1){
		echo '<div class="alert alert-warning">Infomrasi tidak ditemukan!</div>';
	} else {
		$fetch_info = mysqli_fetch_assoc($cek_info);
		$simpan = mysqli_query($db, "UPDATE informasi SET informasi = '$informasi', bagian = '$bagian', date = '$date' WHERE id = '$id'");
		if($simpan){
			echo '<div class="alert alert-success">Berhasil diubah!</div><script>window.location.href = "manage_info.php";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal diubah!</div><script>window.location.href = "manage_info.php";</script>';
		}
	}
} else if(isset($_GET['editdepo'])){
	$id = mysqli_real_escape_string($db, trim((int)$_POST['id']));
	$status = mysqli_real_escape_string($db, trim($_POST['status']));
	$approved_by = mysqli_real_escape_string($db, trim($_POST['approved_by']));
	$cek_de = mysqli_query($db, "SELECT * FROM deposit WHERE id = '$id'");
	if(mysqli_num_rows($cek_de)<1){
		echo '<div class="alert alert-warning">Deposit ID tidak ditemukan!</div>';
	} else {
		$fetch_de = mysqli_fetch_assoc($cek_de);
		if($status == "paid"){
			$simpan = mysqli_query($db, "UPDATE members SET saldo = saldo+'$fetch_de[jumlah]' WHERE username = '$fetch_de[uplink]'");
			$simpan = mysqli_query($db, "UPDATE deposit SET status = '$status', approved_by = '$approved_by' WHERE id = '$id'");
			if($simpan){
				echo '<div class="alert alert-success">Berhasil diubah!</div><script>window.location.href = "manage_deposit.php";</script>';
			} else {
				echo '<div class="alert alert-warning">Gagal diubah!</div><script>window.location.href = "manage_deposit.php";</script>';
			}
		} else {
			$simpan = mysqli_query($db, "UPDATE deposit SET status = '$status', approved_by = '$approved_by' WHERE id = '$id'");
			if($simpan){
				echo '<div class="alert alert-success">Berhasil diubah!</div><script>window.location.href = "manage_deposit.php";</script>';
			} else {
				echo '<div class="alert alert-warning">Gagal diubah!</div><script>window.location.href = "manage_deposit.php";</script>';
			}
		}
	}
} else if(isset($_GET['editservice'])){
	$id = mysqli_real_escape_string($db, trim((int)$_POST['id']));
	$api_id = mysqli_real_escape_string($db, trim((int)$_POST['api_id']));
	$api_s_id = mysqli_real_escape_string($db, trim((int)$_POST['api_s_id']));
	$service_name = mysqli_real_escape_string($db, trim($_POST['service_name']));
	$service_min = mysqli_real_escape_string($db, trim((int)$_POST['service_min']));
	$service_max = mysqli_real_escape_string($db, trim((int)$_POST['service_max']));
	$service_price = mysqli_real_escape_string($db, trim((int)$_POST['service_price']));
	$service_category = mysqli_real_escape_string($db, trim((int)$_POST['service_category']));
	$cek_de = mysqli_query($db, "SELECT * FROM service WHERE id = '$id'");
	if(mysqli_num_rows($cek_de)<1){
		echo '<div class="alert alert-warning">ServiceID tidak ditemukan!</div>';
	} else {
		$fetch_de = mysqli_fetch_assoc($cek_de);
		$simpan = mysqli_query($db, "UPDATE service SET api_id = '$api_id', api_s_id = '$api_s_id', service_name = '$service_name', service_min = '$service_min', service_max = '$service_max', service_price = '$service_price', service_category = '$service_category' WHERE id = '$id'");
		if($simpan){
			echo '<div class="alert alert-success">Berhasil diubah!</div><script>window.location.href = "manage_service.php";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal diubah!</div><script>window.location.href = "manage_service.php";</script>';
		}
	}
} else if(isset($_GET['editcategory'])){
	$id = mysqli_real_escape_string($db, trim((int)$_POST['id']));
	$category_name = mysqli_real_escape_string($db, trim($_POST['category_name']));
	$enable = mysqli_real_escape_string($db, trim($_POST['enable']));
	$cek_de = mysqli_query($db, "SELECT * FROM category WHERE id = '$id'");
	if(mysqli_num_rows($cek_de)<1){
		echo '<div class="alert alert-warning">ServiceID tidak ditemukan!</div>';
	} else {
		$fetch_de = mysqli_fetch_assoc($cek_de);
		$simpan = mysqli_query($db, "UPDATE category SET category_name = '$category_name', enable = '$enable' WHERE id = '$id'");
		if($simpan){
			echo '<div class="alert alert-success">Berhasil diubah!</div><script>window.location.href = "manage_category.php";</script>';
		} else {
			echo '<div class="alert alert-warning">Gagal diubah!</div><script>window.location.href = "manage_category.php";</script>';
		}
	}
}