<?php
    require_once(__DIR__ . '/../config/database.php');

    function register_user($user_name, $user_email, $user_password, $user_role, $user_address, $user_phone) {
        $con = get_connection();
        
        // checks if email exists
        $check_sql = "SELECT user_id FROM users WHERE user_email = '$user_email'";
        $check_result = mysqli_query($con, $check_sql);
        
        if(mysqli_num_rows($check_result) > 0) {
            mysqli_close($con);
            return false;
        }
        
        // hash password
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
        
        // insert user
        $sql = "INSERT INTO users (user_name, user_email, user_password_hash, user_role, user_address, user_phone) 
                VALUES ('$user_name', '$user_email', '$hashed_password', '$user_role', '$user_address', '$user_phone')";
        
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }

    function login_user($user_email, $user_password) {
        $con = get_connection();
        
        $sql = "SELECT user_id, user_name, user_email, user_password_hash, user_role, user_address, user_phone 
                FROM users WHERE user_email = '$user_email'";
        
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            if(password_verify($user_password, $user['user_password_hash'])) {
                mysqli_close($con);
                return $user;
            }
        }
        
        mysqli_close($con);
        return false;
    }

    function get_user_by_id($user_id) {
        $con = get_connection();
        
        // $sql = "SELECT user_id, user_name, user_email, user_role, user_profile_picture, user_address, user_phone, user_created_at 
        //         FROM users WHERE user_id = '$user_id'";

        $sql = "SELECT user_id, user_name, user_email, user_password_hash, user_role, user_profile_picture, user_address, user_phone, user_created_at 
        FROM users WHERE user_id = '$user_id'";
        
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            mysqli_close($con);
            return $user;
        }
        
        mysqli_close($con);
        return null;
    }

    function update_user_profile($user_id, $user_name, $user_address, $user_phone) {
        $con = get_connection();
        
        $sql = "UPDATE users SET user_name = '$user_name', user_address = '$user_address', user_phone = '$user_phone' 
                WHERE user_id = '$user_id'";
        
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }

    function update_user_password($user_id, $new_password) {
        $con = get_connection();
        
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE users SET user_password_hash = '$hashed_password' WHERE user_id = '$user_id'";
        
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }

    function update_profile_picture($user_id, $picture_path) {
        $con = get_connection();
        
        $sql = "UPDATE users SET user_profile_picture = '$picture_path' WHERE user_id = '$user_id'";
        
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }

    function get_users_by_role($role) {
        $con = get_connection();
        $role = mysqli_real_escape_string($con, $role);
        $sql = "SELECT user_id, user_name, user_email, user_address, user_phone, user_created_at 
                FROM users WHERE user_role = '$role' ORDER BY user_created_at DESC";
        $result = mysqli_query($con, $sql);
        $users = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        mysqli_close($con);
        return $users;
    }

    function get_all_delivery_men() {
        return get_users_by_role('delivery_man');
    }

    function get_all_sellers() {
        return get_users_by_role('seller');
    }

    function get_all_customers() {
        $con = get_connection();
        
        $sql = "SELECT user_id, user_name, user_email, user_address, user_phone, user_created_at 
                FROM users WHERE user_role = 'customer'";
        
        $result = mysqli_query($con, $sql);
        
        $customers = [];
        while($row = mysqli_fetch_assoc($result)) {
            $customers[] = $row;
        }
        
        mysqli_close($con);
        return $customers;
    }

    function delete_user($user_id) {
        $con = get_connection();
        
        $sql = "DELETE FROM users WHERE user_id = '$user_id'";
        
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }
?>