<?php
// Include the database connection
include('db.php');

// Include the header
include('header.php');

// Check if the id_buku is set in the URL
if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Fetch the book data for the given id_buku
    $sql = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
    $result = $connection->query($sql);
    $book = $result->fetch_assoc();

    // Handle form submission for updating the book
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get updated data from the form
        $kategori = $_POST['kategori'];
        $nama_buku = $_POST['nama_buku'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $id_penerbit = $_POST['id_penerbit'];

        // Server-side validation
        if ($harga < 0) {
            echo "<script>alert('Harga tidak boleh negatif.');</script>";
        } elseif ($stok < 0) {
            echo "<script>alert('Stok tidak boleh negatif.');</script>";
        } else {
            // Update the book in the database if validation passes
            $update_sql = "UPDATE buku SET 
                kategori = '$kategori', 
                nama_buku = '$nama_buku', 
                harga = '$harga', 
                stok = '$stok', 
                id_penerbit = '$id_penerbit' 
                WHERE id_buku = '$id_buku'";

            if ($connection->query($update_sql) === TRUE) {
                echo "<script>alert('Buku berhasil diperbarui!'); window.location.href='admin.php';</script>";
            } else {
                echo "<script>alert('Error: " . $connection->error . "');</script>";
            }
        }
    }
} else {
    echo "<script>alert('ID Buku tidak valid.'); window.location.href='admin.php';</script>";
}
?>

<link rel="stylesheet" type="text/css" href="css/edit.css"> <!-- Link to CSS -->

<main>
    <h1>Edit Buku</h1>
    <form action="" method="POST">
        <label for="id_buku">ID Buku:</label>
        <input type="text" name="id_buku" value="<?php echo htmlspecialchars($book['id_buku']); ?>" readonly>

        <label for="kategori">Kategori:</label>
        <input type="text" name="kategori" value="<?php echo htmlspecialchars($book['kategori']); ?>" required>

        <label for="nama_buku">Nama Buku:</label>
        <input type="text" name="nama_buku" value="<?php echo htmlspecialchars($book['nama_buku']); ?>" required>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" min="0" value="<?php echo htmlspecialchars($book['harga']); ?>" required>

        <label for="stok">Stok:</label>
        <input type="number" name="stok" min="0" value="<?php echo htmlspecialchars($book['stok']); ?>" required>

        <label for="id_penerbit">ID Penerbit:</label>
        <input type="text" name="id_penerbit" value="<?php echo htmlspecialchars($book['id_penerbit']); ?>" required>

        <button type="submit">Perbarui Buku</button>
    </form>
</main>

<!-- Include the footer -->
<?php include('footer.php'); ?>