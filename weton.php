<?php
$con = mysqli_connect("localhost", "root", "", "weton_jodoh");
$sql_org = "SELECT * FROM orang";
$result_org = mysqli_query($con, $sql_org);
$result_org2 = mysqli_query($con, $sql_org);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $org1 = $_POST['org1'];
    $org2 = $_POST['org2'];

    $sql_info1 = "SELECT o.nama_o, h.nama_h AS nama_hari, h.nilai_h AS nilai_hari, p.nama_p AS nama_pasaran, p.nilai_p AS nilai_pasaran
                  FROM orang o
                  JOIN neptu_hari h ON o.neptu_hari_id = h.id_h
                  JOIN neptu_pasaran p ON o.neptu_pasaran_id = p.id_p
                  WHERE o.id_o = '$org1'";
    $result_info1 = mysqli_query($con, $sql_info1);
    $info1 = mysqli_fetch_assoc($result_info1);

    $sql_info2 = "SELECT o.nama_o, h.nama_h AS nama_hari, h.nilai_h AS nilai_hari, p.nama_p AS nama_pasaran, p.nilai_p AS nilai_pasaran
                  FROM orang o
                  JOIN neptu_hari h ON o.neptu_hari_id = h.id_h
                  JOIN neptu_pasaran p ON o.neptu_pasaran_id = p.id_p
                  WHERE o.id_o = '$org2'";
    $result_info2 = mysqli_query($con, $sql_info2);
    $info2 = mysqli_fetch_assoc($result_info2);

    $total_neptu1 = $info1['nilai_hari'] + $info1['nilai_pasaran'];
    $total_neptu2 = $info2['nilai_hari'] + $info2['nilai_pasaran'];
    $final_total = $total_neptu1 + $total_neptu2;
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Jodoh | PHP</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }

    h2 {
        text-align: center;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        width: 30%;
    }

    label {
        font-weight: bold;
        text-align: center;
    }

    select,
    input[type="submit"] {
        text-align: center;
        margin-bottom: 10px;
        padding: 5px;
        width: 100%;
        border-radius: 3px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        margin-left: 10rem;
        width: 30%;
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
    }

    .info-container {
        display: flex;
        gap: 1rem;
    }

    .info {
        width: 400px;
        background-color: #fff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .info2 {
        width: 600px;
        background-color: #fff;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    h3 {
        color: #4CAF50;
    }

    h4 {
        text-align: center;
    }

    p {
        margin: 0;
    }
</style>

