<?php
include '../aksi/halau.php';
include '../config/koneksi.php';

//PERINTAH UNTUK MENGEDIT DATA BERDASARKAN ID DATA
if (isset($_GET['no'])) {
	$data = $conn->prepare("SELECT A.*, B.* FROM servis_header A
	LEFT JOIN servis_detail B on A.no_servis = B.no_servis WHERE A.no_servis = ? ");
	$no_servis = $_GET['no'];
	$data->bind_param('i', $no_servis);
	$data->execute();

	$result = $data->get_result();
	$row= $result->fetch_row();
}

?>




<!DOCTYPE html>
<html lang="en">

<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Aplikasi</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="seniman koding">
	<meta name="keyword"
		content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->

	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
	<link id="bootstrap-style" href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="../css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="../css/style-responsive.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css2/font.css">
	<!-- end: CSS -->


	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->

	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->

	<!--Tanggal Kalender-->




</head>

<body>

	<!-- start: Header -->
	<?php include 'navbar.php'; ?>
	<!-- start: Header -->

	<div class="container-fluid-full">
		<div class="row-fluid">

			<!-- start: Main Menu -->
			<?php include 'sidebarr.php'; ?>
			<!-- end: Main Menu -->
			<!-- start: Content -->
			<div id="content" class="span10">


				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="dashboard.php">Home</a>
						<i class="icon-angle-right"></i>
					</li>
					<li><a href="transaksi.php">Data Transaksi</a></li>
				</ul>

				<?php
		  	if (isset ($_GET['alert'])){
		  		$alert = $_GET['alert'];
		  		if ($alert == "insert"){
		  			?>
				<?php echo '<div class="alert alert-success"><strong>Success!</strong>Data Berhasil disimpan <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button></div>';?>
				<?php
		  		} elseif ($alert == "hapus"){
		  			?>
				<?php echo '<div class="alert alert-info"><strong>Success!</strong>Data Berhasil dihapus <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button></div>';?>
				<?php
		  		} elseif ($alert == "update"){
		  			?>
				<?php echo '<div class="alert alert-warning"><strong>Success!</strong>Data Berhasil diupdate <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button></div>';?>
				<?php
		  		} elseif ($alert == "gagal"){
		  			?>
				<?php echo '<div class="alert alert-danger"><strong>Gagal!</strong>Data Gagal di eksekusi <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button></div>';?>
				<?php
		  		}
		  	}
		?>



				<div class="row-fluid ">
					<div class="box span6">
						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon user"></i><span class="break"></span>Edit Data</h2>
							<div class="box-icon">
								<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
								<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
							</div>
						</div>

						<div class="">
							<form class="form-horizontal" action="../aksi/proses.php?update2" method="post">
								<div class="form-group">
									<label class="control-label col-sm-2" for="no">No. NOTA:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="no"
											value="<?php echo "80/DK/".$row ['0']; ?>" readonly>
									</div>
								</div><br>
								<div class="form-group">
									<label class="control-label col-sm-2" for="nm_barang">Nama Barang:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="nm_barang"
											value="<?php echo $row ['3']; ?>" required>
									</div>
								</div><br>

								<div class="form-group">
									<label class="control-label col-sm-2" for="nm_konsumen">Nama Konsumen :</label>
									<div class="col-sm-10">
										<select name="nm_konsumen" class="form-control" required>
											<?php
											include '../config/koneksi.php';

											
											$data = $conn->query("SELECT * FROM konsumen ORDER BY nm_konsumen desc");
											
											while ($result = $data->fetch_assoc()){
												?>
												<?php if($row['2'] == $result['nm_konsumen']){ ?>
														<option value="<?= $result['nm_konsumen']; ?>" selected><?= $result['nm_konsumen']; ?></option>
												<?php } else { ?>
														<option value="<?= $result['nm_konsumen']; ?>"><?= $result['nm_konsumen']; ?></option>
												<?php } ?>
											
											<?php
											}
											$data->close();
											$conn->close();
												?>
										</select>
									</div>
								</div><br>
								<div class="form-group">
									<label class="control-label col-sm-2" for="nm_teknisi">Nama Teknisi:</label>
									<div class="col-sm-10">
										<select name="nm_teknisi" class="form-control" required>
											<?php
											include '../config/koneksi.php';

											
											$data = $conn->query("SELECT * FROM teknisi");
											
											while ($result = $data->fetch_assoc()){
												?>
												<?php if($row['1'] == $result['nm_teknisi']){ ?>
														<option value="<?= $result['nm_teknisi']; ?>" selected><?= $result['nm_teknisi']; ?></option>
												<?php } else { ?>
														<option value="<?= $result['nm_teknisi']; ?>"><?= $result['nm_teknisi']; ?></option>
												<?php } ?>
												<?php											
											}
											$data->close();
											$conn->close();
												?>
										</select>
									</div>
								</div><br>

								<div class="form-group">
									<label class="control-label col-sm-2" for="alamat">Alamat:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="alamat"
											value="<?php echo $row ['4']; ?>" required>
									</div>
								</div><br>

								<div class="form-group">
									<label class="control-label col-sm-2" for="telp">No.Tlpn:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="tlpn"
											value="<?php echo $row ['5']; ?>" required>
									</div>
								</div><br>

								<!-- <div class="form-group">
					    <label class="control-label col-sm-2" for="kelengkapan">Kelengkapan:</label>
					    <div class="col-sm-10"> 
					      <input type="text" class="form-control" name="kelengkapan" value="<?php echo $row ['6']; ?>" required>
					    </div>
					  </div><br> -->
<!-- 
								<div class="form-group">
									<label class="control-label col-sm-2" for="kelengkapan">Tgl. Diterima:</label>
									<div class="col-sm-10">
										<input type="date" class="form-control" name="tglditerima"
											value="<?php echo $row ['7']; ?>" readonly><span style="color:#0573fb" ;>
											bln/tgl/thn</span>
									</div>
								</div><br> -->

								<div class="form-group">
									<label class="control-label col-sm-2" for="qty">QTY:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="qty"
											value="<?php echo $row ['6']; ?>" required>
									</div>
								</div><br>

								<div class="form-group">
									<label class="control-label col-sm-2" for="harga">Total Harga :</label>
									<div class="col-sm-10">
										<input type="text" class="form-control harga_js" name="harga"
											value="<?php echo $row ['9']; ?>" readonly>
									</div>
								</div><br>

								<button type="button" name="add" id="add" class="btn btn-success btn-sm">Add
									Jasa</button>

								<!-- ================== modal ==================== -->
								<div id="user_dialog" title="Add Data">
									<div class="form-group">
										<label class="control-label col-sm-2" for="nama_jasa">Nama Jasa :</label>
										<div class="col-sm-10">
											<select name="nama_jasa" id="nama_jasa" class="form-control" required>
												<?php
												include '../config/koneksi.php';
												$data = $conn->query("SELECT * FROM jasa ORDER BY kerusakan desc");
												
												while ($result = $data->fetch_assoc()){
													?>
												<option value="<?= $result['kerusakan']; ?>">
													<?= $result['kerusakan']; ?></option>
												<?php
												
												}
												$data->close();
												$conn->close();
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>Harga Jasa</label>
										<input type="text" name="harga_jasa" id="harga_jasa" class="form-control" />
										<input type="hidden" name="kd_jasa" id="kd_jasa" class="form-control" />
									</div>
									<div class="form-group" align="center">
										<input type="hidden" name="row_id" id="hidden_row_id" />
										<button type="button" name="save" id="save" class="btn btn-info">Save</button>
										<button type="button" name="" id="cancel" class="btn btn-danger">Cancel</button>
									</div>
								</div>
								<!-- ================== modal ==================== -->
								<!-- ================== servis detail ================== -->
								<h5 style="text-align:center">Tambah Jasa</h5>

								<table class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											<th>
												<font size="2">Kerusakan
											</th>
											<th>
												<font size="2">Harga
											</th>
											<th>
												<font size="2">Status
											</th>
										</tr>
									</thead>
									<tbody id="user_data">
									<?php
									include '../config/koneksi.php';

									$no = 2;
									$data = $conn->query("SELECT a.*, b.* FROM servis_detail a left join jasa b on a.id_jasa = b.kd_jasa WHERE a.no_servis = '".$row['0']."' ORDER BY no_servis desc");

									
									while ($result = $data->fetch_assoc()){
										?>
										<tr id="row_1" class="">
											<td style="display:none"><font size="2"><?php echo $no-1 ?>
											<input type="text" value="<?php echo $result['kd_jasa']; ?>" name="SOD[<?php echo $no-1 ?>][hidden_kd_jasa]">
											<input type="text" id="holo<?php echo $no-1 ?>" class="" value="<?php echo $no-1 ?>" name="SOD[<?php echo $no-1 ?>][nomor]">
											
											</td>
											<td><font size="2"><input type="text" value="<?php echo $result['kerusakan']; ?>" name="SOD[<?php echo $no-1 ?>][]"></td>
											<td><font size="2"><input class="hrg_jasa" id="harga_jasa<?php echo $no-1 ?>" type="text" value="<?php echo $result['jumlah']; ?>" name="SOD[<?php echo $no-1 ?>][hidden_harga_jasa]"></td>
											<td style="display:none"><font size="2"><input type="text" value="<?php echo $result['servisdetail_id']; ?>" name="SOD[<?php echo $no-1 ?>][hidden_id]"></td>
											<td><button type="button" class="btn btn-danger btn-xs remove_details" id="<?php echo $no-1 ?>">Remove</button></td>
											<td class="nomor" style="display:none"><font size="2"><?php echo $no-1 ?></td>
										</tr>
										

										 <?php
									$no++;
									}
									$data->close();
									$conn->close();
									?>
									</tbody>
								</table>
								<!-- ================== servis detail ================== -->
								<input type="hidden" name="nomor_array" id="nomor_array">
								<div class="form-group">
									<label class="col-sm-3 control-label">&nbsp;</label>
									<div class="col-sm-6">
										<input type="submit" name="update2" class="btn btn-sm btn-info" value="ubah">
										<a href="transaksi.php" class="btn btn-sm btn-danger"><b>Batal</b></a>
									</div>
								</div>
							</form><br>

							<div class="modal fade" id="modal-id">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true">&times;</button>
											<h4 class="modal-title">Modal title</h4>
										</div>
										<div class="modal-body">

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default"
												data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>





			</div>
			<!--/fluid-row-->

		</div>
		<!--/span-->

	</div>
	<!--/row-->





	<div class="clearfix"></div>

	<?php include 'footer.php';?>

	<!-- start: JavaScript-->


</body>

</html>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {

		$('#add').click(function () {
			$('#user_dialog').dialog('option', 'title', 'Add Data');
			$('#nama_jasa').val('');
			$('#harga_jasa').val('');	
			$('#kd_jasa').val('');			
			$('#save').text('Save');
			$('#user_dialog').dialog('open');
		});

		$('#user_dialog').dialog({
			autoOpen:false,
			width:400
		});

		$('#save').click(function(){
			var count = $(".remove_details").length;	
			var nama_jasa = $('#nama_jasa').val();
			var harga_jasa = $('#harga_jasa').val();
			var kd_jasa = $('#kd_jasa').val();
			if($('#save').text() == 'Save'){
				count = count + 1;
				var output_hidden = 0;
				output = '<tr id="row_'+count+'">';
				output += '<td>'+nama_jasa+' <input type="hidden"  id="nama_jasa'+count+'" class="nama_jasa" value="'+nama_jasa+'" /><input type="hidden" name="SOD['+count+'][hidden_kd_jasa]" id="kd_jasa'+count+'" value="'+kd_jasa+'" /></td>';
				output += '<td>'+harga_jasa+' <input type="hidden" class="hrg_jasa" name="SOD['+count+'][hidden_harga_jasa]" id="harga_jasa'+count+'" value="'+harga_jasa+'" /></td>';
				output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="'+count+'">Remove</button></td>';
				output += '</tr>';
				$('#user_data').append(output);
			}
			$('#user_dialog').dialog('close');
			calcLineTotal();
 		});

		 $('#action_alert').dialog({
			autoOpen:false
		});

		$('#nama_jasa').on('input',function(){
			var nama_jasa = $(this).val();
			$.ajax({
				type : "POST",
				url  : "getJasa.php",
				dataType : "JSON",
				data : {nama_jasa : nama_jasa},
				cache:false,
				success: function(data){
					$.each(data,function(kd_jasa, kerusakan, harga){
						$('[name="kd_jasa"]').val(data.kd_jasa);
						$('[name="harga_jasa"]').val(data.harga);
					});
				}
			});
			return false;
		});
		calcLineTotal();
		function calcLineTotal(){
			var a = 0;
			var b = 0;
			
            var el = $(".remove_details").length;
			var nomor = $('tr td.nomor:last').text();
			var tess = $('tr td.nomor:first').text();
			
            // array to string
            for(var i = tess; i <= nomor; i++) {
				a = parseInt($('#harga_jasa'+i+'').val());
				b += (a);
            }
			$("#nomor_array").val(nomor);
			$(".harga_js").val(b);
        };

		$(document).on('click', '.remove_details', function(){
			var row_id = $(this).attr('id');
			var el = $(".remove_details").length;
			// if (row_id == 1){
			// 	row_id = row_id;
			// }else{
			// 	row_id = row_id - 1;
			// }
			
			if(confirm("Are you sure you want to remove this row data?")){
				$('#row_1').remove();
				for(var i = 1; i <= el; i++) {
					a = parseInt($('#holo'+i+'').val());
					// $('#holo'+i+'').val(a - 1);
					// b = $('#harga_jasa'+i+'').attr('id');
					// alert(b);
					// var c = b-1;
					// $('#harga_jasa'+i+'').attr('id', 'harga_jasa'+a+'');
            	}
			}else{
				return false;
			}
			calcLineTotal();
		});

	});
