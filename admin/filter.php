
					<?php
				//filter.php
				if(isset($_POST["from_date"], $_POST["to_date"]))
				{
				    include '../config/koneksi.php';
					$output = '';
					$query = "
						SELECT * FROM servis_header
						WHERE tgl_terima BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."' 
					";
					$result = mysqli_query($conn, $query);
					$output .= '
					
						<table class="table table-bordered" >
							<tr>
								<th>No Servis</th>
								<th>Nama Konsumen</th>
								<th>Tanggal Terima</th>
								<th>Teknisi</th>
								<th>Jumlah</th>
							</tr>
					';
					if(mysqli_num_rows($result) > 0)
					{
						while($row = mysqli_fetch_array($result))
						{
							$output .= '
								<tr>
									<td>80/DK/'. $row["no_servis"] .'</td>
									<td>'. $row["nm_konsumen"] .'</td>
									<td>'. $row["tgl_terima"] .'</td>
									<td>'. $row["nm_teknisi"] .'</td>
									<td>'. $row["harga"] .'</td>
								</tr>
							';
						}
					}
					else
					{
						$output .= '
							<tr>
								<td colspan="5">No Order Found</td>
							</tr>
						';
					}
					$output .= '</table>';
					echo $output;
				}

				?>
				<div class="nav pull-right">
					<button onClick="window.print();">Print</button>
				</div>
















