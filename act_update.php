<?php 
// memanggil function tgl
include ('function_tgl.php');

// menghubungkan koneksi ke database
$koneksi = mysqli_connect('localhost','root','','db_dasis');

$id = $_POST['id'];
$nisn = $_POST['nisn'];
$nisn_lama = $_POST['nisn_lama'];
$nama = $_POST['nama'];
$jenkel = $_POST['jenkel'];
$kelas = $_POST['kelas'];
$tgl_lahir = $_POST['tgl_lahir'];
// mengkonversi ke database
$tanggalLahir = inputtgl($tgl_lahir);
$hobi = implode(",", $_POST['hobi']);

$allowed = array('png','jpg','jpeg');
$lokasi_file = $_FILES['foto']['tmp_name'];
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

// tentukan folder gambar
$folder = "img/$filename";

// validasi nisn 
$query = "SELECT nisn FROM tbl_siswa WHERE nisn='$nisn' and not nisn='$nisn_lama' ";
$ada = mysqli_query($koneksi, $query);

if (mysqli_num_rows($ada) > 0) {
    echo "<script>
        alert('Error! NISN sudah terdaftar!');
        history.go(-1);
        </script>";
} else {
    // jika tidak memilih atau memasukkan gambar (gambar kosong)
if($filename == ""){
    // echo"Nisn : $nisn <br>
    //     Nama : $nama <br>
    //     Jenkel : $jenkel <br>
    //     Kelas : $kelas <br>
    //     Hobi : <br>";

    // foreach ($hobi as $index){
    //     echo "- $index <br>";
    // }


    // query insert data
    // $query = "INSERT INTO tbl_siswa(nisn,nama,jenkel,kelas,hobi,foto) VALUES('$nisn','$nama','$jenkel',
    // '$kelas','$hobi','$filename')";
    // mysqli_query($koneksi, $query);
    // echo "<script>
    //         alert('Simpan data berhasil!');
    //         window.location='read.php';
    //     </script>";

    // query update data
    $query = "UPDATE tbl_siswa SET nisn='$nisn', nama='$nama', jenkel='$jenkel', kelas='$kelas',
    tgl_lahir='$tanggalLahir', hobi='$hobi' WHERE id='$id' ";
    mysqli_query($koneksi, $query);
    echo "<script>
            alert('Ubah data berhasil!');
            window.location='read.php';
        </script>";
} else {
    // jika memilih gambar (ada gambar)
    // uji gambar apakah sesuai dengan ekstensi yang dipilih
    if(!in_array($ext, $allowed)){
        echo "<script>
                alert('Ekstensi tidak diperbolehkan');
                history.go(-1);
            </script>";
    } else {
        // jika gambar sesuai dengan ekstensi yang dipilih
        move_uploaded_file($lokasi_file, "$folder");
    //     echo"Nisn : $nisn <br>
    //         Nama : $nama <br>
    //         Jenkel : $jenkel <br>
    //         Kelas : $kelas <br>
    //         Hobi : <br>";

    // foreach ($hobi as $index) {
    //     echo "- $index <br>";
    // }

    //     echo"<img src ='img/$filename' width='250'>";

    // query insert data
        // $query = "INSERT INTO tbl_siswa(nisn,nama,jenkel,kelas,hobi,foto) VALUES('$nisn','$nama','$jenkel',
        // '$kelas','$hobi','$filename')";
        // mysqli_query($koneksi, $query);
        // echo "<script>
        //         alert('Simpan data berhasil!');
        //         window.location='read.php';
        //     </script>";

        // untuk hapus file gambar dan menggantikan dengan filde gambar baru yang akan diubah
        $cekgambar = "SELECT * FROM tbl_siswa WHERE id='$id'";
        $ada = mysqli_query($koneksi, $cekgambar);
        $data = mysqli_fetch_array($ada);
        $fotolama = $data['foto'];
        unlink("img/$fotolama");

        // query update data
        $query = "UPDATE tbl_siswa SET nisn='$nisn', nama='$nama', jenkel='$jenkel', kelas='$kelas',
        tgl_lahir='$tanggalLahir', hobi='$hobi', foto='$filename' WHERE id='$id' ";
        mysqli_query($koneksi, $query);
        echo "<script>
            alert('Ubah data berhasil!');
            window.location='read.php';
            </script>";
    }
}

}

