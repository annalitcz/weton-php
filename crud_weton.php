<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD WETON | PHP</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 2rem;
    }

    h2 {
        margin-top: 5rem;
        text-align: center;
    }

    table {
        margin-top: 1rem;
        border-collapse: collapse;
        width: 50%;
        text-align: center;
    }
</style>

<body>
    <h2>CRUD DATABASE WETON JODOH</h2>
    <?php
    $con = mysqli_connect("localhost", "root", "", "weton_jodoh");
    $sql = "SELECT * FROM orang";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) { ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>ID Neptu Hari</th>
                <th>ID Neptu Pasaran</th>
                <th>Aksi</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row["id_o"] ?></td>
                    <td><?php echo $row["nama_o"] ?></td>
                    <td><?php echo $row["neptu_hari_id"] ?></td>
                    <td><?php echo $row["neptu_pasaran_id"] ?></td>
                    <td>
                        <a href='./method/edit.php?id=<?php echo $row["id_o"] ?>'>Edit</a> |
                        <a href='./method/hapus.php?id=<?php echo $row["id_o"] ?>' onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php }
            ?>
        </table>
        <a href="./method/tambah.php">Tambah Data</a>
    <?php } else {
        echo "no result";
    }
    ?>
    <p>cek kecocokan disini : <a href="./weton.php">masuk</a></p>
    
</body>

</html>