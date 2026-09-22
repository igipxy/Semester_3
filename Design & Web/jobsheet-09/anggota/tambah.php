<?php
$page_title = 'Add Member';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Add Member</h2>
            <?php if ($flash): ?>
            <p class="flash flash-<?php echo e($flash['type']); ?>" role="alert"><?php echo e($flash['message']); ?></p>
            <?php endif; ?>
            <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
                <p><label for="name">Name</label><input type="text" id="name" name="name" required></p>
                <p><label for="member_number">Member No.</label><input type="text" id="member_number" name="member_number" required></p>
                <p><label for="address">Address</label><input type="text" id="address" name="address"></p>
                <p><label for="mobile_number">Mobile No.</label><input type="text" id="mobile_number" name="mobile_number"></p>
                <p><label for="email">Email</label><input type="email" id="email" name="email"></p>
                <p><button type="submit">Save</button></p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