</script>
<script src="../js/jquery-1.9.1.min.js"></script>
<script src="../js/jquery-migrate-1.0.0.min.js"></script>

<script src="../js/jquery-ui-1.10.0.custom.min.js"></script>

<script src="../js/jquery.ui.touch-punch.js"></script>

<script src="../js/modernizr.js"></script>

<script src="../js/bootstrap.min.js"></script>

<script src="../js/jquery.cookie.js"></script>

<script src='../js/fullcalendar.min.js'></script>

<script src='../js/jquery.dataTables.min.js'></script>

<script src="../js/excanvas.js"></script>
<script src="../js/jquery.flot.js"></script>
<script src="../js/jquery.flot.pie.js"></script>
<script src="../js/jquery.flot.stack.js"></script>
<script src="../js/jquery.flot.resize.min.js"></script>

<script src="../js/jquery.chosen.min.js"></script>

<script src="../js/jquery.uniform.min.js"></script>

<script src="../js/jquery.cleditor.min.js"></script>

<script src="../js/jquery.noty.js"></script>

<script src="../js/jquery.elfinder.min.js"></script>

<script src="../js/jquery.raty.min.js"></script>

<script src="../js/jquery.iphone.toggle.js"></script>

<script src="../js/jquery.uploadify-3.1.min.js"></script>

<script src="../js/jquery.gritter.min.js"></script>

<script src="../js/jquery.imagesloaded.js"></script>

<script src="../js/jquery.masonry.min.js"></script>

<script src="../js/jquery.knob.modified.js"></script>

<script src="../js/jquery.sparkline.min.js"></script>

<script src="../js/counter.js"></script>

<script src="../js/retina.js"></script>

<script src="../js/custom.js"></script>
<!-- end: JavaScript-->