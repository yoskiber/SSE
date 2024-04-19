<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'terima') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM mahasiswa WHERE nim='$_GET[key]'");
	$row = $sql->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$validasi = false; $err = false;
	if ($update) {
		$sql = "UPDATE mahasiswa SET status = 'terima' WHERE nim = $_POST[nim]";
		$validasi = true;
	}

	if ($validasi) {
		$q = $connection->query("SELECT nim FROM mahasiswa WHERE nim=$_POST[nim]");
		if ($q->num_rows) {
			echo alert($_POST["nim"]." sudah terdaftar!", "?page=lap_pendaftaran");
			$err = true;
		}
	}

  if (!$err AND $connection->query($sql)) {
    echo alert("Berhasil!", "?page=lap_pendaftaran");
  } else {
		echo alert("Gagal!", "?page=lap_pendaftaran");
  }
}
if (isset($_GET['action']) AND $_GET['action'] == 'terima') {
  $connection->query("UPDATE mahasiswa SET status = 'Diterima' WHERE nim =$_GET[key]");
	echo alert("Berhasil!", "?page=lap_pendaftaran");
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM mahasiswa WHERE nim=$_GET[key]");
	echo alert("Berhasil!", "?page=lap_pendaftaran");
}?>

<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">DAFTAR PENDAFTARAN</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
	                <thead>
	                    <tr>
	                       <th>No</th>
	                        <th>NIS</th>
	                        <th>Nama</th>
	                        <th>Alamat</th>
	                        <th>Jenis Kelamin</th>
	                        <th>Nilai</th>
	                        <th>Status</th>
	                        <th>Penghasilan Orang Tua</th>
	                        <th>Tanggungan Orang Tua</th>
	                        <th>Scan Rapot</th>
	                        <th>Slip Gaji Orang Tua</th>
	                        <th>Scan KK</th>
	                        <th>Tahun</th>
	                        <th>Aksi</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT * FROM mahasiswa WHERE nim IN(SELECT nim FROM mahasiswa)")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
	                        <tr>
	                            <td><?=$no++?></td>
	                            <td><?=$row['nim']?></td>
	                            <td><?=$row['nama']?></td>
	                            <td><?=$row['alamat']?></td>
	                            <td><?=$row['jenis_kelamin']?></td>
	                            <td><?=$row['nilai']?></td>
	                            <td><?=$row['status']?></td>
	                            <td><?=$row['penghasilan_orang_tua']?></td>
	                            <td><?=$row['tanggungan_orang_tua']?></td>
	                            <td align="center"><?php echo "<img src='img/$row[scan_rapot]' width='120' height='140' />";?></td>
	                            <td align="center"><?php echo "<img src='img/$row[Scan_Slip_Gaji]' width='120' height='140' />";?></td>
	                            <td align="center"><?php echo "<img src='img/$row[Scan_KK]' width='120' height='140' />";?></td>
	                            <td><?=$row['tahun_mengajukan']?></td>
	                            <td><!--<a href="" class="btn btn-warning">Edit</a>--> <a href="?page=lap_pendaftaran&action=terima&key=<?=$row['nim']?>" class="btn btn-warning">Accept</a>|<a href="?page=lap_pendaftaran&action=delete&key=<?=$row['nim']?>" class="btn btn-danger btn-xs">Hapus</a></td> 
	                            
	                        </tr>
	                        <?php endwhile ?>
	                    <?php endif ?>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</div>
