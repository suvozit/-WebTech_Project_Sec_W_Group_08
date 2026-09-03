<?php
    
    require_once(__DIR__ . '/db_config.php');
    require_once(__DIR__ . '/schema_bootstrap.php');
    function get_connection() {
        global $host, $db_name, $db_user, $db_pass;
        $con = mysqli_connect($host, $db_user, $db_pass, $db_name);
        if ($con) {
            ensure_seller_delivery_schema($con);
        }
        return $con;
    }
?>