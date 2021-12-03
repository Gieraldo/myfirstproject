<?php 
include 'halau.php';
include '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');


if (isset($_POST['updatejasa'])){ 
				$kd_jasa1           = $_POST ['kd_jasa'];
				$kerusakan1         = $_POST ['kerusakan'];
				$harga1             = $_POST ['harga'];

				$no1 		       = $_POST ['no'];

				$data = $conn->prepare("UPDATE jasa SET kd_jasa =?, kerusakan =?, harga =? WHERE no =?");
				$data->bind_param('sssi', $kd_jasa1, $kerusakan1, $harga1, $no1);

			if ($data->execute()){
				header("location:../admin/jasa.php?alert=update");
			} else {
				header ("location:../admin/jasa.php?alert=gagal");
			}
			
			}
?> 