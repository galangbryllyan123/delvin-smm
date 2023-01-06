<?php
$site = json_decode(json_encode(array(
	'title' => 'MUS - PANEL',
	'description' => 'smm panel indonesia',
	'keyword' => 'smm panel indonesia cheapest panel reseller',
	'author' => 'mus',
	'url' => 'http://instagrams.pw/', // Use /
	'name' => 'MUS - PANEL'
)));
$database = json_decode(json_encode(array(
	'host' => 'localhost',
	'user' => 'instagr8_abc1',
	'pass' => 'instagr8_abc1',
	'name' => 'instagr8_abc1'
)));
$tujuan = '<option value="081222328727">TSEL - 081222328727</option>';
$tujuan .= '<option value="083">AXIS - 083</option>';
$tujuan .= '<option value="xxx">BRI - xxx</option>';
$db = new mysqli($database->host, $database->user, $database->pass, $database->name);