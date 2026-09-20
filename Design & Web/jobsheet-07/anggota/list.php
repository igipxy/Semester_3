<?php
$page_title = 'Member List';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftar_anggota = $_SESSION['anggota'] ?? [];
?>
        <section>
            <h2>Member List</h2>
            <?php if ($flash): ?>
            <p class="flash flash-<?php echo e($flash['type']); ?>" role="status"><?php echo e($flash['message']); ?></p>
            <?php endif; ?>
            <div class="search-box">
                <label for="search-input">Search members</label>
                <input type="text" id="search-input" placeholder="Type a member number, name, or address...">
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Member No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftar_anggota)): ?>
                        <tr><td colspan="5">There is no member data yet. Please add a member first.</td></tr>
                        <?php else: ?>
                            <?php foreach ($daftar_anggota as $anggota): ?>
                        <tr>
                            <td><?php echo e($anggota['member_number']); ?></td>
                            <td><?php echo e($anggota['name']); ?></td>
                            <td><?php echo e($anggota['address']); ?></td>
                            <td><?php echo e($anggota['mobile_number']); ?></td>
                            <td><button type="button">Edit</button> <button type="button" class="btn-delete">Delete</button></td>
                        </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
