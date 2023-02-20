<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>
<body>
    <a href="form_dasis.php">Buat Data</a>
    <br><br>
    <h2>Data Siswa</h2>
    <!-- tabel data yang diambil dari database -->
    <table border="1">
        
        <thead>
            <tr>
                <td>No</td>
                <td>NISN</td>
                <td>Nama</td>
                <td>Jenkel</td>
                <td>Kelas</td>
                <td>Tanggal Lahir</td>
                <td>Hobi</td>
                <td>Foto</td>
                <td>Action</td>
            </tr>
        </thead>
        <!-- syntax php -->
        <?php 
        // function tanggal
        include('function_tgl.php');
        // menghubungkan koneksi ke database
        $koneksi = mysqli_connect('localhost','root','','db_dasis');

        $no = 1;
        $query = "SELECT * FROM tbl_siswa";
        $hasil = mysqli_query($koneksi, $query);
        while ($data = mysqli_fetch_array($hasil)) {
            $tanggal = Tanggalindo($data['tgl_lahir']);
        ?>
        <tbody>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $data['nisn'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['jenkel'] ?></td>
                <td><?= $data['kelas'] ?></td>
                <td><?= $tanggal; ?></td>
                <td><?= $data['hobi'] ?></td>
                <td><img src="img/<?= $data['foto']?>" width="100"></td>
                <td>
                    <a href="form_update.php?id=<?= $data['id']; ?>">Edit</a>
                    <a href="act_delete.php?id=<?= $data['id']; ?>">Hapus</a>
                </td>
            </tr>
        </tbody>
        <?php $no++; 
        } ?>
    </table>
</body>
</html>