<?php
    require_once('../utils/auth_helper.php');
    require_admin();
    $page_title = 'Purchase History';
    include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">All Purchase History</div>

<div class="card">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Assigned Delivery Man</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order): ?>
                <tr>
                    <td><strong>#<?php echo $order['order_id']; ?></strong></td>
                    <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                    <td>৳<?php echo number_format($order['order_total_amount'], 0); ?></td>
                    <td>
                        <?php
                            $st = $order['order_status'];
                            $badge_class = 'badge-pending';
                            $label = ucfirst($st);
                            if ($st === 'confirmed') { $badge_class = 'badge-confirmed'; }
                            elseif ($st === 'assigned') { $badge_class = 'badge-assigned'; $label = 'Assigned'; }
                            elseif ($st === 'out_for_delivery') { $badge_class = 'badge-out'; $label = 'Out for Delivery'; }
                            elseif ($st === 'delivered') { $badge_class = 'badge-delivered'; $label = 'Delivered'; }
                            elseif ($st === 'rejected') { $badge_class = 'badge-rejected'; }
                        ?>
                        <span class="badge-status <?php echo $badge_class; ?>"><?php echo htmlspecialchars($label); ?></span>
                    </td>
                    <td>
                        <?php echo !empty($order['delivery_man_name']) ? htmlspecialchars($order['delivery_man_name']) : '<span class="muted">&mdash;</span>'; ?>
                    </td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=admin_dashboard" class="back-link">&larr; Back to Dashboard</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
