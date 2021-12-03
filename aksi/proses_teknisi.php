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
                    header("location:../teknisi/servis.php?alert=insert");
                } else {
                    header ("location:../teknisi/servis.php?alert=gagal");
                }
            };


if (isset($_POST['update3'])){ 
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
        header("location:../teknisi/servis.php?alert=update");
    } else {
        header ("location:../teknisi/servis.php?alert=gagal");
    }
    
}
    //KIRIM Jasa
    if (isset ($_POST['kirimjasa'])){
        $data = $conn->prepare("INSERT INTO jasa (kd_jasa, kerusakan, harga) VALUES (?,?,?)");
        $kd_jasa        = $_POST ['kd_jasa'];
        $kerusakan      = $_POST ['kerusakan'];
        $harga          = $_POST ['harga'];
        
        $data->bind_param('sss', $kd_jasa, $kerusakan, $harga);

        if ($data->execute()){
            header("location:../teknisi/jasa.php?alert=insert");
        } else {
            header ("location:../teknisi/jasa.php?alert=gagal");
        }
    }

    //UPDATE Jasa
    if (isset($_POST['updatejasa'])){ 
        $kd_jasa1           = $_POST ['kd_jasa'];
        $kerusakan1         = $_POST ['kerusakan'];
        $harga1             = $_POST ['harga'];

        $no1 		       = $_POST ['no'];

        $data = $conn->prepare("UPDATE jasa SET kd_jasa =?, kerusakan =?, harga =? WHERE no =?");
        $data->bind_param('sssi', $kd_jasa1, $kerusakan1, $harga1, $no1);

    if ($data->execute()){
        header("location:../teknisi/jasa.php?alert=update");
    } else {
        header ("location:../teknisi/jasa.php?alert=gagal");
    }
    
    }

    //HAPUS JASA
    if (isset($_GET['kd_jasa'])){
        $kd_jasa = $_GET['kd_jasa'];
        $data = $conn->prepare("DELETE FROM jasa WHERE kd_jasa ='" .$kd_jasa."'");
        $data->bind_param('s', $kd_jasa);

        if ($data->execute()){
            header("location:../teknisi/jasa.php?alert=hapus");
        } else {
            header ("location:../teknisi/jasa.php?alert=gagal");
        }

    }

    //TAMBAH Teknisi
    if (isset ($_POST['kirimteknisi'])){
        $data = $conn->prepare("INSERT INTO teknisi (kd_teknisi, nm_teknisi, telepon) VALUES (?,?,?)");
        $kd_teknisi       = $_POST ['kd_teknisi'];
        $nm_teknisi       = $_POST ['nm_teknisi'];
        $telepon          = $_POST ['telepon'];
        
        $data->bind_param('sss', $kd_teknisi, $nm_teknisi, $telepon);

        if ($data->execute()){
            header("location:../teknisi/teknisi.php?alert=insert");
        } else {
            header ("location:../teknisi/teknisi.php?alert=gagal");
        }
    }

    //UBAH Teknisi
    if (isset($_POST['updateteknisi'])){ 
        $kd_teknisi2         = $_POST ['kd_teknisi'];
        $nm_teknisi2         = $_POST ['nm_teknisi'];
        $telepon2            = $_POST ['telepon'];

        $no2 		         = $_POST ['no'];

        $data = $conn->prepare("UPDATE teknisi SET kd_teknisi =?, nm_teknisi =?, telepon =? WHERE no =?");
        $data->bind_param('sssi', $kd_teknisi2, $nm_teknisi2, $telepon2, $no2);

    if ($data->execute()){
        header("location:../teknisi/teknisi.php?alert=update");
    } else {
        header ("location:../teknisi/teknisi.php?alert=gagal");
    }
    
    }

    //PROSES UNTUK MENGHAPUS DATA TEKNISI
		if (isset($_GET['kd_teknisi'])){
			$kd_teknisi = $_GET['kd_teknisi'];
			$data = $conn->prepare("DELETE FROM teknisi WHERE kd_teknisi ='" .$kd_teknisi."'");
			$data->bind_param('s', $kd_teknisi);

			if ($data->execute()){
				header("location:../teknisi/teknisi.php?alert=hapus");
			} else {
				header ("location:../teknisi/teknisi.php?alert=gagal");
			}

		}

?>