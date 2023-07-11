<?php
$con = mysqli_connect("localhost", "root", "", "weton_jodoh");

if (isset($_GET["id"])) {
    $id_o = $_GET["id"];

    $sql = "DELETE FROM orang WHERE id_o = '$id_o'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Gagal menghapus data karyawan: " . mysqli_error($con));
    }

    header("Location: ../crud_weton.php");
    exit();
}
?>