<?php
require_once(__DIR__ . '/../models/user.php');
require_once(__DIR__ . '/../utils/auth_helper.php');
require_once(__DIR__ . '/../config/db_config.php');

require_admin();

function seller_user_list() {
    $sellers = get_all_sellers();
    include(__DIR__ . '/../views/admin/sellers/list.php');
}

function show_create_seller() {
    include(__DIR__ . '/../views/admin/sellers/create.php');
}

function create_seller() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '?action=create_seller');
        exit();
    }

    $name     = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $phone    = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address  = isset($_POST['address']) ? trim($_POST['address']) : '';

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['seller_error'] = 'Name, email, and password are required.';
        header('Location: ' . BASE_URL . '?action=create_seller');
        exit();
    }

    $result = register_user($name, $email, $password, 'seller', $address, $phone);
    if ($result) {
        $_SESSION['seller_success'] = 'Seller account created successfully. They can log in to manage products and orders.';
        header('Location: ' . BASE_URL . '?action=seller_users');
    } else {
        $_SESSION['seller_error'] = 'Email already registered.';
        header('Location: ' . BASE_URL . '?action=create_seller');
    }
    exit();
}

function delete_seller() {
    $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $user    = get_user_by_id($user_id);

    if (!$user || $user['user_role'] !== 'seller') {
        $_SESSION['seller_error'] = 'Seller not found.';
        header('Location: ' . BASE_URL . '?action=seller_users');
        exit();
    }

    if (delete_user($user_id)) {
        $_SESSION['seller_success'] = 'Seller account removed.';
    } else {
        $_SESSION['seller_error'] = 'Failed to remove seller account.';
    }
    header('Location: ' . BASE_URL . '?action=seller_users');
    exit();
}
