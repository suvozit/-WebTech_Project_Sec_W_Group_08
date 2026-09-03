<?php
    session_start();

    // gettting  the action from URL parameter
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    // route to appropriate controller
    switch($action) {
        
        // auth routes
        case 'login':
            require_once('../controllers/auth_controller.php');
            show_login();
            break;
        
        case 'login_submit':
            require_once('../controllers/auth_controller.php');
            login();
            break;
        
        case 'register':
            require_once('../controllers/auth_controller.php');
            show_register();
            break;
        
        case 'register_submit':
            require_once('../controllers/auth_controller.php');
            register();
            break;
        
        case 'logout':
            require_once('../controllers/auth_controller.php');
            logout();
            break;
        
        // profile routes
        case 'profile':
            require_once('../controllers/profile_controller.php');
            show_profile();
            break;
        
        case 'edit_profile':
            require_once('../controllers/profile_controller.php');
            show_edit_profile();
            break;
        
        case 'update_profile':
            require_once('../controllers/profile_controller.php');
            update_profile();
            break;
        
        case 'change_password':
            require_once('../controllers/profile_controller.php');
            show_change_password();
            break;
        
        case 'update_password':
            require_once('../controllers/profile_controller.php');
            update_password();
            break;
        
        // Admin routes
        case 'admin_dashboard':
            require_once('../controllers/admin_controller.php');
            dashboard();
            break;

        // Seller routes
        case 'seller_dashboard':
            require_once('../controllers/seller_controller.php');
            seller_dashboard();
            break;

        case 'seller_products':
            require_once('../controllers/seller_controller.php');
            seller_product_list();
            break;

        case 'seller_create_product':
            require_once('../controllers/seller_controller.php');
            seller_show_create_product();
            break;

        case 'seller_create_product_submit':
            require_once('../controllers/seller_controller.php');
            seller_create_product();
            break;

        case 'seller_edit_product':
            require_once('../controllers/seller_controller.php');
            seller_show_edit_product();
            break;

        case 'seller_edit_product_submit':
            require_once('../controllers/seller_controller.php');
            seller_edit_product();
            break;

        case 'seller_delete_product':
            require_once('../controllers/seller_controller.php');
            seller_delete_product();
            break;

        case 'seller_sales':
            require_once('../controllers/seller_controller.php');
            seller_sales();
            break;

        case 'seller_orders':
            require_once('../controllers/seller_controller.php');
            seller_orders();
            break;

        case 'seller_update_order_status':
            require_once('../controllers/seller_controller.php');
            seller_update_order_status();
            break;

        case 'seller_assign_order_delivery':
            require_once('../controllers/seller_controller.php');
            seller_assign_order_delivery();
            break;

        case 'seller_discounts':
            require_once('../controllers/seller_controller.php');
            seller_discounts();
            break;

        case 'seller_discount_submit':
            require_once('../controllers/seller_controller.php');
            seller_discount_submit();
            break;

        case 'seller_discount_delete':
            require_once('../controllers/seller_controller.php');
            seller_discount_delete();
            break;

        // Delivery routes
        case 'delivery_dashboard':
            require_once('../controllers/delivery_controller.php');
            delivery_dashboard();
            break;

        case 'delivery_update_status':
            require_once('../controllers/delivery_controller.php');
            delivery_update_status();
            break;

        case 'delivery_claim_order':
            require_once('../controllers/delivery_controller.php');
            delivery_claim_order();
            break;

        case 'assign_order_delivery':
            require_once('../controllers/order_controller.php');
            assign_order_delivery();
            break;

        // Admin Seller Management routes
        case 'seller_users':
            require_once('../controllers/seller_admin_controller.php');
            seller_user_list();
            break;

        case 'create_seller':
            require_once('../controllers/seller_admin_controller.php');
            show_create_seller();
            break;

        case 'create_seller_submit':
            require_once('../controllers/seller_admin_controller.php');
            create_seller();
            break;

        case 'delete_seller':
            require_once('../controllers/seller_admin_controller.php');
            delete_seller();
            break;

        case 'delivery_men':
            require_once('../controllers/delivery_admin_controller.php');
            delivery_man_list();
            break;

        case 'create_delivery_man':
            require_once('../controllers/delivery_admin_controller.php');
            show_create_delivery_man();
            break;

        case 'create_delivery_man_submit':
            require_once('../controllers/delivery_admin_controller.php');
            create_delivery_man();
            break;

        case 'delete_delivery_man':
            require_once('../controllers/delivery_admin_controller.php');
            delete_delivery_man();
            break;
        
        case 'product_list':
            require_once('../controllers/product_controller.php');
            product_list();
            break;
        
        case 'create_product':
            require_once('../controllers/product_controller.php');
            show_create_product();
            break;
        
        case 'create_product_submit':
            require_once('../controllers/product_controller.php');
            create_product();
            break;
        
        case 'edit_product':
            require_once('../controllers/product_controller.php');
            show_edit_product();
            break;
        
        case 'edit_product_submit':
            require_once('../controllers/product_controller.php');
            edit_product();
            break;
        
        case 'delete_product':
            require_once('../controllers/product_controller.php');
            delete_product();
            break;
        
        case 'customer_list':
            require_once('../controllers/customer_controller.php');
            customer_list();
            break;
        
        case 'delete_customer':
            require_once('../controllers/customer_controller.php');
            delete_customer();
            break;
        
        case 'order_list':
            require_once('../controllers/order_controller.php');
            order_list();
            break;
        
        case 'update_order_status':
            require_once('../controllers/order_controller.php');
            update_order_status();
            break;
        
        case 'purchase_history':
            require_once('../controllers/order_controller.php');
            purchase_history();
            break;

        // category browsing (Task 3)
        case 'category':
            require_once('../controllers/home_controller.php');
            show_category();
            break;
            
         // checkout routes (Task 3)
        case 'checkout_invoice':
            require_once('../controllers/checkout_controller.php');
            show_invoice();
            break;
        
        case 'checkout_payment':
            require_once('../controllers/checkout_controller.php');
            show_payment();
            break;
        
        case 'place_order':
            require_once('../controllers/checkout_controller.php');
            place_order();
            break;
        
        case 'checkout_confirmation':
            require_once('../controllers/checkout_controller.php');
            show_confirmation();
            break;
        
        case 'confirm_order':
            require_once('../controllers/checkout_controller.php');
            confirm_order();
            break;
        
        case 'order_success':
            require_once('../controllers/checkout_controller.php');
            show_order_success();
            break;
        
        // customer purchase history (Task 3)
        case 'my_orders':
            require_once('../controllers/order_controller.php');
            my_orders();
            break;
        
        // Task 2 routes
        case 'home':
            require_once('../controllers/home_controller.php');
            home();
            break;
        
        case 'search_products':
            require_once('../controllers/search_controller.php');
            search();
            break;
        
        case 'filter_products':
            require_once('../controllers/search_controller.php');
            show_filter();
            break;
        
        case 'product_details':
            require_once('../controllers/product_detail_controller.php');
            product_details();
            break;
        
        case 'cart':
            require_once('../controllers/cart_controller.php');
            cart_index();
            break;
        
        case 'add_cart':
            require_once('../controllers/cart_controller.php');
            add_cart();
            break;
        
        case 'update_cart':
            require_once('../controllers/cart_controller.php');
            update_cart();
            break;
        
        case 'remove_cart':
            require_once('../controllers/cart_controller.php');
            remove_cart();
            break;
        
        // home fallback
        default:
            require_once('../controllers/home_controller.php');
            home();
            break;
    }
?>