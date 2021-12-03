 <?php 
include 'halau.php';
include '../config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');


if (isset($_POST['updatekonsumen'])){ 
				$kd_konsumen1         = $_POST ['kd_konsumen'];
				$nm_konsumen1         = $_POST ['nm_konsumen'];
				$telepon1             = $_POST ['telepon'];
				$alamat1              = $_POST ['alamat'];

				$id_konsumen1 		 = $_POST ['id_konsumen'];

				$data = $conn->prepare("UPDATE konsumen SET kd_konsumen =?, nm_konsumen =?, telepon =?, alamat =? WHERE id_konsumen =?");
				$data->bind_param('ssssi', $kd_konsumen1, $nm_konsumen1, $telepon1, $alamat1, $id_konsumen1);

			if ($data->execute()){
				header("location:../admin/konsumen.php?alert=update");
			} else {
				header ("location:../admin/konsumen.php?alert=gagal");
			}
			
			}
?> 