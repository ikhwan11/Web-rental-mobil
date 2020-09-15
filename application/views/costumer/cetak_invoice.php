<table style="width:60%;">
	<h2>INVOICE PEMBAYARAN ANDA</h2>

	<?php foreach($transaksi as $tr) : ?>

		<tr>
			<td>Nama Costumer</td>
			<td>:</td>
			<td><?php echo $tr->nama ?></td>
		</tr>
		<tr>
			<td>Merk Mobil</td>
			<td>:</td>
			<td><?php echo $tr->merk ?></td>
		</tr>

		<tr>
			<td>Tanggal Rental</td>
			<td>:</td>
			<td><?php echo $tr->tanggal_rental ?></td>
		</tr>

		<tr>
			<td>Tanggal Kembali</td>
			<td>:</td>
			<td><?php echo $tr->tanggal_kembali ?></td>
		</tr>

		<tr>
			<td>Harga Sewa/Hari</td>
			<td>:</td>
			<td><?php echo number_format($tr->harga,0,',','.')  ?></td>
		</tr>

		<tr>
			<?php 
				$tgl_kem = strtotime($tr->tanggal_kembali);
				$tgl_ren = strtotime($tr->tanggal_rental);
				$lama_sewa = abs(($tgl_kem-$tgl_ren)/(60*60*24));
			 ?>
			<td>Lama Sewa</td>
			<td>:</td>
			<td><?php echo $lama_sewa ?> Hari</td>
		</tr>

		<tr>
			<td>Status Pembayaran</td>
			<td>:</td>
			<td><?php 

			if($tr->status_pembayaran == "0"){
				echo "Belum Lunas";
			}else{
				echo "LUNAS";
			}
			 ?></td>
		</tr>



		<tr style="font-weight: bold;color:red;">
			<td>Total Pembayaran</td>
			<td>:</td>
			<td>Rp.<?php echo number_format($tr->harga * $lama_sewa,0,',','.')  ?></td>
		</tr>

		<tr>
			<td>Rekening Pembayaran</td>
			<td>:</td>
			<td>
				<ul>
					<li>Bank Mandiri 09870985989787</li>
					<li>Bank BNI 98788576767657</li>
					<li>Bank BCA 9844768367</li>
					<li>Bank BRI 5435425364</li>
				</ul>
			</td>
		</tr>


	<?php endforeach; ?>
</table>

<script type="text/javascript">
	
	window.print();

</script>