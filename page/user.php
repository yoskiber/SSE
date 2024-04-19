<?php
include_once('connection.php');

$sql = 'SELECT * FROM users';
$user_data = $mysqli->query($sql);