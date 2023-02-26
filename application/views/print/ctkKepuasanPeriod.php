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
				<th>NO Bus</th>
				<th>Kategori</th>
				<th>Tgl Keberangkatan</th>
				<th>Pemberangkatan</th>
				<th>Tujuan</th>
				<th>Penumpang</th>
				<th>Nilai Kepuasan (dari 100%)</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['no_pol']; ?></td>
					<td><?php echo $row['id_kategori']; ?></td>
					<td><?php echo $row['tgl_keberangkatan']; ?></td>
					<td><?php echo $row['kota_keberangkatan']; ?></td>
					<td><?php echo $row['tujuan']; ?></td>
                    <td><?php echo $row['jumlah_pelanggan']; ?></td>
					<td style="text-align:right;"><?php echo number_format($row['nilai_kepuasan']); ?></td>
				</tr>
				<?php 
                    $no++;
                ?>
	  		<?php endforeach; ?>
	  	</tbody>
	  </table>
 
</div>
 
</body>
</html>