<body>
    <h2>Cek Kecocokan</h2>
    <form action="" method="post">
        <label for="org1">Orang Pertama</label><br>
        <select name="org1" id="org1">
            <?php
            while ($org_row = mysqli_fetch_assoc($result_org)) {
            ?>
                <option value="<?php echo $org_row['id_o']; ?>"><?php echo $org_row['id_o'] . " - " . $org_row['nama_o']; ?></option>
            <?php } ?>
        </select><br>
        <label for="org2">Orang Kedua</label><br>
        <select name="org2" id="org2">
            <?php
            while ($org_row2 = mysqli_fetch_assoc($result_org2)) {
            ?>
                <option value="<?php echo $org_row2['id_o']; ?>"><?php echo $org_row2['id_o'] . " - " . $org_row2['nama_o']; ?></option>
            <?php } ?>
        </select><br>
        <input type="submit" value="Hitung">
    </form> <br><br>
    <?php if (isset($info1) && isset($info2)) { ?>
        <div class="info-container">
            <div class="info">
                <h4>Informasi Orang Pertama</h4>
                Nama: <?php echo $info1['nama_o']; ?><br>
                Hari Lahir: <?php echo $info1['nama_hari']; ?><br>
                Nilai Neptu Hari: <?php echo $info1['nilai_hari']; ?><br>
                Hari Pasaran: <?php echo $info1['nama_pasaran']; ?><br>
                Nilai Neptu Pasaran: <?php echo $info1['nilai_pasaran']; ?><br>
                Total Neptu: <?php echo $total_neptu1; ?>
            </div>
            <div class="info">
                <h4>Informasi Orang Kedua</h4>
                Nama: <?php echo $info2['nama_o']; ?><br>
                Hari Lahir: <?php echo $info2['nama_hari']; ?><br>
                Nilai Neptu Hari: <?php echo $info2['nilai_hari']; ?><br>
                Hari Pasaran: <?php echo $info2['nama_pasaran']; ?><br>
                Nilai Neptu Pasaran: <?php echo $info2['nilai_pasaran']; ?><br>
                Total Neptu: <?php echo $total_neptu2; ?>
            </div>
        </div>
        <div class="info2">
            Total Neptu Jodoh: <?php echo $final_total ?><br>
            <?php
            switch ($final_total) {
                case 1;
                case 9;
                case 10;
                case 18;
                case 19;
                case 27;
                case 28;
                case 36:
                    echo "<h3>Pegat</h3>";
                    echo "<p>Pegat sendiri menurut primbon Jawa mengindikasikan kemungkinan munculnya berbagai masalah.

                    Masalah yang sering ditemui oleh pasangan pegat di kemudian hari, di antaranya masalah ekonomi, kekuasaan, hingga perselingkuhan. Dikhawatirkan, masalah pada pasangan pegat ini bisa menyebabkan perpisahan atau perceraian.</p>";
                    break;
                case 2;
                case 11;
                case 20;
                case 29:
                    echo "<h3>Ratu</h3>";
                    echo "<p>Untuk pasangan Ratu, dalam kehidupannya di masa mendatang akan selalu dihargai dan disegani tetangga maupun lingkungan sekitar. Ketika berumah tangga, kamu dan pasangan memiliki hubungan yang sangat harmonis, bahagia, dan bahkan membuat iri banyak orang di sekeliling.</p>";
                    break;
                case 3;
                case 12;
                case 21;
                case 30:
                    echo "<h3>Jodoh</h3>";
                    echo "<p>Menurut hitungan weton Jawa, pasangan kategori jodoh ini dikatakan memang sudah jodohnya.

                    Pasangan dalam kategori Jodoh saling menerima segala kelebihan dan kekurangan masing-masing.</p>";
                    break;
                case 4;
                case 13;
                case 22;
                case 31:
                    echo "<h3>Topo</h3>";
                    echo "<p>Dalam membina rumah tangga, pasangan Topo akan sering kesusahan di awal musim. Hal ini biasanya terjadi karena masih berusaha untuk saling memahami.

                    Namun, tak perlu khawatir, sebab pasangan Topo akan bahagia di akhir nanti. Ketika pasangan Topo sudah memiliki anak dan cukup lama berumah tangga, di hari itulah kehidupannya akan menjadi bahagia.</p>";
                    break;
                case 5;
                case 14;
                case 23;
                case 32:
                    echo "<h3>Tinari</h3>";
                    echo "<p>Bagi kamu pasangan Tinari, hasil perhitungan weton ini termasuk kabar bahagia. Bagaimana tidak, kebahagiaan tersebut akan hadir dalam wujud kecukupan rezeki dalam kehidupan berumah tangga kelak, nih!

                    Bahkan, kamu dan keluarga juga akan mendapatkan kemudahan dalam mencari rezeki. Selain mudah mencari rezeki, pasangan Tinari pun sering mendapatkan keberuntungan selama berumah tangga. </p>";
                    break;
                case 6;
                case 15;
                case 24;
                case 33:
                    echo "<h3>Padu</h3>";
                    echo "<p>Pasangan Padu sendiri dalam berumah tangga akan sering mengalami pertengkaran.

                    Namun, nggak perlu khawatir karena pertengkaran yang terjadi tidak berujung pada perceraian, kok. Masalah pertengkaran yang dihadapi pasangan Padu terbilang cukup sepele sehingga sebenarnya bisa selesai dengan kepala dingin.</p>";
                    break;
                case 7;
                case 16;
                case 25;
                case 34:
                    echo "<h3>Sujanan</h3>";
                    echo "<p>Menurut primbon Jawa pasangan dengan kategori Sujanan berada dalam ancaman pertengkaran besar dalam rumah tangga.

                    Masalah yang mereka hadapi bisa saja karena perselingkuhan, baik mulai dari pihak laki-laki maupun perempuan. Dengan begitu, kemungkinan hubungan kamu dan pasangan bisa selesai karena berujung dengan perceraian.</p>";
                    break;
                case 8;
                case 17;
                case 26;
                case 35:
                    echo "<h3>Pesthi</h3>";
                    echo "<p>Berdasarkan perhitungan weton jodoh, pasangan Pesthi konon akan memiliki rumah tangga yang rukun. 

                    Dalam berumah tangga, kamu dan pasangan bisa jadi memiliki kehidupan yang harmonis dan rukun. Meskipun ada masalah, nggak akan merusak keharmonisan keluarga ini.</p>";
                    break;
                default:
                    echo "something wrong";
            }
            ?>
        </div><br>
    <?php } ?>
</body>

</html>