<?php
    $page_title = 'Server Error';
    include_once __DIR__ . '/../layouts/header.php';
?>

<div class="empty-state">
    <h2 style="font-size: 56px; letter-spacing: .1em;">500</h2>
    <p>Something went wrong on our end. Please try again later.</p>
    <a href="<?php echo BASE_URL; ?>?action=home" class="btn">Back to Home</a>
</div>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
