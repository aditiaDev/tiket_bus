<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cetak tiket</title>
</head>
<body>
 
<div id="container">
	<h3>Tiket</h3>
    <table border="1" style="width:100%;font-size:12px;border: 1px solid #ddd;border-collapse: collapse;">
	  	<tbody>

				<?php foreach($data as $row): ?>
				<tr>
					<td colspan="2"></td>
				</tr>
        <tr>
          <td>Nomor Ticket</td>
          <td><?php echo $row['id_penjualan_tiket']; ?></td>
        </tr>
        <tr>
          <td>Nama Pelanggan</td>
          <td><?php echo $row['nm_pelanggan']; ?></td>
        </tr>

	  		<?php endforeach; ?>
	  	</tbody>

	  </table>
 
</div>
 
</body>
</html>
