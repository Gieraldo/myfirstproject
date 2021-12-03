<?php
include '../config/koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$cek = $conn->query("SELECT * FROM user WHERE username='$username' AND password='$password'");

if($cek->num_rows >0)
{	
	session_start();

	$r = $cek->fetch_array();
	// cek jika user login sebagai admin
	if($r['level']=="Admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "Admin";
		// alihkan ke halaman dashboard admin
		header("location:../admin/dashboard.php");

	// cek jika user login sebagai teknisi
	}else if($r['level']=="Teknisi"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "Teknisi";
		// alihkan ke halaman dashboard teknisi
		header("location:../teknisi/dashboard.php");

	}
}
	else
	{
	echo"<script>alert('gagal');window.location='../index.php';</script>";
	}
?>