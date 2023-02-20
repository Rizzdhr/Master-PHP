<?php 
        // memanggil function tanggal
        include('function_tgl.php');

        // menghubungkan koneksi ke database
        $koneksi = mysqli_connect('localhost','root','','db_dasis');

        $id = $_GET['id'];
        $query = "SELECT * FROM tbl_siswa WHERE id='$id' ";
        $hasil = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_array($hasil);

        $hobi = explode(",", $data['hobi']);

        $tanggal = Edittgl($data['tgl_lahir']);
        ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Siswa</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
<body>
    <form action="act_update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data ['id']; ?>">
        <input type="hidden" name="nisn_lama" value="<?= $data['nisn']; ?>">
        <label>NISN :</label>
        <input type="text" name="nisn" value="<?= $data ['nisn']; ?>">
        <br><br>
        <label>Nama :</label>
        <input type="text" name="nama" value="<?= $data ['nama']; ?>">
        <br><br>
        <label>Jenkel :</label>

        <?php if ($data['jenkel'] == "L") { ?>
            <input type="radio" name="jenkel" value="L" checked>Laki-laki
            <input type="radio" name="jenkel" value="P">Perempuan
        <?php } else { ?>
            <input type="radio" name="jenkel" value="L">Laki-laki
            <input type="radio" name="jenkel" value="P" checked>Perempuan
        <?php } ?>
        
        <br><br>
        <label>Kelas :</label>
        <select name="kelas" id="">

            <?php  if ($data['kelas'] == 0 ) { ?>
                <option value="0" selected>Pilih Kelas</option>
                <option value="X RPL">X RPL</option>
                <option value="XI RPL">XI RPL</option>
                <option value="XII RPL">XII RPL</option>
            <?php } elseif($data['kelas'] == "X RPL") { ?>
                <option value="X RPL" selected>X RPL</option>
                <option value="XI RPL">XI RPL</option>
                <option value="XII RPL">XII RPL</option>
            <?php } elseif($data['kelas'] == "XI RPL") { ?>
                <option value="X RPL">X RPL</option>
                <option value="XI RPL" selected>XI RPL</option>
                <option value="XII RPL">XII RPL</option>
            <?php } else { ?>
                <option value="X RPL" >X RPL</option>
                <option value="XI RPL">XI RPL</option>
                <option value="XII RPL" selected>XII RPL</option>
            <?php } ?>
        </select>
        <br><br>
        <label>Tanggal Lahir : </label>
        <input type="text" name="tgl_lahir" id="tgl_lahir" value="<?= $tanggal; ?>">
        <br><br>
        <label>Hobi :</label>
        <input type="checkbox" name="hobi[]" value="Ngoding" <?php if(in_array("Ngoding", $hobi)) 
        echo "checked"; ?>>Ngoding <br>
        <input type="checkbox" name="hobi[]" value="Ngobar" <?php if(in_array("Ngobar", $hobi)) 
        echo "checked"; ?>>Ngobar <br>
        <input type="checkbox" name="hobi[]" value="Ngopi" <?php if(in_array("Ngopi", $hobi)) 
        echo "checked"; ?>>Ngopi <br>
        <input type="checkbox" name="hobi[]" value="Turu" <?php if(in_array("Turu", $hobi)) 
        echo "checked"; ?>>Turu
        <br><br>

        <?php if ($data['foto'] == "") { ?>
            <label>Foto Profile : </label>
            <input type="file" name="foto">
        <?php } else { ?>
            <img src="img/<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>" width="100">
            <br><br>
            <label>Foto Profile</label>
            <input type="file" name="foto">
        <?php } ?>
        <br><br>
        <button type="submit">Simpan</button>
    </form>

    <script>
        $( function() {
            $( "#tgl_lahir" ).datepicker({
                dateFormat : "dd/mm/yy",
                dateMonth : true,
                dateYear : true 
            });
        } );
    </script>

</body>
</html>