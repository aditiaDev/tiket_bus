<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Pembelian</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Pembelian</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
	  	<thead>
	  		<tr>
	  			<th class="short">#</th>
	  			<th class="normal">ID Pembelian</th>
	  			<th class="normal">Tanggal</th>
                <th class="normal">ID Barang</th>
                <th class="normal">Desc</th>
                <th class="normal">Kat. Barang</th>
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
					<td><?php echo $row['id_pembelian']; ?></td>
					<td><?php echo $row['tgl_pembelian']; ?></td>
					<td><?php echo $row['id_barang']; ?></td>
					<td><?php echo $row['nm_barang']; ?></td>
					<td><?php echo $row['kategori_barang']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['harga'],0,',','.'); ?></td>
					<td style="text-align:right;"><?php echo $row['qty_beli']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['subtotal'],0,',','.'); ?></td>
				</tr>
				<?php 
                    $no++;
                    $total = $total+$row['subtotal'];
                ?>
	  		<?php endforeach; ?>
	  	</tbody>
		<tfoot>
            <tr>
                <td colspan="8" style="text-align:center;"><b>Total</b></td>
                <td style="text-align:right;"><?php echo number_format($total,0,',','.'); ?></td>
            </tr>
        </tfoot>
	  </table>
 
</div>
 
</body>
</html>
