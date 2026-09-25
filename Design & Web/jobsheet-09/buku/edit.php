<?php
$page_title = 'Edit Book';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM buku WHERE id = :id');
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch();

if (!$buku) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Book not found.'];
    header('Location: list.php');
    exit;
}

$categories = ['fiction' => 'Fiction', 'non-fiction' => 'Non-Fiction', 'reference' => 'Reference'];
?>
<section>
    <h2>Edit Book</h2>
    <?php if ($flash): ?>
    <p class="flash flash-<?php echo e($flash['type']); ?>" role="alert"><?php echo e($flash['message']); ?></p>
    <?php endif; ?>
    <form id="form-edit" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo e($buku['id']); ?>">
        <p><label for="title">Title</label><input type="text" id="title" name="title" value="<?php echo e($buku['title']); ?>" required></p>
        <p><label for="author">Author</label><input type="text" id="author" name="author" value="<?php echo e($buku['author']); ?>" required></p>
        <p><label for="year">Publication Year</label><input type="number" id="year" name="year" min="1900" max="2026" value="<?php echo e($buku['year']); ?>" required></p>
        <p><label for="isbn">ISBN</label><input type="text" id="isbn" name="isbn" value="<?php echo e($buku['isbn']); ?>"></p>
        <p><label for="stock">Stock</label><input type="number" id="stock" name="stock" min="0" value="<?php echo e($buku['stock']); ?>" required></p>
        <p><label for="category">Category</label><select id="category" name="category">
            <?php foreach ($categories as $value => $label): ?>
            <option value="<?php echo e($value); ?>" <?php echo $buku['category'] === $value ? 'selected' : ''; ?>><?php echo e($label); ?></option>
            <?php endforeach; ?>
        </select></p>
        <p><button type="submit">Save Changes</button> <a href="list.php">Cancel</a></p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
