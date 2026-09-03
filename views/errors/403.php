<?php
    $page_title = 'Access Denied';
    include_once __DIR__ . '/../layouts/header.php';
?>

<div class="empty-state">
    <h2 style="font-size: 56px; letter-spacing: .1em;">403</h2>
    <p>You don't have permission to access this page.</p>
    <a href="<?php echo BASE_URL; ?>?action=home" class="btn">Back to Home</a>
</div>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
