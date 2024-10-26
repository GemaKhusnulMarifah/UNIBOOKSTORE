<?php
// Include the database connection
include('db.php');

// Include the header
include('header.php');

?>

<link rel="stylesheet" type="text/css" href="css/index.css"> <!-- Link to CSS -->

<main>
    <!-- Search Books Section -->
    <section class="search-section">
        <h2>Search Books</h2>
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Search by Title" required>
            <button type="submit">🔍</button>
        </form>
    </section>

    <!-- List of Books Section -->
    <section class="book-list-section">
        <h2>List of Books</h2>
        <table class="book-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Buku</th>
                    <th>Kategori</th>
                    <th>Judul Buku</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Initialize the row counter
                $no = 1;

                // Base query to fetch all books along with their publisher details
                $query = "SELECT b.id_buku, b.kategori, b.nama_buku, b.harga, b.stok, p.nama AS penerbit
                          FROM buku b
                          JOIN penerbit p ON b.id_penerbit = p.id_penerbit";

                // Add search functionality if a search term is provided
                if (isset($_GET['search'])) {
                    $search = $connection->real_escape_string($_GET['search']); // Sanitize input
                    $query .= " WHERE b.nama_buku LIKE '%$search%'";
                }

                // Execute the query and display results
                $result = $connection->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$no}</td>
                            <td>" . htmlspecialchars($row['id_buku']) . "</td>
                            <td>" . htmlspecialchars($row['kategori']) . "</td>
                            <td>" . htmlspecialchars($row['nama_buku']) . "</td>
                            <td>" . htmlspecialchars($row['harga']) . "</td>
                            <td>" . htmlspecialchars($row['stok']) . "</td>
                            <td>" . htmlspecialchars($row['penerbit']) . "</td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7'>No books found.</td></tr>";
                }

                $connection->close(); // Close the database connection
                ?>
            </tbody>
        </table>
    </section>
</main>

<!-- Include the footer -->
<?php include('footer.php'); ?>