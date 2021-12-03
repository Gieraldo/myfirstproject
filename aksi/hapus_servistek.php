<?php

include '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['no'])){
			$no = $_GET['no'];
			$data = $conn->prepare("DELETE FROM dataservis WHERE no = ?");
			$data->bind_param('i', $no);

			if ($data->execute()){
				header("location:../teknisi/dataservis.php?alert=hapus");
			} else {
				header ("location:../teknisi/dataservis.php?alert=gagal");
			}

		}
?>