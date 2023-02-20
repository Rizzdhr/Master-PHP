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
    <form action="act_dasis.php" method="post" enctype="multipart/form-data">
        <label>NISN :</label>
        <input type="text" name="nisn">
        <br><br>
        <label>Nama :</label>
        <input type="text" name="nama">
        <br><br>
        <label>Jenkel :</label>
        <input type="radio" name="jenkel" value="L">Laki-laki
        <input type="radio" name="jenkel" value="P">Perempuan
        <br><br>
        <label>Kelas :</label>
        <select name="kelas" id="">
            <option value="0">Pilih Kelas</option>
            <option value="X RPL">X RPL</option>
            <option value="XI RPL">XI RPL</option>
            <option value="XII RPL">XII RPL</option>
        </select>
        <br><br>
        <label>Tanggal Lahir : </label>
        <input type="text" name="tgl_lahir" id="tgl_lahir" autocomplete="off">
        <br><br>
        <label>Hobi :</label>
        <input type="checkbox" name="hobi[]" value="Ngoding">Ngoding <br>
        <input type="checkbox" name="hobi[]" value="Ngobar">Ngobar <br>
        <input type="checkbox" name="hobi[]" value="Ngopi">Ngopi <br>
        <input type="checkbox" name="hobi[]" value="Turu">Turu
        <br><br>
        <label>Foto Profil</label>
        <input type="file" name="foto">
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