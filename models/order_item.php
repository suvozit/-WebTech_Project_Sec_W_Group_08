<?php
    require_once(__DIR__ . '/../config/database.php');

    function add_order_items($order_id, $cart_items) {
        $con = get_connection();
        
        foreach($cart_items as $item) {
            $product_id = intval($item['cart_product_id']);
            $quantity = intval($item['cart_quantity']);
            $unit_price = isset($item['unit_price']) ? floatval($item['unit_price']) : floatval($item['product_price']);
            $original_price = isset($item['original_price']) ? floatval($item['original_price']) : floatval($item['product_price']);
            $discount_amount = max(0, ($original_price - $unit_price) * $quantity);
            
            $sql = "INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price, order_item_discount_amount) 
                    VALUES ('$order_id', '$product_id', '$quantity', '$unit_price', '$discount_amount')";
            mysqli_query($con, $sql);
        }
        
        mysqli_close($con);
        return true;
    }

    function get_order_items_by_order_id($order_id) {
        $con = get_connection();
        $sql = "SELECT order_items.*, products.product_name 
                FROM order_items 
                JOIN products ON order_items.order_item_product_id = products.product_id 
                WHERE order_items.order_item_order_id = '$order_id'";
        $result = mysqli_query($con, $sql);
        
        $items = [];
        while($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        
        mysqli_close($con);
        return $items;
    }
?>