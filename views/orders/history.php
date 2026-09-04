<?php
    require_once('../utils/auth_helper.php');
    require_customer();
    $page_title = 'My Orders';
    include_once __DIR__ . '/../layouts/header.php';
?>

<div class="page-title">My Orders</div>

<?php if (empty($orders)): ?>
    <div class="empty-state">
        <p>You have not placed any orders yet.</p>
        <a href="<?php echo BASE_URL; ?>?action=home" class="btn">Start Shopping</a>
    </div>
<?php else: ?>
    <?php foreach ($orders as $order): ?>
        <div class="card">
            <div class="order-head">
                <span><strong>Order #<?php echo htmlspecialchars($order['order_id']); ?></strong></span>
                <span class="muted"><?php echo htmlspecialchars($order['order_date']); ?></span>
                <span>
                    Status: 
                    <?php
                        $st = $order['order_status'];
                        $badge_class = 'badge-pending';
                        $label = ucfirst($st);
                        if ($st === 'confirmed') { $badge_class = 'badge-confirmed'; }
                        elseif ($st === 'assigned') { $badge_class = 'badge-assigned'; $label = 'Assigned to Rider'; }
                        elseif ($st === 'out_for_delivery') { $badge_class = 'badge-out'; $label = 'Out for Delivery'; }
                        elseif ($st === 'delivered') { $badge_class = 'badge-delivered'; $label = 'Delivered'; }
                        elseif ($st === 'rejected') { $badge_class = 'badge-rejected'; }
                    ?>
                    <span class="badge-status <?php echo $badge_class; ?>"><?php echo htmlspecialchars($label); ?></span>
                </span>
                <span>Total: <strong>৳<?php echo number_format($order['order_total_amount'], 0); ?></strong></span>
            </div>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty &times; Unit Price</th>
                        <th>Line Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $items = $order_items_map[$order['order_id']] ?? [];
                        if (empty($items)):
                    ?>
                        <tr><td colspan="3">No items found for this order.</td></tr>
                    <?php else: ?>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($item['order_item_quantity']); ?> &times; ৳<?php echo number_format($item['order_item_unit_price'], 0); ?></td>
                                <td>৳<?php echo number_format($item['order_item_quantity'] * $item['order_item_unit_price'], 0); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=profile" class="btn-view">Back to Profile</a>
    <a href="<?php echo BASE_URL; ?>?action=home" class="back-link">&larr; Back to Home</a>
</div>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
