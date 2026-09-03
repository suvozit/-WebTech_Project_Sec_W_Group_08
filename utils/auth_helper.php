<?php
require_once(__DIR__ . '/../config/db_config.php');

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
}

function is_customer() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'customer';
}

function is_seller() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'seller';
}

function is_delivery_man() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'delivery_man';
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . '?action=login');
        exit();
    }
}

function require_admin() {
    require_login();
    if (!is_admin()) {
        header('Location: ' . BASE_URL . '?action=home');
        exit();
    }
}

function require_admin_or_seller() {
    require_login();
    if (!is_admin() && !is_seller()) {
        header('Location: ' . BASE_URL . '?action=home');
        exit();
    }
}

function require_seller() {
    require_login();
    if (!is_seller()) {
        header('Location: ' . BASE_URL . '?action=home');
        exit();
    }
}

function require_delivery_man() {
    require_login();
    if (!is_delivery_man()) {
        header('Location: ' . BASE_URL . '?action=home');
        exit();
    }
}

function require_customer() {
    require_login();
    if (!is_customer()) {
        header('Location: ' . BASE_URL . '?action=home');
        exit();
    }
}

function get_current_user_id() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

function get_current_user_name() {
    return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
}
?>