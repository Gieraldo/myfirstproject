<?php
include '../aksi/halau.php';
include '../config/koneksi.php';

//PERINTAH UNTUK MENGEDIT DATA BERDASARKAN ID DATA
if (isset($_GET['no_servis'])) {
	$data = $conn->prepare("SELECT * FROM transaksi_servis WHERE no_servis = ? ");
	$no_servis = $_GET['no_servis'];
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
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
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
	<link rel="shortcut icon" href="../img/favicon.ico">
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
									<li><a href="transaksi.php">Data Transaksi2</a></li>
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


					    <div class="clearfix">
                            <button class="width-35 pull-right btn btn-sm btn-primary" onclick="location.href='tambahtransaksi.php'">
                                <i class="ace-icon fa fa-add"></i>
                                <span class="bigger-110">Tambah Data</span>
                                
                            </button>
                    	</div>

		<div class="row-fluid sortable">		
				<div class="box span">
				  	<div class="modal fade" id="modal-id">
				  		<div class="modal-dialog">
				  			<div class="modal-content">
				  				<div class="modal-header">
				  					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  					<h4 class="modal-title">Modal title</h4>
				  				</div>
				  				<div class="modal-body">
				  					
				  				</div>
				  				<div class="modal-footer">
				  					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  					<button type="button" class="btn btn-primary">Save changes</button>
				  				</div>
				  			</div>
				  		</div>
				  	</div>

			    </div>
			  </div>
	
			  <div class="row-fluid sortable">
					<div class="box span12">
						<div class="box-header">
							<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Table Data2 </h2>
							<div class="box-icon">
								<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
								<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
							</div>
						</div>
						<div class="box-content">
							
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
						    <thead>
						      <tr>
						        <th><font size="2">Id Konsumen</th>
						        <th><font size="2">Id Teknisi</th>
						        <th><font size="2">Id Jasa</th>
						        <th><font size="2">No Servis</th>
						        <th><font size="2">Tanggal Servis</th>
						        <th><font size="2">Nama Barang</th>
						        <th><font size="2">Kerusakan</th>
						        <th><font size="2">Qty</th>
						        <th><font size="2">Opsi</th>
						      </tr>
						    </thead>
						    <tbody>
						    <?php
						    include '../config/koneksi.php';

						    $no_servis = 1;
						    $data = $conn->query("SELECT * FROM transaksi_servis ORDER BY no_servis desc");

						    
						    while ($result = $data->fetch_assoc()){
						    	?>
						      <tr>
						        <td><font size="2"><?php echo $result ['id_konsumen']; ?></td>
						        <td><font size="2"><?php echo $result ['id_teknisi'] ; ?></td>
						        <td><font size="2"><?php echo $result ['id_jasa'] ; ?></td>
						        <td><font size="2"><?php echo $result ['no_servis'] ; ?></td>
						        <td><font size="2"><?php echo $result ['tanggal'] ; ?></td>
						        <td><font size="2"><?php echo $result ['nm_barang'] ; ?></td>
						        <td><font size="2"><?php echo $result ['kerusakan'] ; ?></td>
						        <td><font size="2"><?php echo $result ['qty'] ; ?></td>
			
							    <td class="center">                                   
									
									<a class="btn btn-info" href="edit_transaksi.php?no=<?php echo $result ['no'] ; ?>" title="Edit Data">
										<i class="halflings-icon white edit"></i></a> 

									<a class="btn btn-print" href="nota.php?no=<?php echo $result ['no'] ; ?>" title="Print" target="_blank">
										<i class="halflings-icon white print"></i></a>                                          
										
									
								</td>
						        
						      </tr>
						      <?php
						      $no_servis++;
						      }
						      $data->close();
						      $conn->close();
						      ?>
						    </tbody>
			 		      </table>
						</div>
					</div><!--/span-->
				</div><!--/fluid-row-->
					
				
	<div class="clearfix"></div>
	
	<?php include 'footer.php';?>
	
	<!-- start: JavaScript-->

	
</body>
</html>

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