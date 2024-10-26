<?php
include 'db.php'; // Include database connection

// Include the header
include('header.php');

// Handle form submission for adding a new book
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_book'])) {
    // Get form data for books
    $id_buku = $_POST['id_buku'];
    $kategori = $_POST['kategori'];
    $nama_buku = $_POST['nama_buku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $id_penerbit = $_POST['id_penerbit'];

    // Insert new book into the database
    $sql = "INSERT INTO buku (id_buku, kategori, nama_buku, harga, stok, id_penerbit)
            VALUES ('$id_buku', '$kategori', '$nama_buku', '$harga', '$stok', '$id_penerbit')";

    if ($connection->query($sql) === TRUE) {
        echo "<script>alert('Buku berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Error: " . $connection->error . "');</script>";
    }
}

// Handle form submission for adding a new publisher
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_publisher'])) {
    // Ambil data dari form
    $id_penerbit = $_POST['id_penerbit']; // Pastikan ini diisi dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];

    // Periksa apakah semua variabel terdefinisi dan tidak kosong
    if (!empty($id_penerbit) && !empty($nama) && !empty($alamat) && !empty($kota) && !empty($telepon)) {
        // Lanjutkan dengan query
        $sql = "INSERT INTO penerbit (id_penerbit, nama, alamat, kota, telepon) 
                VALUES ('$id_penerbit', '$nama', '$alamat', '$kota', '$telepon')";
        
        if ($connection->query($sql) === TRUE) {
            echo "<script>alert('Penerbit berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Error: " . $connection->error . "');</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi!');</script>";
    }
}

// Fetch all books for displaying
$sql = "SELECT b.id_buku, b.nama_buku, b.harga, b.stok, p.nama AS penerbit 
        FROM buku b 
        JOIN penerbit p ON b.id_penerbit = p.id_penerbit";
$result = $connection->query($sql);

// Fetch all publishers for displaying
$publishers_sql = "SELECT * FROM penerbit";
$publishers_result = $connection->query($publishers_sql);

if ($publishers_result === FALSE) {
    echo "<script>alert('Error fetching publishers: " . $connection->error . "');</script>";
}

?>

<link rel="stylesheet" type="text/css" href="css/admin.css"> <!-- Link to CSS -->

<main>
    <h1>Admin Panel</h1>

    <h2>Tambah Buku</h2>
    <form action="" method="POST" class="add-book-form">
        <div class="form-row">
            <div class="form-group">
                <label for="id_buku">ID Buku:</label>
                <input type="text" name="id_buku" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" name="harga" min="0" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" name="kategori">
            </div>

            <div class="form-group">
                <label for="stok">Stok:</label>
                <input type="number" name="stok" min="0" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="nama_buku">Nama Buku:</label>
                <input type="text" name="nama_buku" required>
            </div>

            <div class="form-group">
                <label for="id_penerbit">ID Penerbit:</label>
                <select name="id_penerbit" required>
                    <option value="">Pilih Penerbit</option>
                    <?php while ($row = $publishers_result->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['id_penerbit']); ?>">
                            <?php echo htmlspecialchars($row['nama']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <button type="submit" name="add_book">Tambah Buku</button>
    </form>

    <h2>Tambah Penerbit</h2>
    <form action="" method="POST" class="add-publisher-form">
        <div class="form-row">
            <div class="form-group">
                <label for="id_penerbit">ID Penerbit:</label>
                <input type="text" name="id_penerbit" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Penerbit:</label>
                <input type="text" name="nama" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" required>
            </div>

            <div class="form-group">
                <label for="kota">Kota:</label>
                <input type="text" name="kota" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" name="telepon" required>
            </div>
        </div>

        <button type="submit" name="add_publisher">Tambah Penerbit</button>
    </form>

    <h2>Daftar Buku</h2>
    <table>
        <thead>
            <tr>
                <th>ID Buku</th>
                <th>Nama Buku</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penerbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_buku']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_buku']); ?></td>
                        <td><?php echo htmlspecialchars($row['harga']); ?></td>
                        <td><?php echo htmlspecialchars($row['stok']); ?></td>
                        <td><?php echo htmlspecialchars($row['penerbit']); ?></td>
                        <td>
                            <a href="edit.php?id_buku=<?php echo urlencode($row['id_buku']); ?>">Edit</a> |
                            <a href="delete.php?id_buku=<?php echo urlencode($row['id_buku']); ?>" onclick="return confirm('Anda yakin ingin menghapus buku ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada buku yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Daftar Penerbit</h2>
    <table>
        <thead>
            <tr>
                <th>ID Penerbit</th>
                <th>Nama Penerbit</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Telepon</th>
                <th>Aksi</th> <!-- Tambahkan kolom Aksi -->
            </tr>
        </thead>
        <tbody>
        <!--// Reset the result pointer-->
        <?php $publishers_result->data_seek(0); ?>
            <?php if ($publishers_result->num_rows > 0): ?>
                <?php while ($row = $publishers_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_penerbit']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['kota']); ?></td>
                        <td><?php echo htmlspecialchars($row['telepon']); ?></td>
                        <td>
                            <a href="edit.php?id_penerbit=<?php echo urlencode($row['id_penerbit']); ?>">Edit</a> |
                            <a href="delete.php?id_penerbit=<?php echo urlencode($row['id_penerbit']); ?>" onclick="return confirm('Anda yakin ingin menghapus penerbit ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada penerbit yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<!-- Include the footer -->
<?php include('footer.php'); ?>