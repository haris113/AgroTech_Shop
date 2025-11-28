<?php 
include("koneksi.php");

	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$nama_database = 'agrotech_haris';

	$db = mysqli_connect($server,$user,$pass,$nama_database);

	if (!$db) {
		die("Gagal terhubung dengan database:" .mysqli_connect_error());
	}

 ?>