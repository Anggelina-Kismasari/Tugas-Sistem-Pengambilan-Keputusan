<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Program Metode Fuzzy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Metode Fuzzy PHP">
	<meta name="keywords" content="fuzzy">
	<meta name="author" content="Anggelina Kismasari">

    <style>
		body { font-family:Verdana, Arial; font-size:12px; }
		.text-justify { text-align:center; }	
		.text-right { text-align:right; }	
		.bg1, .bg2, .bg3 { background-color:#CCFFCC; }
		.bg6, .bg7, .bg8 { background-color:#FFFFCC; }
		th, td { padding:.3em .5em; }
		th { background-color:#EEEEEE; }
	</style>
</head>
<body>
    <?php
	$con = mysqli_connect("localhost", "root", "", "fuzzy");

    function cek_selected($cek, $value)	{
		if($cek == $value) {
			echo "selected=\"selected\"";
		}		
	}

    function format_desimal($nn, $des) {
		return number_format($nn, $des, ",", ".");
	}

    function get_namakelompok($id_kelompok, $con)	{
		$hasil = mysqli_query($con, "SELECT * FROM kelompok WHERE id = '$id_kelompok'");
		$row = mysqli_fetch_array($hasil);
		return $row['nama_kelompok'];
	}

    function derajat_keanggotaan($nilai, $bawah, $tengah, $atas) {
		$selisih = $atas - $bawah;	
		
		if($nilai < $bawah) {
			$DA = 0;	
		} elseif (($nilai >= $bawah) && ($nilai <= $tengah)) {
			if($bawah <= 0) {
				$DA = 1;
			} else {
				$DA = ((float)$nilai - (float)$bawah) / ((float)$tengah - (float)$bawah);	
			}
		} elseif (($nilai > $tengah) && ($nilai <= $atas)) {
			$DA = ((float)$atas - (float)$nilai) / ((float)$atas - (float)$tengah);
		} elseif($nilai > $atas) {
			$DA = 0;
		}

		return $DA;	
	}

    $ux[][] = NULL;

    $kelompok = isset($_GET['kelompok']) ? $_GET['kelompok'] : 1;
	$hasil_kelompok	= mysqli_query($con, "SELECT * FROM kelompok WHERE id = '$kelompok'");
	$row_kelompok = mysqli_fetch_array($hasil_kelompok);
    $hasil = mysqli_query($con, "SELECT * FROM kriteria");
	$jumkol = mysqli_num_rows($hasil);
    ?>

    <h2>Jumlah Karbohidrat dan Waktu Tanam Hasil Panen serta Derajat Keanggotaan</h2>
    <table border="1" cellpadding="3" style="border-collapse:collapse;">
        <thead>
            <tr>
				<th width="17" rowspan="2">ID</th>
				<th width="100" rowspan="2">Tanaman</th>
				<th width="28" rowspan="2">Jumlah Karbohidrat</th>
				<th width="37" rowspan="2">Waktu Tanam</th>
				<th width="78" rowspan="2">Harga per Kg</th>
				
				<th colspan="3">(&#956;[x]) <?= get_namakelompok(1, $con);?></th>
				<th colspan="2">(&#956;[x]) <?= get_namakelompok(2, $con);?></th>
				<th colspan="3">(&#956;[x]) <?= get_namakelompok(3, $con);?></th>
			</tr>
            <tr>
				<?php
				$hasil = mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '1'");
				while($row = mysqli_fetch_array($hasil)) {
					echo "<th>" . $row['nama_kriteria'] . "</th>";
				}

				$hasil = mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '2'");
				while($row = mysqli_fetch_array($hasil)) {
					echo "<th>" . $row['nama_kriteria'] ."</th>";
				}

				$hasil = mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '3'");
				while($row = mysqli_fetch_array($hasil)) {
					echo "<th>" . $row['nama_kriteria'] . "</th>";
				}
				?>
			</tr>
        </thead>
        <tbody>
            <?php
			$hasil = mysqli_query($con, "SELECT * FROM panen");
			while($row=mysqli_fetch_array($hasil)) {
			?>
			<tr>
				<td><?= $row['id']; ?></td>
				<td><?= $row['tanaman']; ?></td>
				<td class="text-right"><?= $row['karbohidrat']; ?></td>
				<td class="text-right"><?= $row['waktutanam']; ?></td>
				<td class="text-right"><?= format_desimal($row['harga'], 2); ?></td>
				<?php
				$hasil2	=mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok = '1'");
				while($row2 = mysqli_fetch_array($hasil2)) {
					$u = derajat_keanggotaan($row['karbohidrat'], $row2['bawah'], $row2['tengah'], $row2['atas']);
					$ux[$row['id']][$row2['id']] = $u;
					$bg = "text-right";
					if(isset($_GET['karbohidrat']) && ($row2['id'] == $_GET['karbohidrat'])) {
						$bg .= " bg" . $row2['id'];
					}
					?>	
					<td class="<?= $bg; ?>"><?= format_desimal($u, 2); ?></td>
					<?php
				}
				?>
				<?php
				$hasil2	= mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok='2'");
				while($row2 = mysqli_fetch_array($hasil2)) {
					$u = derajat_keanggotaan($row['waktutanam'], $row2['bawah'], $row2['tengah'], $row2['atas']);
					$ux[$row['id']][$row2['id']] = $u;
					?>
					<td class="text-right"><?= format_desimal($u, 2, ",", "."); ?></td>
					<?php
				}

				$hasil2	= mysqli_query($con, "SELECT * FROM kriteria WHERE kelompok='3'");
				while($row2 = mysqli_fetch_array($hasil2)) {
					$u = derajat_keanggotaan($row['harga'], $row2['bawah'], $row2['tengah'], $row2['atas']);
					$ux[$row['id']][$row2['id']] = $u;
					$bg = "text-right";
					if(isset($_GET['harga']) && ($row2['id'] == $_GET['harga'])) {
						$bg .= " bg" . $row2['id'];
					}
					?>
					<td class="<?= $bg; ?>"><?= format_desimal($u,2); ?></td>
					<?php
				}
				?>
			</tr>
			<?php
			}
			?>
        </tbody>
    </table>

    <br>

    <h2><strong>Derajat Keanggotaan</strong></h2>
    <form action="" method="GET">
		<select name="karbohidrat" required>
			<option value=""></option>
			<option value="1" <?php if(isset($_GET['karbohidrat'])) cek_selected($_GET['karbohidrat'],1); ?>>Karbohidrat rendah</option>
			<option value="2" <?php if(isset($_GET['karbohidrat'])) cek_selected($_GET['karbohidrat'],2); ?>>Karbohidrat sedang</option>
			<option value="3" <?php if(isset($_GET['karbohidrat'])) cek_selected($_GET['karbohidrat'],3); ?>>Karbohidrat tinggi</option>
		</select>
		<select name="operasi">
			<option value="OR" <?php if(isset($_GET['operasi'])) cek_selected($_GET['operasi'],"OR"); ?>>OR</option>
			<option value="AND" <?php if(isset($_GET['operasi'])) cek_selected($_GET['operasi'],"AND"); ?>>AND</option>
		</select>
		<select name="harga" required>
			<option value=""></option>
			<option value="6" <?php if(isset($_GET['harga'])) cek_selected($_GET['harga'],6); ?>>Murah</option>
			<option value="7" <?php if(isset($_GET['harga'])) cek_selected($_GET['harga'],7); ?>>Sedang</option>
			<option value="8" <?php if(isset($_GET['harga'])) cek_selected($_GET['harga'],8); ?>>Mahal</option>
		</select>
		<button type="submit">Submit</button>
	<form>
	<a href="./"><button type="button">Reset</button></a>

    <br><br>

    <h2><strong>Hasil</strong></h2>
	<?php
	if (isset($_GET['operasi'])) {
		$operasi = $_GET['operasi'];
		$karbohidrat = $_GET['karbohidrat'];
		$harga = $_GET['harga'];	
		
		$hasil = mysqli_query($con, "SELECT id,tanaman FROM panen");
		
		while($row = mysqli_fetch_array($hasil)) {	
			$c1 = $ux[$row['id']][$karbohidrat];
			$c2 = $ux[$row['id']][$harga];
			
			if ($operasi == "OR") {
				$cc = max($c1, $c2);
			} else {
				$cc = min($c1, $c2);
			}

			if ($cc > 0) {
				echo $row['tanaman']." : [".format_desimal($cc,2)."]<br>";
			}
		}
	}
	?>

</body>
</html>>