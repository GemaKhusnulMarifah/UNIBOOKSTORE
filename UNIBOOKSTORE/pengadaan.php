<?php
include 'db.php'; // Include database connection

// Include the header
include('header.php');

// Set a threshold for low stock
$low_stock_threshold = 10;

// Fetch books that need to be purchased (low stock)
$sql = "SELECT b.nama_buku, p.nama AS nama_penerbit, b.stok 
        FROM buku b 
        JOIN penerbit p ON b.id_penerbit = p.id_penerbit 
        WHERE b.stok < $low_stock_threshold";
$result = $connection->query($sql);
?>

<link rel="stylesheet" type="text/css" href="css/pengadaan.css"> <!-- Link to CSS -->

<main>
    <h1>Laporan Kebutuhan Buku</h1>
    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Nama Penerbit</th>
                <th>Stok Tersisa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['nama_buku']) . "</td>
                            <td>" . htmlspecialchars($row['nama_penerbit']) . "</td>
                            <td>" . htmlspecialchars($row['stok']) . "</td>
                            </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada buku yang perlu dibeli.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<!-- Include the footer -->
<?php include('footer.php'); ?>