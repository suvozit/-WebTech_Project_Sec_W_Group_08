<?php
    $page_title = 'Page Not Found';
    include_once __DIR__ . '/../layouts/header.php';
?>

<div class="empty-state">
    <h2 style="font-size: 56px; letter-spacing: .1em;">404</h2>
    <p>The page you're looking for could not be found.</p>
    <a href="<?php echo BASE_URL; ?>?action=home" class="btn">Back to Home</a>
</div>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
