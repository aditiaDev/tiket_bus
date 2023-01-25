<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Penjualan</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
	  	<thead>
	  		<tr>
	  			<th class="short">#</th>
	  			<th class="normal">ID Penjualan</th>
	  			<th class="normal">Tanggal</th>
	  			<th class="normal">No Nota</th>
                <th class="normal">ID Barang</th>
                <th class="normal">Desc</th>
                <th class="normal">Kat. Barang</th>
				<th class="normal">Harga Beli</th>
                <th class="normal">Harga Jual</th>
                <th class="normal">Jumlah</th>
				<th class="normal">Total</th>
				<th class="normal">Laba/Rugi</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  		<?php 
			  		$no=1;
					$total=0;
					$total_laba=0;
					foreach($data as $row): 
					$laba = ($row['harga']-$row['harga_beli'])*$row['jumlah'];
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['id_penjualan']; ?></td>
					<td><?php echo $row['tgl_jual']; ?></td>
					<td><?php echo $row['no_nota']; ?></td>
					<td><?php echo $row['id_barang']; ?></td>
					<td><?php echo $row['nm_barang']; ?></td>
					<td><?php echo $row['kategori_barang']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
					<td style="text-align:right;"><?php echo number_format($row['harga'],0,',','.'); ?></td>
					<td style="text-align:right;"><?php echo $row['jumlah']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['subtotal'],0,',','.'); ?></td>
					<td style="text-align:right;"><?php echo number_format($laba,0,',','.'); ?></td>
				</tr>
				<?php 
                    $no++;
                    $total = $total+$row['subtotal'];
					$total_laba = $total_laba+$laba;
                ?>
	  		<?php endforeach; ?>
	  	</tbody>
		<tfoot>
            <tr>
                <td colspan="10" style="text-align:center;"><b>Balance</b></td>
                <td style="text-align:right;"><?php echo number_format($total,0,',','.'); ?></td>
				<td style="text-align:right;"><?php echo number_format($total_laba,0,',','.'); ?></td>
            </tr>
        </tfoot>
	  </table>
 
</div>
 
</body>
</html>
