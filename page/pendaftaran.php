<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM mahasiswa WHERE nim='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validasi = false; $err = false;
	if ($update) {
		$sql = "UPDATE mahasiswa SET nim='$_POST[nim]', nama='$_POST[nama]', alamat='$_POST[alamat]', jenis_kelamin='$_POST[jenis_kelamin]', nilai='$_POST[nilai]', penghasilan_orang_tua='$_POST[penghasilan_orang_tua]', tanggungan_orang_tua='$_POST[tanggungan_orang_tua]',scan_rapot='$_POST[scan_rapot]', Scan_Slip_Gaji='$_POST[Scan_Slip_Gaji]', Scan_KK='$_POST[Scan_KK]', tahun_mengajukan='$_POST[tahun_mengajukan]' WHERE nim='$_GET[key]'";
	} else {
		$sql = "INSERT INTO mahasiswa VALUES ('$_POST[nim]', '$_POST[nama]', '$_POST[alamat]', '$_POST[jenis_kelamin]', '$_POST[nilai]', 'Pending', '$_POST[penghasilan_orang_tua]', '$_POST[tanggungan_orang_tua]', '$_POST[scan_rapot]', '$_POST[Scan_Slip_Gaji]', '$_POST[Scan_KK]', '$_POST[tahun_mengajukan]')";
		$validasi = true;
	}

	if ($validasi) {
		$q = $connection->query("SELECT nim FROM mahasiswa WHERE nim=$_POST[nim]");
		if ($q->num_rows) {
			echo alert($_POST["nim"]." sudah terdaftar!", "?page=pendaftaran");
			$err = true;
		}
	}

  	if (!$err AND $connection->query($sql)) {
    echo alert("Berhasil!", "?page=pendaftaran");
  } else {
		echo alert("Gagal!", "?page=pendaftaran");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beasiswa</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
	<div class="row">
		 <div class="col-md-4"></div>
            <div class="col-md-4">
	    <div class="panel panel-<?= ($update) ? "warning" : "info" ?>">
	        <div class="panel-heading"><h3 class="text-center"><?= ($update) ? "EDIT" : "TAMBAH" ?></h3></div>
	        <div class="panel-body">
	            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
	                <div class="form-group">
	                    <label for="nim">NIS</label>
	                    <input type="text" name="nim" class="form-control" <?= (!$update) ?: 'value="'.$row["nim"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="nama">Nama Lengkap</label>
	                    <input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="alamat">Alamat</label>
	                    <input type="text" name="alamat" class="form-control" <?= (!$update) ?: 'value="'.$row["alamat"].'"' ?>>
	                </div>
									<div class="form-group">
	                  <label for="jenis_kelamin">Jenis Kelamin</label>
										<select class="form-control" name="jenis_kelamin">
											<option>---</option>
											<option value="Laki-laki" <?= (!$update) ?: (($row["jenis_kelamin"] != "Laki-laki") ?: 'selected="on"') ?>>Laki-laki</option>
											<option value="Perempuan" <?= (!$update) ?: (($row["jenis_kelamin"] != "Perempuan") ?: 'selected="on"') ?>>Perempuan</option>
										</select>
									</div>
									<div class="form-group">
	                    <label for="nilai">Nilai Rata Rata</label>
	                    <input type="text" name="nilai" class="form-control" <?= (!$update) ?: 'value="'.$row["nilai"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="penghasilan_orang_tua">Penghasilan Orang Tua</label>
	                    <input type="text" name="penghasilan_orang_tua" class="form-control" <?= (!$update) ?: 'value="'.$row["penghasilan_orang_tua"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="tanggungan_orang_tua">Tanggungan Orang Tua</label>
	                    <input type="text" name="tanggungan_orang_tua" class="form-control" <?= (!$update) ?: 'value="'.$row["tanggungan_orang_tua"].'"' ?>>
	                </div>
	                <div class="form-group">
                		<label for="scan_rapot">Scan Rapot :</label>
                		<input type="file" accept="image/*" name="scan_rapot" class="form-control" <?= (!$update) ?: 'value="'.$row["scan_rapot"].'"' ?>>
            		</div>
            		<div class="form-group">
               	 		<label for="Scan_Slip_Gaji">Scan Slip Gaji :</label>
                		<input type="file" accept="image/*" name="Scan_Slip_Gaji" class="form-control" <?= (!$update) ?: 'value="'.$row["Scan_Slip_Gaji"].'"' ?>>
            		</div>
            		<div class="form-group">
                		<label for="Scan_KK">Scan KK :</label>
                		<input type="file" accept="image/*" name="Scan_KK" class="form-control" <?= (!$update) ?: 'value="'.$row["Scan_KK"].'"' ?>>
            		</div>
	                <div class="form-group">
	                    <label for="tahun_mengajukan">Tahun</label>
	                    <input type="text" name="tahun_mengajukan" class="form-control" <?= (!$update) ?: 'value="'.$row["tahun_mengajukan"].'"' ?>>
	                </div>
	                <button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
	                <?php if ($update): ?>
										<a href="login.php" class="btn btn-info btn-block">Batal</a>
									<?php endif; ?>
	            </form>
	        </div>
	    </div>
	</div>
	</div>
</div>
</body>
</html>

