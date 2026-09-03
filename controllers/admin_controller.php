<?php
require_once(__DIR__ . '/../models/user.php');
require_once(__DIR__ . '/../models/product.php');
require_once(__DIR__ . '/../models/order.php');
require_once(__DIR__ . '/../utils/auth_helper.php');

require_admin();

function dashboard() {
    $total_products  = get_total_products();
    $total_customers = count(get_all_customers());
    $total_sellers   = count(get_all_sellers());
    $total_orders    = get_total_orders();
    $pending_orders  = get_pending_orders_count();

    include(__DIR__ . '/../views/admin/dashboard.php');
}
?>