<?php

include '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');
		// UPDATE STATUS
		if (isset($_GET['no'])) {
			$koneksi = mysqli_connect("localhost", "root", "", "servis");
			$no_servis = $_GET['no'];
			$tglambil    = date("Y-m-d");
			$query = mysqli_query($koneksi, "UPDATE servis_header set status = 'Y', tgl_ambil = '$tglambil' WHERE no_servis = $no_servis");
			
			if ($query){
				header("location:../admin/transaksi.php?alert=insert");
			} else {
				header ("location:../admin/transaksi.php?alert=gagal");
			}
		};


		// JIKA TOMBOL KIRIM DI KLIK DATA AKAN DISIMPAN KE DATABASE
		if (isset ($_POST['kirim'])){
			$data = $conn->prepare("INSERT INTO user (nama, username, password, level) VALUES (?,?,?,?)");
			$nama = $_POST ['nama'];
			$username = $_POST ['username'];
			$password = md5($_POST['password']);
			$level = $_POST ['level'];

			$data->bind_param('ssss', $nama, $username, $password, $level);

			if ($data->execute()){
				header("location:../user.php?alert=insert");
			} else {
				header ("location:../user.php?alert=gagal");
			}
		}
		
		//JIKA TOMBOL UPDATE DI KLIK MAKA PERINTAH DI BAWAH AKAN DIEKSEKUSI
		if (isset($_POST['update'])){ 
				$nama = $_POST['nama'];
				$username = $_POST['username'];
				$password = md5($_POST['password']) ;
				$level = $_POST ['level'];
				$id = $_POST['id'];

				$data = $conn->prepare("UPDATE user SET nama = ?, username = ?, password = ?, level = ? WHERE id = ?");
				$data->bind_param('ssssi', $nama, $username, $password, $level, $id);

				if ($data->execute()){
				header("location:../user.php?alert=update");
			} else {
				header ("location:../user.php?alert=gagal");
			}
			
			}


		//PROSES UNTUK MENGHAPUS DATA
		if (isset($_GET['id'])){
			$id = $_GET['id'];
			$data = $conn->prepare("DELETE FROM user WHERE id = ?");
			$data->bind_param('i', $id);

			if ($data->execute()){
				header("location:../user.php?alert=hapus");
			} else {
				header ("location:../user.php?alert=gagal");
			}

		}

		// JIKA TOMBOL KIRIM DI KLIK DATA AKAN DISIMPAN KE TABLE DATASERVIS
		if (isset ($_POST['kirim2'])){
			$koneksi = mysqli_connect("localhost", "root", "", "servis");

			$nmbarang       = $_POST ['nmbarang'];
			$nmkonsumen     = $_POST ['nmpemilik'];
			$nmteknisi     = $_POST ['nmteknisi'];
			$harga      	= $_POST ['harga'];
			$alamat      	= $_POST ['alamat'];
			$telp      		= $_POST ['tlpn'];
			$tglditerima    = date("Y-m-d");
			$qty 		    = $_POST ['qty'];			
			$query = mysqli_query($koneksi, "INSERT INTO servis_header (nm_barang, nm_konsumen, nm_teknisi, alamat, telp, qty, tgl_terima, harga, status) 
									VALUES ('$nmbarang','$nmkonsumen', '$nmteknisi', '$alamat','$telp','$qty','$tglditerima','$harga', 'N')");
			$ID = mysqli_insert_id($koneksi);
			
			foreach($_POST['SOD'] as $row) {
				$no_servis = $ID;
				$id_jasa = $row['hidden_kd_jasa'];
				$jumlah= $row['hidden_harga_jasa'];
				
				$query = mysqli_query($koneksi, "insert into servis_detail(no_servis, id_jasa, jumlah) values ('$no_servis', '$id_jasa','$jumlah')");
			}
			
			if ($query){
				header("location:../admin/transaksi.php?alert=insert");
			} else {
				header ("location:../admin/transaksi.php?alert=gagal");
			}
		};

		//JIKA TOMBOL UPDATE DI KLIK MAKA PERINTAH DI BAWAH AKAN DIEKSEKUSI
		if (isset($_POST['update2'])){ 
			$koneksi = mysqli_connect("localhost", "root", "", "servis");
			
			$nomor_array    = $_POST ['nomor_array'];
			$no       		= $_POST ['no'];
			$nmteknisi      = $_POST ['nm_teknisi'];
			$nmkonsumen     = $_POST ['nm_konsumen'];
			$nmbarang       = $_POST ['nm_barang'];
			$harga      	= $_POST ['harga'];
			$alamat      	= $_POST ['alamat'];
			$telp      		= $_POST ['tlpn'];
			$tglditerima    = date("Y-m-d");
			$qty 		    = $_POST ['qty'];			
			$query = mysqli_query($koneksi, "UPDATE servis_header set nm_teknisi ='$nmteknisi', nm_konsumen='$nmkonsumen', nm_barang = '$nmbarang', alamat = '$alamat', telp = '$telp', qty = '$qty', 
									tgl_terima = '$tglditerima', harga = '$harga' WHERE no_servis = '$no'");
			
			$hapus_detail_all = mysqli_query($koneksi, "DELETE FROM servis_detail WHERE no_servis = '$no'");
			$i = 0;
			foreach($_POST['SOD'] as $row) {
				$servisdetail_id = $row['hidden_id'];
				$id_jasa = $row['hidden_kd_jasa'];
				$jumlah= $row['hidden_harga_jasa'];
				$hidden_id[] = $_POST['SOD'][$i]['hidden_id'];

				$query = mysqli_query($koneksi, "INSERT into servis_detail(no_servis, id_jasa, jumlah) values ('$no', '$id_jasa','$jumlah')");				
				$i++; 
			}
			$del = "('".implode("','", $hidden_id)."')";
			// $hapus_detail = mysqli_query($koneksi, "DELETE FROM servis_detail WHERE servisdetail_id not in $del and no_servis = '$no'");
			
			if ($query){
				header("location:../admin/transaksi.php?alert=update");
			} else {
				header ("location:../admin/transaksi.php?alert=gagal");
			}
			
		}

			

			//PROSES UNTUK MENGHAPUS DATASERVIS
		// if (isset($_GET['no'])){
		// 	$no = $_GET['no'];
		// 	$data = $conn->prepare("DELETE FROM dataservis WHERE no = ?");
		// 	$data->bind_param('i', $no);

		// 	if ($data->execute()){
		// 		header("location:../admin/dataservis.php?alert=hapus");
		// 	} else {
		// 		header ("location:../admin/dataservis.php?alert=gagal");
		// 	}

		// }
		

		// JIKA TOMBOL KIRIM DI KLIK DATA AKAN DISIMPAN KE TABLE DATAKONSUMEN
		if (isset ($_POST['kirimkonsumen'])){
			$data = $conn->prepare("INSERT INTO konsumen (kd_konsumen, nm_konsumen, telepon, alamat) VALUES (?,?,?,?)");
			$kd_konsumen      = $_POST ['kd_konsumen'];
			$nm_konsumen      = $_POST ['nm_konsumen'];
			$telepon          = $_POST ['telepon'];
			$alamat           = $_POST ['alamat'];
			
			$data->bind_param('ssss', $kd_konsumen, $nm_konsumen, $telepon, $alamat);

			if ($data->execute()){
				header("location:../admin/konsumen.php?alert=insert");
			} else {
				header ("location:../admin/konsumen.php?alert=gagal");
			}
		}

		if (isset ($_POST['kirimjasa'])){
			$data = $conn->prepare("INSERT INTO jasa (kd_jasa, kerusakan, harga) VALUES (?,?,?)");
			$kd_jasa        = $_POST ['kd_jasa'];
			$kerusakan      = $_POST ['kerusakan'];
			$harga          = $_POST ['harga'];
			
			$data->bind_param('sss', $kd_jasa, $kerusakan, $harga);

			if ($data->execute()){
				header("location:../admin/jasa.php?alert=insert");
			} else {
				header ("location:../admin/jasa.php?alert=gagal");
			}
		}

		if (isset ($_POST['kirimteknisi'])){
			$data = $conn->prepare("INSERT INTO teknisi (kd_teknisi, nm_teknisi, telepon) VALUES (?,?,?)");
			$kd_teknisi       = $_POST ['kd_teknisi'];
			$nm_teknisi       = $_POST ['nm_teknisi'];
			$telepon          = $_POST ['telepon'];
			
			$data->bind_param('sss', $kd_teknisi, $nm_teknisi, $telepon);

			if ($data->execute()){
				header("location:../admin/teknisi.php?alert=insert");
			} else {
				header ("location:../admin/teknisi.php?alert=gagal");
			}
		}

		// if (isset ($_POST['kirimtransaksi2'])){
		// 	$data = $conn->prepare("INSERT INTO transaksi_servis (tanggal, nm_barang, kerusakan, qty, jumlah) VALUES (?,?,?,?,?)");
		// 	$tglambil1		  = date("Y-m-d ");
		// 	$nm_barang1       = $_POST ['nm_barang'];
		// 	$kerusakan1       = $_POST ['kerusakan'];
		// 	$qty1             = $_POST ['qty'];
		// 	$jumlah1		  = $_POST ['jumlah'];
			
		// 	$data->bind_param('sssss', $tglambil1, $nm_barang1, $kerusakan1, $qty1, $jumlah1);

		// 	if ($data->execute()){
		// 		header("location:../admin/trans.php?alert=insert");
		// 	} else {
		// 		header ("location:../admin/trans.php?alert=gagal");
		// 	}
		// }


		//JIKA TOMBOL UPDATE DI KLIK MAKA PERINTAH DI BAWAH AKAN DIEKSEKUSI
		// if (isset($_POST['updatekonsumen'])){ 
		// 	$kd_konsumen         = $_POST ['kd_konsumen'];
		// 	$nm_konsumen         = $_POST ['nm_konsumen'];
		// 	$telepon             = $_POST ['telepon'];
		// 	$alamat              = $_POST ['alamat'];

		// 	$id_konsumen 		 = $_POST ['id_konsumen'];

		// 	$data = $conn->prepare("UPDATE konsumen SET kd_konsumen = '', nm_konsumen = '', telepon = '', alamat = 't' WHERE id_konsumen = '' ");
		// 		$data->bind_param('ssssi', $kd_konsumen, $nm_konsumen, $telepon, $alamat, $id_konsumen);

		// 	if ($data->execute()){
		// 	header("location:../admin/konsumen.php?alert=update");
		// } else {
		// 	header ("location:../admin/konsumen.php?alert=gagal");
		// }
		
		// }

			

			//PROSES UNTUK MENGHAPUS DATA KONSUMEN
		if (isset($_GET['id_konsumen'])){
			$id_konsumen = $_GET['id_konsumen'];
			$data = $conn->prepare("DELETE FROM konsumen WHERE id_konsumen ='" .$id_konsumen."'");
			$data->bind_param('i', $id_konsumen);

			if ($data->execute()){
				header("location:../admin/konsumen.php?alert=hapus");
			} else {
				header ("location:../admin/konsumen.php?alert=gagal");
			}

		}

		//PROSES UNTUK MENGHAPUS DATA JASA
		if (isset($_GET['kd_jasa'])){
			$kd_jasa = $_GET['kd_jasa'];
			$data = $conn->prepare("DELETE FROM jasa WHERE kd_jasa ='" .$kd_jasa."'");
			$data->bind_param('s', $kd_jasa);

			if ($data->execute()){
				header("location:../admin/jasa.php?alert=hapus");
			} else {
				header ("location:../admin/jasa.php?alert=gagal");
			}

		}

		//PROSES UNTUK MENGHAPUS DATA TEKNISI
		if (isset($_GET['kd_teknisi'])){
			$kd_teknisi = $_GET['kd_teknisi'];
			$data = $conn->prepare("DELETE FROM teknisi WHERE kd_teknisi ='" .$kd_teknisi."'");
			$data->bind_param('s', $kd_teknisi);

			if ($data->execute()){
				header("location:../admin/teknisi.php?alert=hapus");
			} else {
				header ("location:../admin/teknisi.php?alert=gagal");
			}

		}
	

?>