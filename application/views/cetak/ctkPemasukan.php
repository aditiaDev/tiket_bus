<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Pemasukan</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Pemasukan</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
		<thead>
	  		<tr>
	  			<th class="short">#</th>
	  			<th class="normal">ID Pemasukan</th>
	  			<th class="normal">Tanggal</th>
                <th class="normal">Tipe Pemasukan</th>
                <th class="normal">ID Penjualan</th>
                <th class="normal">Keterangan</th>
				<th class="normal">Pelanggan</th>
                <th class="normal">Nominal</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['id_pemasukan']; ?></td>
					<td><?php echo $row['tgl_input']; ?></td>
					<td><?php echo $row['tipe_pemasukan']; ?></td>
					<td><?php echo $row['id_relasi']; ?></td>
					<td><?php echo $row['keterangan']; ?></td>
					<td><?php echo $row['nm_pelanggan']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['nominal_masuk'],0,',','.'); ?></td>
				</tr>
				<?php 
                    $no++;
                    $total = $total+$row['nominal_masuk'];
                ?>
	  		<?php endforeach; ?>
	  	</tbody>
		<tfoot>
            <tr>
                <td colspan="7" style="text-align:center;"><b>Total</b></td>
                <td style="text-align:right;"><?php echo number_format($total,0,',','.'); ?></td>
            </tr>
        </tfoot>
	  </table>
 
</div>
 
</body>
</html>
