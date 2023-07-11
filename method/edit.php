<?php
$con = mysqli_connect("localhost", "root", "", "weton_jodoh");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_o = $_POST['id_o'];
  $nama_o = $_POST['nama_o'];
  $neptu_hari = $_POST['neptu_hari'];
  $neptu_pasaran = $_POST["neptu_pasaran"];

  $query = "UPDATE orang SET nama_o='$nama_o', neptu_hari_id='$neptu_hari', neptu_pasaran_id='$neptu_pasaran' WHERE id_o='$id_o'";
  mysqli_query($con, $query);
  header('Location: ../crud_weton.php');
  exit;
}

$id_o = $_GET['id'];
$sql = "SELECT * FROM orang WHERE id_o = '$id_o'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $nama_o = $row['nama_o'];
    $neptu_hari = $row['neptu_hari_id'];
    $neptu_pasaran = $row['neptu_pasaran_id'];
} else {
    echo "Data tidak ditemukan.";
}

$sql_nh = "SELECT * FROM neptu_hari";
$sql_nh_result = mysqli_query($con, $sql_nh);

$sql_np = "SELECT * FROM neptu_pasaran";
$sql_np_result = mysqli_query($con, $sql_np);

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Orang</title>
</head>

<body>
    <h2>Edit Orang</h2>
    <form method="post" action="">
        <input type="hidden" name="id_o" value="<?php echo $id_o; ?>">
        <label for="nama_o">Nama:</label><br>
        <input type="text" id="nama_o" name="nama_o" value="<?php echo $nama_o; ?>"><br>
        <label for="neptu_hari">Hari Lahir:</label>
        <select name="neptu_hari" id="neptu_hari">
            <?php
            while ($nh_row = mysqli_fetch_assoc($sql_nh_result)) {
                $selected = ($nh_row['id_h'] == $neptu_hari) ? 'selected' : '';
                echo "<option value='{$nh_row['id_h']}' $selected>{$nh_row['id_h']} - {$nh_row['nama_h']}</option>";
            }
            ?>
        </select><br>
        <label for="neptu_pasaran">Pasaran:</label>
        <select name="neptu_pasaran" id="neptu_pasaran">
            <?php
            while ($np_row = mysqli_fetch_assoc($sql_np_result)) {
                $selected = ($np_row['id_p'] == $neptu_pasaran) ? 'selected' : '';
                echo "<option value='{$np_row['id_p']}' $selected>{$np_row['id_p']} - {$np_row['nama_p']}</option>";
            }
            ?>
        </select><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>
