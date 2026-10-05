<?php
require_once __DIR__ . '/../includes/csrf.php';
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
$page_title = 'Register Officer';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
include __DIR__ . '/../includes/header.php';
?>
<section>
    <h2>Register an Officer Account</h2>
    <?php if ($flash): ?>
    <p class="flash flash-<?php echo e($flash['type']); ?>" role="alert"><?php echo e($flash['message']); ?></p>
    <?php endif; ?>
    <form method="post" action="proses_register.php">
        <?php echo csrf_field(); ?>
        <p><label for="name">Name</label><input type="text" id="name" name="name" maxlength="255" required></p>
        <p><label for="username">Username</label><input type="text" id="username" name="username" maxlength="50" autocomplete="username" required></p>
        <p><label for="password">Password (at least 6 characters)</label><input type="password" id="password" name="password" minlength="6" autocomplete="new-password" required></p>
        <p><button type="submit">Create Account</button></p>
    </form>
    <p>Already registered? <a href="login.php">Log in</a>.</p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
