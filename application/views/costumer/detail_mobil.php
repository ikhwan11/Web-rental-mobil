<div class="container mb-5 mt-5">
	
	<div class="card" style="margin-top: 200px;">
		<div class="card-body">

			<?php foreach($detail as $dt) : ?>
				
				<h1><?php echo $dt->merk ?></h1>
				<div class="row">

					<div class="col-md-6">

						<img style="width: 90%" src="<?php echo base_url('assets/upload/'.$dt->gambar) ?>">
					</div>	
					<div class="col-md-6">
						<table class="table">
							<tr>
								<th>No. Plat</th>
								<td><?php echo $dt->no_plat ?></td>
							</tr>
							<tr>
								<th>Warna</th>
								<td><?php echo $dt->warna ?></td>
							</tr>
							<tr>
								<th>Tahun Produksi</th>
								<td><?php echo $dt->tahun ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
									<?php 
										if($dt->status == "1"){
											echo "Tersedia";
										}else{
											echo "Telah di rental";
										}

								 	?>
								 	
								 </td>
								 </tr>

								<tr>
								 <td></td>
								 <td>
								 	 <?php 
					                  if($dt->status == "0"){
					                    echo "<span class= 'btn btn-danger' disable> Telah Disewa </span>";
					                  }else{
					                    echo anchor('costumer/rental/tambah_rental'. $dt->id_mobil, '<button class="btn btn-success">Rental</button>');
					                  }
					                 ?>
								 </td>
								</tr>

						</table>
					</div>	
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>