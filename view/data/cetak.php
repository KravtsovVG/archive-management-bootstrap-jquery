<?php
session_start();
include ('../../inc/conf.php'); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="en">
	<head>
		<title>IT Service Catalog</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php
		$id_sub = $_GET['param'];
		echo "<img style='background: #fff;' src='../img/bukuLogin.png' width='200px'>";
		echo ucwords("<h2>Data dokumen pada kategori " . $_GET['k'] . " dengan subkategori " . $_GET['s'] . "</h2>");
		?>
		<table width="850px" cellpadding="5" cellspacing="0" border="1">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th width="15%">Judul</th>
				<th width="20%">Nama Dokumen</th>
				<th width="20%">Nama File</th>
				<th width="5%">Type</th>
				<th width="20%">Deskripsi</th>
				<th width="15%">Lokasi Fisik</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			if(!$query = mysql_query("SELECT * FROM master_data WHERE id= " . $id_sub . " ORDER BY id ASC")){
				die(mysql_error());
			};
			while($data = mysql_fetch_array($query)){
				if(!$filedetail = mysql_query("SELECT * FROM document_detail dd NATURAL JOIN document d WHERE d.id_service_name=".$data['id']." ORDER BY  d.id_doc ASC")){
					die(mysql_error());
				};
				while($detailfile = mysql_fetch_array($filedetail)){
			?>
			<tr>
				<td align="center"><?php echo $i ?></td>
				<td><?php echo $detailfile['nama_doc'] ?></td>
				<td><?php echo $detailfile['nama_doc_detail'] ?></td>
				<td><?php echo substr($detailfile['file'], 0, -4) ?></td>
				<td><?php echo substr($detailfile['file'], -3) ?></td>
				<td><?php echo $detailfile['deskripsi'] ?></td>
				<td><?php echo $detailfile['lokasi_fis'] ?></td>
			</tr>
			<?php
				$i++;
				}
			}
			?>
		</tbody>
		</table>
		<div style="font-size: 12px; position: absolute; bottom: 10px; left: 10px;">hasil cetak dari
		<!-- <script type="text/javascript">document.write(document.URL);</script> -->

		<?php
		$sql="SELECT * FROM root LIMIT 1";     
		$result=mysql_query($sql);     
		$rows=mysql_fetch_array($result);
		?>

		<?php echo $rows['dns_root'] . "cetak/?k=" . $_GET['k'] . "&s=" . $_GET['s'] . "&amp;param=" .  $_GET['param']; ?>
		</div>

			<script type="text/JavaScript">
				setTimeout(print(),0);
			</script>
	</body>
</html>