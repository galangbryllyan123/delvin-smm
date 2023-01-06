<?php
require_once('mainconfig.php');
$service = $_GET['service'];
$q = mysqli_query($db, "SELECT * FROM service WHERE api_id = '$service'");
$f = mysqli_fetch_assoc($q);
echo $f['service_price'];