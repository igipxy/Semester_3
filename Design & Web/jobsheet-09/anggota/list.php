<?php
$page_title = 'Member List';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$keyword = trim($_GET['q'] ?? '');
$perPage = 5;
$pageValue = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT);
$page = max(1, $pageValue === false ? 1 : $pageValue);
$searchSql = '(name ILIKE :keyword OR member_number ILIKE :keyword OR address ILIKE :keyword)';

if ($keyword !== '') {
    $count = $pdo->prepare('SELECT COUNT(*) FROM anggota WHERE ' . $searchSql);
    $count->execute(['keyword' => '%' . $keyword . '%']);
    $totalRows = (int) $count->fetchColumn();

    $stmt = $pdo->prepare('SELECT * FROM anggota WHERE ' . $searchSql . ' ORDER BY id DESC LIMIT :limit OFFSET :offset');
    $stmt->bindValue('keyword', '%' . $keyword . '%');
} else {
    $totalRows = (int) $pdo->query('SELECT COUNT(*) FROM anggota')->fetchColumn();
    $stmt = $pdo->prepare('SELECT * FROM anggota ORDER BY id DESC LIMIT :limit OFFSET :offset');
}

$totalPages = max(1, (int) ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftar_anggota = $stmt->fetchAll();
?>
<section>
    <h2>Member List</h2>
    <?php if ($flash): ?>
    <p class="flash flash-<?php echo e($flash['type']); ?>" role="status"><?php echo e($flash['message']); ?></p>
    <?php endif; ?>
    <div class="search-box">
        <form method="get" action="list.php">
            <label for="search-input">Search members</label>
            <input type="search" id="search-input" name="q" value="<?php echo e($keyword); ?>" placeholder="Number, name, or address...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="table-responsive">
        <table>
            <thead><tr><th>Member No.</th><th>Name</th><th>Address</th><th>Mobile No.</th><th>Action</th></tr></thead>
            <tbody>
            <?php if (!$daftar_anggota): ?>
                <tr><td colspan="5">No members matched your search.</td></tr>
            <?php else: ?>
                <?php foreach ($daftar_anggota as $anggota): ?>
                <tr data-search-row>
                    <td><?php echo e($anggota['member_number']); ?></td>
                    <td><?php echo e($anggota['name']); ?></td>
                    <td><?php echo e($anggota['address']); ?></td>
                    <td><?php echo e($anggota['mobile_number']); ?></td>
                    <td>
                        <a class="btn-edit" href="edit.php?id=<?php echo urlencode((string) $anggota['id']); ?>">Edit</a>
                        <form class="form-hapus" method="post" action="hapus.php">
                            <input type="hidden" name="id" value="<?php echo e($anggota['id']); ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <nav class="pagination" aria-label="Member list pages">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>" <?php echo $i === $page ? 'aria-current="page"' : ''; ?>><?php echo $i; ?></a>
        <?php endfor; ?>
    </nav>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
