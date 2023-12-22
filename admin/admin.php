<?php
session_start();

// Define the valid admin accounts
$adminAccounts = array(
    array('username' => 'ADMIN', 'password' => '!Mukbang123'),
    array('username' => 'ADMIN', 'password' => '!Mama123'),
    array('username' => 'ADMIN', 'password' => '!Admin123')
);

// Check if the login form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the entered credentials match any valid admin account
    foreach ($adminAccounts as $admin) {
        if ($username === $admin['username'] && $password === $admin['password']) {
            // Valid admin account found, set session variables and redirect to admin page
            $_SESSION['admin'] = true;
            header("Location: admin-reserve.php");
            exit();
        }
    }

    // If no valid admin account is found, display an error message
    $error = "Invalid credentials. Please try again.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin </title>
    <link rel="stylesheet" href="admin.css">
    <link rel="shortcut icon" type="image/png" href="../img/logoSD_V2.png">
</head>
<body>
    <div class="container">
        <div class="content">
            <h1 class="title">Admin Login</h1>
            <form class="login-form" method="POST" action="">
            <div class="form-group">
                <input class="input-field" type="text" name="username" placeholder="Username" required><br>
            </div>

            <div class="form-group">
                <input class="input-field" type="password" name="password" placeholder="Password" required><br>
            </div>

            <?php if (isset($error)) { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>

            <input class="btn" type="submit" name="submit" value="Login">
        </form> 
        </div>
       
    </div>
</body>
</html>
