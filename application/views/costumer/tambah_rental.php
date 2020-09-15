<div class="container">
	<div class="card" style="margin-top:200px; margin-bottom:50px;">
		<div class="card-header">
			Form Pengajuan Rental Mobil
		</div>

		<div class="card-body">
			<?php foreach($detail as $dt) : ?>
				<form method="POST" action="<?php echo base_url('costumer/rental/tambah_rental_aksi') ?>">
					
					<div class="form-group">
						<label>Harga sewa/Hari</label>
						<input type="hidden" name="id_mobil" value="<?php echo $dt->id_mobil ?>">
						<input type="text" name="harga" class="form-control" value="<?php echo $dt->harga ?>" readonly>
					</div>
					<div class="form-group">
						<label>Denda/Hari</label>
						<input type="text" name="denda" class="form-control" value="<?php echo $dt->denda ?>" readonly>
					</div>
					<div class="form-group">
						<label>Tanggal Rental</label>
						<input type="date" name="tanggal_rental" class="form-control">
					</div>
					<div class="form-group">
						<label>Tanggal Kembali</label>
						<input type="date" name="tanggal_kembali" class="form-control" >
					</div>

					<button type="submit" class="btn btn-warning">Rental Mobil ini</button>


				</form>

			<?php endforeach; ?>
		</div>
	</div>
</div>