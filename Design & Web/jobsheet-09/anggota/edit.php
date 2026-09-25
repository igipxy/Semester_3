<?php
$page_title = 'Edit Member';
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM anggota WHERE id = :id');
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch();

if (!$anggota) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Member not found.'];
    header('Location: list.php');
    exit;
}
?>
<section>
    <h2>Edit Member</h2>
    <?php if ($flash): ?>
    <p class="flash flash-<?php echo e($flash['type']); ?>" role="alert"><?php echo e($flash['message']); ?></p>
    <?php endif; ?>
    <form id="form-edit" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo e($anggota['id']); ?>">
        <p><label for="name">Name</label><input type="text" id="name" name="name" value="<?php echo e($anggota['name']); ?>" required></p>
        <p><label for="member_number">Member No.</label><input type="text" id="member_number" name="member_number" value="<?php echo e($anggota['member_number']); ?>" required></p>
        <p><label for="address">Address</label><input type="text" id="address" name="address" value="<?php echo e($anggota['address']); ?>"></p>
        <p><label for="mobile_number">Mobile No.</label><input type="text" id="mobile_number" name="mobile_number" value="<?php echo e($anggota['mobile_number']); ?>"></p>
        <p><label for="email">Email</label><input type="email" id="email" name="email" value="<?php echo e($anggota['email']); ?>"></p>
        <p><button type="submit">Save Changes</button> <a href="list.php">Cancel</a></p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
