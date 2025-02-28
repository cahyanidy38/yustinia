<?php
include "koneksi.php"; // Include the database connection

$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 35px;
            padding: 15px;
        }

        .tambahbutton {
            color: #fff;
        }
    </style>
</head>

<body>
    <h2>Daftar Catatan</h2>
    <a class="btn btn-info tambahbutton" href="pages/create.php">Tambah Catatan Baru</a>
    <br><br>
    <table class="table " border="1" cellpadding="8" cellspacing="0">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi Catatan</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                // Looping data dari database
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['isi'] . "</td>";
                    echo "<td>" . date('d-m-Y H:i', strtotime($row['created_at'])) . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-success' href='./pages/edit.php?id'=" . $row['id'] . "'>Edit</a> | ";
                    echo "<a class='btn btn-danger' href='./actions/delete.php?id'="  . $row['id'] . "' onclick='return confirm (\"Apakah anda yakin ingin menghapus catatan ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Belum ada catatan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>