<?php
    require_once(__DIR__ . '/../config/database.php');

    function add_payment($order_id, $amount, $payment_method, $transaction_id = null) {
        $con = get_connection();
        
        $sql = "INSERT INTO payments (payment_order_id, payment_amount, payment_method, payment_transaction_id) 
                VALUES ('$order_id', '$amount', '$payment_method', '$transaction_id')";
        
        $result = mysqli_query($con, $sql);
        mysqli_close($con);
        return $result;
    }

    function get_payment_by_order_id($order_id) {
        $con = get_connection();
        $sql = "SELECT * FROM payments WHERE payment_order_id = '$order_id'";
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) == 1) {
            $payment = mysqli_fetch_assoc($result);
            mysqli_close($con);
            return $payment;
        }
        
        mysqli_close($con);
        return null;
    }
?>