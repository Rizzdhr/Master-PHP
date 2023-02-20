<?php 
// menghubungkan koneksi ke database
$koneksi = mysqli_connect('localhost','root','','db_dasis');

$id = $_GET ['id'];
// untuk menghapus file gambar dari folder img
$cekGambar = "SELECT * FROM tbl_siswa WHERE id='$id'";
$ada = mysqli_query($koneksi, $cekGambar);
$data = mysqli_fetch_array($ada);
$fotoLama = $data['foto'];
unlink("img/$fotoLama");

// query delete
$query = "DELETE FROM tbl_siswa WHERE id='$id'";
$hasil = mysqli_query($koneksi, $query);

if ($hasil) {
    echo "<script>
        alert('Hapus data berhasil!');
        window.location='read.php';
    </script>";
} else {
    echo "<script>
        alert('Hapus data gagal');
        window.location='read.php';
    </script>";
}
