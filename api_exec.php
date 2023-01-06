<?php
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('d-m-Y');
if(!isset($_POST['key']) || !isset($_POST['action'])){
	header('Location: api_i.php');
	exit;
}
header('content-type: application/json');
require_once('require/mainconfig.php');
$list_method = array("order", "status");
$action = trim(strtolower($_POST['action']));
if(!in_array($action, $list_method)){
	header('HTTP/1.1 400', true, 400);
	die(json_encode(array('result' => false, 'message' => 'Paramenter tidak valid!')));
} else {
	$cek = mysqli_query($db, "SELECT * FROM members WHERE api = '".mysqli_real_escape_string($db, trim($_POST['key']))."'");
	if(mysqli_num_rows($cek)<1){
		header('HTTP/1.1 400', true, 400);
		die(json_encode(array('result' => false, 'message' => 'API tidak valid!')));
	} else {
		$cek_fetch = mysqli_fetch_assoc($cek);
		if($action == 'order'){
			if(!isset($_POST['service']) || !isset($_POST['link']) || !isset($_POST['quantity'])){
				header('HTTP/1.1 400', true, 400);
				die(json_encode(array('result' => false, 'message' => 'Parameter order tidak valid!')));
			} else {
				$service = (int)$_POST['service'];
				$link = mysqli_real_escape_string($db, trim($_POST['link']));
				$quantity = (int)$_POST['quantity'];
				$s_q = mysqli_query($db, "SELECT * FROM service WHERE api_s_id = '$service'");
				if(mysqli_num_rows($s_q)<1){
					header('HTTP/1.1 400', true, 400);
					die(json_encode(array('result' => false, 'message' => 'Service tidak ada!')));
				} else {
					$f_s_q = mysqli_fetch_assoc($s_q);
					$harga = $quantity*($f_s_q['service_price']/1000);
					if($quantity < $f_s_q['service_min']){
						header('HTTP/1.1 400', true, 400);
						die(json_encode(array('result' => false, 'message' => 'Minimum pembelian '.$f_s_q['service_min'])));
					} else if($quantity > $f_s_q['service_max']){
						header('HTTP/1.1 400', true, 400);
						die(json_encode(array('result' => false, 'message' => 'Maximum pembelian '.$f_s_q['service_mmax'])));
					} else if($cek_fetch['saldo'] < $harga){
						header('HTTP/1.1 400', true, 400);
						die(json_encode(array('result' => false, 'message' => 'Saldo anda kurang')));
					} else {
						if(preg_match('#nstagram follower#', strtolower($f_s_q['service_name']))){
							if(preg_match('#www.instagram.com#', $link)){
								$ch = curl_init($link);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
								curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
								curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.76 Safari/537.36');
								$result = curl_exec($ch);$info = curl_getinfo($ch);curl_close($ch);
								if($info['http_code']<>200)
									$link = false;
							} else {
								$ch = curl_init('https://www.instagram.com/'.$link.'/');
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
								curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
								curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.76 Safari/537.36');
								$result = curl_exec($ch);$info = curl_getinfo($ch);curl_close($ch);
								if($info['http_code']<>200)
									$link = false;
							}
							if($link){
								preg_match('#"followed_by": {"count": (.*?)}#',$result,$id);
								if(!$id[1]){
									$link = false;
								} else {
									$start_count = $id[1];
								}
							}
						} else if(preg_match('#nstagram like#', strtolower($f_s_q['service_name']))){
							if(!preg_match('#www.instagram.com#', $link)){
								$link = false;
							} else {
								$ch = curl_init($link);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
								curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
								curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
								curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.76 Safari/537.36');
								$result = curl_exec($ch);$info = curl_getinfo($ch);curl_close($ch);
								if($info['http_code']<>200)
									$link = false;
								else{
									preg_match('#"likes": {"count": (.*?), "viewer_has_liked"#', $result, $key);
									if(!$key[0])
										$link = false;
									else
										$start_count = $key[1];
								}
							}
						}
						if($link==false){
							header('HTTP/1.1 400', true, 400);
							die(json_encode(array('result' => false, 'message' => 'Data tidak valid')));
						} else {
							require_once('require/smm.class.php');
							$ff = mysqli_query($db, "SELECT * FROM api_setting");
							$fx = mysqli_fetch_assoc($ff);
							$api = new Api();
							$api->api_url = $fx['apiurl'];
							$api->api_key = $fx['apikey'];
							$order = $api->order(array('service' => $f_s_q['api_id'], 'link' => $link, 'quantity' => $quantity));
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
									mysqli_query($db, "INSERT INTO history VALUES('', '".$order->order."', '$link', '$quantity', '$start_count', '".$order_info->remains."', '$f_s_q[service_name]', '$status', '$harga', '$cek_fetch[username]', '$f_s_q[api_id]', '$tanggal')");
								} else {
									mysqli_query($db, "INSERT INTO history VALUES('', '".$order->order."', '$link', '$quantity', '', '', '$f_s_q[service_name]', '$status', '$harga', '$cek_fetch[username]', '$f_s_q[api_id]', '$tanggal')");
								}
								mysqli_query($db, "UPDATE members SET saldo = saldo-$harga WHERE username = '$cek_fetch[username]'");
								print(json_encode(array('result' => true, 'data' => array('id' => (int)$order->order, 'product_name' => $f_s_q['service_name'], 'price_applied' => (int)$harga))));
							} else {
								print(json_encode(array('result' => false, 'message' => 'Parameter tidak valid! = GAGAL~')));
							}
						}
					}
				}
			}
		}
	}
}