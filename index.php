<!DOCTYPE html>
<html>

<head>
    <title>UAS WETON PHP | 2113030041</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    form {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-field {
        margin-bottom: 10px;
    }

    label {
        font-weight: bold;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 3px;
        border: none;
    }

    hr {
        margin-top: 20px;
        margin-bottom: 20px;
        border: 0;
        border-top: 1px solid #ccc;
    }

    div.result {
        text-align: center;
        font-size: 18px;
        margin-bottom: 20px;
    }

    a {
        text-decoration: none;
    }
</style>

<body>
    <form style="text-align:center" action="" method="post" name="cariweton" autocomplete="off">
        <div class="form-field">
            <label>Masukkan Tanggal Lahir Anda: </label>
            <input name="tanggal" required style="width:20%" maxlength="2">
            <select name="bulan" required style="width:30%">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <input name="tahun" required style="width:20%" maxlength="4">
            <button type="submit" name="cari">Cari</button>
        </div>
    </form>

    <?php
    function weton()
    {
        // Dipilih tanggal 1 Januari 1 sebagai acuan
        // Hari pasaran tanggal 1 Januari 1900 adalah 'Senin Pahing'
        $tgl1 = "1900-01-01";

        // Array urutan nama hari pasaran dimulai dari 'Pahing' berdasarkan $tgl1
        $pasaran = array('Pahing', 'Pon', 'Wage', 'Kliwon', 'Legi');

        $hari = array(
            'Sunday' => 'Ahad',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jum\'at',
            'Saturday' => 'Sabtu'
        );

        if (isset($_POST['cari'])) {
            $tanggal = $_POST["tanggal"];
            $bulan = $_POST["bulan"];
            $tahun = $_POST["tahun"];
            $arr = array($tahun, $bulan, $tanggal);
            $tang = implode("-", $arr);
            $nama_hari = date('l', strtotime($tang));

            // Proses mencari selisih hari antara kedua tanggal
            $pecah1 = explode("-", $tgl1);
            $tanggal1 = $pecah1[2];
            $bulan1 = $pecah1[1];
            $tahun1 = $pecah1[0];

            $pecah2 = explode("-", $tang);
            $tanggal2 = $pecah2[2];
            $bulan2 = $pecah2[1];
            $tahun2 =  $pecah2[0];

            $jd1 = GregorianToJD($bulan1, $tanggal1, $tahun1);
            $jd2 = GregorianToJD($bulan2, $tanggal2, $tahun2);

            $selisih = $jd2 - $jd1;

            // Hitung modulo 5 dari selisih harinya
            $mod = $selisih % 5;
            echo '<hr/>
            <div class="result">Weton Kamu
                <strong>' . $hari[$nama_hari] . ' ' . $pasaran[$mod] . '</strong>
            </div>';
        }
    }

    weton();
    ?>
    <a href="./crud_weton.php">Lihat Data</a>
    <p>cek kecocokan disini : <a href="./weton.php">masuk</a></p>
</body>

</html>