<div class="container mt-5 md-5">
	<div class="row">
		<div class="col-md-8">
			<div class="card" style="margin-top: 70px">
				<div class="card-header alert alert-success">
					Invoice Pembayaran Anda
				</div>
				<div class="card-body">
					<table class="table">
						<?php foreach($transaksi as $tr) : ?>
							<tr>
								<th>Merk Mobil</th>
								<td>:</td>
								<td><?php echo $tr->merk ?></td>
							</tr>

							<tr>
								<th>Tanggal Rental</th>
								<td>:</td>
								<td><?php echo $tr->tanggal_rental ?></td>
							</tr>

							<tr>
								<th>Tanggal Kembali</th>
								<td>:</td>
								<td><?php echo $tr->tanggal_kembali ?></td>
							</tr>

							<tr>
								<th>Harga Sewa/Hari</th>
								<td>:</td>
								<td><?php echo number_format($tr->harga,0,',','.')  ?></td>
							</tr>

							<tr>
								<?php 
									$tgl_kem = strtotime($tr->tanggal_kembali);
									$tgl_ren = strtotime($tr->tanggal_rental);
									$lama_sewa = abs(($tgl_kem-$tgl_ren)/(60*60*24));
								 ?>
								<th>Lama Sewa</th>
								<td>:</td>
								<td><?php echo $lama_sewa ?> Hari</td>
							</tr>

							<tr class="text-success">
								<th>Total Pembayaran</th>
								<td>:</td>
								<td>Rp.<?php echo number_format($tr->harga * $lama_sewa,0,',','.')  ?></td>
							</tr>

							<tr>
								<td></td>
								<td></td>
								<td>
									<a href="<?php echo base_url('costumer/transaksi/cetak_invoice/'.$tr->id_rental) ?>" class="btn btn-sm btn-secondary">Print Invoice</a>
								</td>

							</tr>


						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card " style="margin-top: 70px">
			<div class="card-header alert alert-primary" >
				Informasi Pembayaran 
			</div>
			<div class="card-body text-success">
				<p>Silakan Melakukan Pembayaran ke No. rekening di bawah ini</p><br>
				<p>43243144 --- BNI</p>

				<?php 
					if(empty($tr->bukti_pembayaran)) {
				 ?>
					 <button style="width:100%" type="button" class="btn btn-danger btn-sm mt-3" data-toggle="modal" data-target="#exampleModal">
						 Upload Bukti Pembayaran
					</button>
				<?php }elseif($tr->status_pembayaran == "0"){ ?>
						<button style="width:100%" class="btn btn-sm btn-warning mt-3"><i class="fa fa-clock-o"></i>  Menunggu Konfirmasi</button>

				<?php }elseif($tr->status_pembayaran == "1") { ?>
						<button style="width:100%" class="btn btn-sm btn-success mt-3"><i class="fa fa-check"></i>  Pembayaran Selesai </button>
				<?php } ?>
			</div>
		</div>
		</div>	
	</div>
</div>

<!-- Modal upload bukti pembayaran -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran Anda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url('costumer/transaksi/pembayaran_aksi') ?>" enctype="multipart/form-data">
	      <div class="modal-body">
	        <div class="form-group">
	        	<label>Upload Bukti Pemnbayaran</label>
	        	<input type="hidden" name="id_rental" class="form-control" value="<?php echo $tr->id_rental ?>">
	        	<input type="file" name="bukti_pembayaran" class="form-control">
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-success btn-sm">Upload</button>
	      </div>
       </form>
    </div>
  </div>
</div>