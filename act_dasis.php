<?php 
// memanggil function tgl
include ('function_tgl.php');
// menghubungkan koneksi ke database
$koneksi = mysqli_connect('localhost','root','','db_dasis');


$nisn = $_POST['nisn'];
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
$query = "SELECT nisn FROM tbl_siswa WHERE nisn='$nisn' ";
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

    $query = "INSERT INTO tbl_siswa(nisn,nama,jenkel,kelas,tgl_lahir,hobi,foto) VALUES('$nisn','$nama','$jenkel',
    '$kelas','$tanggalLahir','$hobi','$filename')";
    mysqli_query($koneksi, $query);
    echo "<script>
            alert('Simpan data berhasil!');
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
        $query = "INSERT INTO tbl_siswa(nisn,nama,jenkel,kelas,tgl_lahir,hobi,foto) VALUES('$nisn','$nama','$jenkel',
        '$kelas','$tanggalLahir','$hobi','$filename')";
        mysqli_query($koneksi, $query);
        echo "<script>
                alert('Simpan data berhasil!');
                window.location='read.php';
            </script>";
    }
}
}


