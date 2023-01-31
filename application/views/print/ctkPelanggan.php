<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Pelanggan</title>
</head>
<body>
 
<div id="container">
	<h3>Laporan Pelanggan</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
		<thead>
	  		<tr>
	  			<th class="short">#</th>
	  			<th class="normal">ID Pelanggan</th>
	  			<th class="normal">Nama Pelanggan</th>
                <th class="normal">No Telphone</th>
                <th class="normal">Alamat</th>
	  		</tr>
	  	</thead>
	  	<tbody>
		  	<?php $no=1;$total=0; ?>
				<?php foreach($data as $row): ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['id_pelanggan']; ?></td>
					<td><?php echo $row['nm_pelanggan']; ?></td>
					<td><?php echo $row['no_pelanggan']; ?></td>
					<td><?php echo $row['alamat_pelanggan']; ?></td>
				</tr>
	  		<?php endforeach; ?>
	  	</tbody>
	  </table>
 
</div>
 
</body>
</html>
