<?php 
include 'halau.php';
include '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');


if (isset($_POST['updateteknisi'])){ 
				$kd_teknisi2         = $_POST ['kd_teknisi'];
				$nm_teknisi2         = $_POST ['nm_teknisi'];
				$telepon2            = $_POST ['telepon'];

				$no2 		         = $_POST ['no'];

				$data = $conn->prepare("UPDATE teknisi SET kd_teknisi =?, nm_teknisi =?, telepon =? WHERE no =?");
				$data->bind_param('sssi', $kd_teknisi2, $nm_teknisi2, $telepon2, $no2);

			if ($data->execute()){
				header("location:../admin/teknisi.php?alert=update");
			} else {
				header ("location:../admin/teknisi.php?alert=gagal");
			}
			
			}
?> 