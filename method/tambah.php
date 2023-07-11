<?php
$con = mysqli_connect("localhost", "root", "", "weton_jodoh");

$sql_nh = "SELECT * FROM neptu_hari";
$sql_nh_result = mysqli_query($con, $sql_nh);

$sql_np = "SELECT * FROM neptu_pasaran";
$sql_np_result = mysqli_query($con, $sql_np);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_org = $_POST["nama_org"];
    $neptu_hari = $_POST["neptu_hari"];
    $neptu_pasaran = $_POST["neptu_pasaran"];

    $sql = "INSERT INTO orang (nama_o, neptu_hari_id, neptu_pasaran_id)
            VALUES ('$nama_org', '$neptu_hari', '$neptu_pasaran')";

    if (mysqli_query($con, $sql)) {
        echo "Data orang berhasil ditambahkan<br>";
        echo "<a href='../crud_weton.php'>Back</a>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Orang</title>
</head>

<body>
    <h2>Tambah Data Orang</h2>
    <form method="POST" action="">
        <label for="nama_org">Nama:</label>
        <input type="text" name="nama_org" required><br>
        <label for="neptu_hari">Hari Lahir:</label>
        <select name="neptu_hari" id="neptu_hari">
            <?php
            while ($nh_row = mysqli_fetch_assoc($sql_nh_result)) {
            ?>
                <option value="<?php echo $nh_row['id_h']; ?>"><?php echo $nh_row['id_h'] . " - " . $nh_row['nama_h']; ?></option>
            <?php } ?>
        </select><br>
        <label for="neptu_pasaran">Pasaran:</label>
        <select name="neptu_pasaran" id="neptu_pasaran">
            <?php
            while ($np_row = mysqli_fetch_assoc($sql_np_result)) {
            ?>
                <option value="<?php echo $np_row['id_p']; ?>"><?php echo $np_row['id_p'] . " - " . $np_row['nama_p']; ?></option>
            <?php } ?>
        </select><br>
        <input type="submit" value="Tambah">
    </form>
</body>

</html>
