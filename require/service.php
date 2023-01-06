<?php
require_once('mainconfig.php');
$category = $_GET['category'];
$query = mysqli_query($db, "SELECT * FROM service WHERE service_category = '$category' AND closed = 'no' ORDER BY id DESC");
echo '<option>Pilih layanan</option>';
while($row = mysqli_fetch_array($query)){
    echo "<option value=\"".$row['api_id']."\">".$row['service_name']."</option>\n";   
}
