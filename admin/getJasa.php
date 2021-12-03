<?php

//membuat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "servis");

//variabel nim yang dikirimkan form.php
$nama_jasa = $_POST['nama_jasa'];

//mengambil data
$query = mysqli_query($koneksi, "select * from jasa where kerusakan='$nama_jasa'");
$jasa = mysqli_fetch_array($query);
$data = array(
            'kd_jasa'      =>  $jasa['kd_jasa'],
            'kerusakan'      =>  $jasa['kerusakan'],
            'harga'   =>  $jasa['harga']);

//tampil data
echo json_encode($data);
?>