<?php
session_start();

// Connect to the database
include("../PHP/connection.php");
include("admin-connection.php");

$error_message = ""; // Variable to hold the error message

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM adminform WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['password'] === $password) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: admin-reserve.php");
                die;
            } else {
                $error_message = "Wrong Email address or Password";
            }
        } else {
            $error_message = "Wrong Email address or Password";
        }
    } else {
        $error_message = "Wrong Email address or Password";
    }

    
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign in</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminLog.css">
    <link rel="shortcut icon" type="img/png" href="../img/logoSD_V2.png">
</head>

<body>

    <section class="container">
        <div class="content">
            <form action="adminLog.php" method="post">
                <h1>Sign in</h1>
                <div class="group-input">
                    <div class="textfield">
                        <input class="input-field" type="email" placeholder="Email" name="email" required>
                    </div>

                    <div>
                        <input class="input-field" type="password" placeholder="Password" name="password" required>
                    </div>

                    <div id="error-message"><?php echo $error_message; ?></div> <!-- Display error message -->

                    <div>
                        <button type="submit" class="create" value="Login">Log in</button>
                        <p>Don't have an account yet? <span class="log"><a href="ads.php">Sign up</a></span></p>
                    </div>

                    
                </div>
            </form>
        </div>
    </section>

</body>
</html>