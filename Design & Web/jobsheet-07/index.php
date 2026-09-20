<?php
$page_title = 'Home';
include __DIR__ . '/includes/header.php';

$total_buku = count($_SESSION['buku'] ?? []);
$total_anggota = count($_SESSION['anggota'] ?? []);
?>
        <section>
            <h2>Welcome to the Mini Library System</h2>
            <p>A simple server-side PHP application for managing library books and member data.</p>
        </section>

        <section>
            <h2>Summary</h2>
            <article>
                <h3>Total Books</h3>
                <p><?php echo $total_buku; ?></p>
            </article>
            <article>
                <h3>Total Members</h3>
                <p><?php echo $total_anggota; ?></p>
            </article>
            <article>
                <h3>Currently Borrowed</h3>
                <p>0</p>
            </article>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
