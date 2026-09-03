<?php
require_once(__DIR__ . '/../models/user.php');
require_once(__DIR__ . '/../utils/auth_helper.php');
require_once(__DIR__ . '/../config/db_config.php');

require_admin();

function delivery_man_list() {
    $delivery_men = get_all_delivery_men();
    include(__DIR__ . '/../views/admin/delivery_men/list.php');
}

function show_create_delivery_man() {
    include(__DIR__ . '/../views/admin/delivery_men/create.php');
}

function create_delivery_man() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '?action=create_delivery_man');
        exit();
    }

    $name     = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $phone    = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address  = isset($_POST['address']) ? trim($_POST['address']) : '';

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['delivery_error'] = 'Name, email and password are required.';
        header('Location: ' . BASE_URL . '?action=create_delivery_man');
        exit();
    }

    $result = register_user($name, $email, $password, 'delivery_man', $address, $phone);
    if ($result) {
        $_SESSION['delivery_success'] = 'Delivery man added. They can log in with this email and password.';
        header('Location: ' . BASE_URL . '?action=delivery_men');
    } else {
        $_SESSION['delivery_error'] = 'Email already registered.';
        header('Location: ' . BASE_URL . '?action=create_delivery_man');
    }
    exit();
}

function delete_delivery_man() {
    $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $user    = get_user_by_id($user_id);

    if (!$user || $user['user_role'] !== 'delivery_man') {
        $_SESSION['delivery_error'] = 'Delivery man not found.';
        header('Location: ' . BASE_URL . '?action=delivery_men');
        exit();
    }

    if (delete_user($user_id)) {
        $_SESSION['delivery_success'] = 'Delivery man removed.';
    } else {
        $_SESSION['delivery_error'] = 'Failed to remove delivery man.';
    }
    header('Location: ' . BASE_URL . '?action=delivery_men');
    exit();
}
