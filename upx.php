<?php
set_time_limit(0);
ignore_user_abort(1);

require_once('require/mainconfig.php');
require_once('require/smm.class.php');

$q = mysqli_query($db, "SELECT * FROM history");
while($f = mysqli_fetch_assoc($q)){
	$id = $f['id'];
	$harga = $f['price'];
	$uplink = $f['uplink'];
	
	// Service
	$qservice = mysqli_query($db, "SELECT * FROM service WHERE api_id = '$f[service_id]'");
	$fservice = mysqli_fetch_assoc($qservice);
	
	$provider = $fservice['api_s_id'];
	$setatus = $f['status'];
	
	// API
	$qapi = mysqli_query($db, "SELECT * FROM api_setting WHERE id = '$fservice[api_s_id]'");
	$fapi = mysqli_fetch_assoc($qapi);
	
	if($setatus<>"2"){
		$api = new Api();
		$api->api_url = $fapi['apiurl'];
		$api->api_key = $fapi['apikey'];
		$stat = $api->status($id);
		$wilr00t = $stat->status;
		if($wilr00t == 'Pending'){
			$status = 1;
		} else if($wilr00t == 'In progress'){
			$status = 4;
		} else if($wilr00t == 'Completed'){
			$status = 2;
		} else if($wilr00t == 'Partial'){
			$status = 3;
		} else if($wilr00t == 'Canceled'){
			$status = 5;
		} else if($wilr00t == 'Processing'){
			$status = 6;
		}
		$remain = $stat->remains;
		if($stat->error){
			echo "$id, $wilr00t, $remain, $fapi[apiurl], $fapi[apikey], ".$stat->error."<br/>";
		} else {
			$update = mysqli_query($db, "UPDATE history SET status = '$status', remain = '$remain' WHERE id = '$id'");
			if($update){
				echo "ID : $id , Updated to status $wilr00t ~<br/>";
			}
		}
	}
}