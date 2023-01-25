<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Keuangan</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
		<thead>
	  		<tr>
	  			<th class="short">#</th>
	  			<th class="normal">ID Keuangan</th>
	  			<th class="normal">Tanggal</th>
                <th class="normal">ID Pemasukan/Pengeluaran</th>
                <th class="normal">Tipe Transaksi</th>
				<th class="normal">Keterangan</th>
                <th class="normal">Nominal Transaksi</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['id_jurnal_uang']; ?></td>
					<td><?php echo $row['tgl_input']; ?></td>
					<td><?php echo $row['id_relasi']; ?></td>
					<td><?php echo $row['TIPE_TRANSAKSI']; ?></td>
					<td><?php echo $row['KETERANGAN']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['TRANSAKSI'],0,',','.'); ?></td>
				</tr>
				<?php 
                    $no++;
                    $total = $total+$row['TRANSAKSI'];
                ?>
	  		<?php endforeach; ?>
	  	</tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align:center;"><b>Balance</b></td>
                <td style="text-align:right;"><?php echo number_format($total,0,',','.'); ?></td>
            </tr>
        </tfoot>
	  </table>
 
</div>
 
</body>
</html>
