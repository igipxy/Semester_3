<?php
$page_title = 'Book List';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftar_buku = $_SESSION['buku'] ?? [];
?>
        <section>
            <h2>Book List</h2>
            <?php if ($flash): ?>
            <p class="flash flash-<?php echo e($flash['type']); ?>" role="status"><?php echo e($flash['message']); ?></p>
            <?php endif; ?>
            <div class="search-box">
                <label for="search-input">Search books</label>
                <input type="text" id="search-input" placeholder="Type a title, author, or year...">
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftar_buku)): ?>
                        <tr><td colspan="5">There is no book data yet. Please add a book first.</td></tr>
                        <?php else: ?>
                            <?php foreach ($daftar_buku as $buku): ?>
                        <tr>
                            <td><?php echo e($buku['title']); ?></td>
                            <td><?php echo e($buku['author']); ?></td>
                            <td><?php echo e($buku['year']); ?></td>
                            <td><?php echo e($buku['stock']); ?></td>
                            <td><button type="button">Edit</button> <button type="button" class="btn-delete">Delete</button></td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
