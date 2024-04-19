<?php
	$sql = $connection->query("SELECT * FROM mahasiswa WHERE nim='$_GET[key]'");
	$row = $sql->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validasi = false; $err = false;
	if ($update) {
		$sql = "UPDATE mahasiswa SET nim ='diterima' WHERE nim='$_GET[key]'";
	} else {
		$err = true;
	}echo alert("Berhasil!", "?page=lap_pendaftaran");