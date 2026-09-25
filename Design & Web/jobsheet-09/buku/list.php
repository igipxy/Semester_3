<?php
$page_title = 'Book List';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$keyword = trim($_GET['q'] ?? '');
$perPage = 5;
$pageValue = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
$page = max(1, $pageValue === false ? 1 : $pageValue);

if ($keyword !== '') {
    $count = $pdo->prepare('SELECT COUNT(*) FROM buku WHERE title ILIKE :keyword');
    $count->execute(['keyword' => '%' . $keyword . '%']);
    $totalRows = (int) $count->fetchColumn();

    $stmt = $pdo->prepare('SELECT * FROM buku WHERE title ILIKE :keyword ORDER BY id DESC LIMIT :limit OFFSET :offset');
    $stmt->bindValue('keyword', '%' . $keyword . '%');
} else {
    $totalRows = (int) $pdo->query('SELECT COUNT(*) FROM buku')->fetchColumn();
    $stmt = $pdo->prepare('SELECT * FROM buku ORDER BY id DESC LIMIT :limit OFFSET :offset');
}

$totalPages = max(1, (int) ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftar_buku = $stmt->fetchAll();
?>
<section>
    <h2>Book List</h2>
    <?php if ($flash): ?>
    <p class="flash flash-<?php echo e($flash['type']); ?>" role="status"><?php echo e($flash['message']); ?></p>
    <?php endif; ?>
    <div class="search-box">
        <form method="get" action="list.php">
            <label for="search-input">Search book title</label>
            <input type="search" id="search-input" name="q" value="<?php echo e($keyword); ?>" placeholder="Type a title...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="table-responsive">
        <table>
            <thead><tr><th>Title</th><th>Author</th><th>Year</th><th>Stock</th><th>Action</th></tr></thead>
            <tbody>
            <?php if (!$daftar_buku): ?>
                <tr><td colspan="5">No books matched your search.</td></tr>
            <?php else: ?>
                <?php foreach ($daftar_buku as $buku): ?>
                <tr data-search-row>
                    <td><?php echo e($buku['title']); ?></td>
                    <td><?php echo e($buku['author']); ?></td>
                    <td><?php echo e($buku['year']); ?></td>
                    <td><?php echo e($buku['stock']); ?></td>
                    <td>
                        <a class="btn-edit" href="edit.php?id=<?php echo urlencode((string) $buku['id']); ?>">Edit</a>
                        <form class="form-hapus" method="post" action="hapus.php">
                            <input type="hidden" name="id" value="<?php echo e($buku['id']); ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <nav class="pagination" aria-label="Book list pages">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>" <?php echo $i === $page ? 'aria-current="page"' : ''; ?>><?php echo $i; ?></a>
        <?php endfor; ?>
    </nav>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
