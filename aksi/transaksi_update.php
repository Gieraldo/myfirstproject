<?php 
include '../config/koneksi.php';

if (isset($_POST['update'])){ 
				$nmbarang          = $_POST ['nmbarang'];
				$nmpemilik         = $_POST ['nmpemilik'];
				$alamat            = $_POST ['alamat'];
				$tlpn              = $_POST ['tlpn'];
				$kerusakan         = $_POST ['kerusakan'];
				// $kelengkapan       = $_POST ['kelengkapan'];
				$penerimabarang    = $_POST ['penerimabarang'];
				$teknisi           = $_POST ['teknisi'];
				$kondisibrg        = $_POST ['kondisibrg'];
				$tglambil          = date("Y-m-d");
				$qty  			   = $_POST ['qty'];
				
				$biaya             = $_POST ['biaya'];
				$no = $_POST['no'];

				$data = $conn->prepare("UPDATE dataservis SET nmbarang = ?, nmpemilik = ?, alamat = ?, tlpn = ?, kerusakan = ?, penerimabarang = ?, teknisi = ?, kondisibrg = ?, tglambil = ?, qty = ?, biaya = ? WHERE no = ?");
				$data->bind_param('sssssssssssi', $nmbarang, $nmpemilik, $alamat, $tlpn, $kerusakan, $penerimabarang, $teknisi, $kondisibrg, $tglambil, $qty, $biaya, $no);

				if ($data->execute()){
				header("location:../admin/dataservis.php?alert=update");
			} else {
				header ("location:../admin/dataservis.php?alert=gagal");
			}
			
			}

if (isset($_POST['update3'])){ 
				$nmbarang          = $_POST ['nmbarang'];
				$nmpemilik         = $_POST ['nmpemilik'];
				$alamat            = $_POST ['alamat'];
				$tlpn              = $_POST ['tlpn'];
				$kerusakan         = $_POST ['kerusakan'];
				$tglterima          = date("Y-m-d");
				$qty               = $_POST ['qty'];

				$no = $_POST['no'];

				$data = $conn->prepare("UPDATE dataservis SET nmbarang = ?, nmpemilik = ?, alamat = ?, tlpn = ?, kerusakan = ?, tglditerima = ?, qty = ? WHERE no = ?");
				$data->bind_param('sssssssi', $nmbarang, $nmpemilik, $alamat, $tlpn, $kerusakan, $tglterima, $qty, $no);

				if ($data->execute()){
				header("location:../admin/transaksi.php?alert=update");
			} else {
				header ("location:../admin/transaksi.php?alert=gagal");
			}
			
			}

?>