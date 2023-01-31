<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Pemesanan</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
	  	<thead>
	  		<tr>
	  			<th class="short">#</th>
	  			<th class="normal">ID Penjualan</th>
	  			<th class="normal">ID Tiket Bus</th>
                <th class="normal">Tujuan</th>
                <th class="normal">Tgl Keberangkatan</th>
                <th class="normal">Pelanggan</th>
                <th class="normal">Tgl Pembelian</th>
                <th class="normal">Jenis Pembelian</th>
                <th class="normal">Harga</th>
                <th class="normal">Jumlah</th>
				<th class="normal">Total</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['id_penjualan_tiket']; ?></td>
					<td><?php echo $row['id_tiket_bus']; ?></td>
					<td><?php echo $row['tujuan']; ?></td>
					<td><?php echo $row['tgl_keberangkatan']; ?></td>
					<td><?php echo $row['nm_pelanggan']; ?></td>
                    <td><?php echo $row['tgl_pembelian']; ?></td>
                    <td><?php echo $row['jenis_penjualan_tiket']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['harga'],0,',','.'); ?></td>
					<td style="text-align:right;"><?php echo $row['jumlah_pembelian']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['nominal'],0,',','.'); ?></td>
				</tr>
				<?php 
                    $no++;
                    $total = $total+$row['nominal'];
                ?>
	  		<?php endforeach; ?>
	  	</tbody>
		<tfoot>
            <tr>
                <td colspan="10" style="text-align:center;"><b>Total</b></td>
                <td style="text-align:right;"><?php echo number_format($total,0,',','.'); ?></td>
            </tr>
        </tfoot>
	  </table>
 
</div>
 
</body>
</html>
