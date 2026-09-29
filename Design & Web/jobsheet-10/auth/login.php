<?php
require_once __DIR__ . '/../includes/csrf.php';
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
$page_title = 'Login';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
include __DIR__ . '/../includes/header.php';
?>
<section>
    <h2>Officer Login</h2>
    <?php if ($flash): ?>
    <p class="flash flash-<?php echo e($flash['type']); ?>" role="status"><?php echo e($flash['message']); ?></p>
    <?php endif; ?>
    <form method="post" action="proses_login.php">
        <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
        <p><label for="username">Username</label><input type="text" id="username" name="username" autocomplete="username" required></p>
        <p><label for="password">Password</label><input type="password" id="password" name="password" autocomplete="current-password" required></p>
        <p><button type="submit">Log In</button></p>
    </form>
    <p>New here? <a href="register.php">Register an account</a>.</p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
