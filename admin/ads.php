<?php 
session_start();

// Connect to the database
include("../PHP/connection.php");
include("admin-connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get the posted data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user has filled in all the required fields
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Check if the email already exists in the table
        $query = "SELECT * FROM adminform WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Email already exists, show an error message
            $errorMessage = "Email address already exists. Please choose a different email.";
        } else {
            // Email does not exist, proceed with registration
            $admin_id = random_num(20);
            $query = "INSERT INTO adminform (admin_id, name, email, password) VALUES ('$admin_id', '$name', '$email', '$password')";
            mysqli_query($conn, $query);

            header("Location: adminLog.php");
            die;
        }
    } else {
        $errorMessage = "Please input valid information";
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ads.css">
        <link rel="shorcut icon" type="img/png" href="../img/logoSD_V2.png">
    </head>

    <body>

        <section class="container">
            <div class="content">
              
                <form action="ads.php" method="post">
                    <h1>Create Account</h1>
                    <div class="group-input">
                        <div class="textfield">
                            <input type="text" class="name input-field" placeholder="Full Name" name="name" required>
                        </div>

                        <div class="textfield">
                            <input type="email" class="input-field" placeholder="Email" name="email" required>
                        </div>

                        <div class="textfield">
                            <input type="password" id="pass" class="input-field" name="password" pattern="^(?!.*[\\~<>\s]).*(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$" title="Your password should include all the formats below" placeholder="Password" required>
                        </div>

                        <div id="validation">
                            <h3>Make sure to have this on your password:</h3>
                            <p id="length" class="invalid">At least eight (8 characters)</p>
                            <p id="capital" class="invalid">At least one (1) uppercase letter (A through Z)</p>
                            <p id="letter" class="invalid">At least one (1) lowercase letter (a through z)</p>
                            <p id="number" class="invalid">At least one (1) number (0 through 9)</p>
                            <p id="special" class="invalid">At least one (1) special character <br>Password cannot contain the following characters: \, ~, <, >, space, and tab</br></p>
                            <p id="special-comment" class="comment"></p>
                        </div>     

                        <div class="textfield">
                            <input type="password" id="confirm-password" class="input-field" placeholder="Confirm Password" required>
                        </div>

                        <p id="confirm-validation">Password don't match</p>
                        <?php if (isset($errorMessage)) { ?>
                            <p class="error-message"><?php echo $errorMessage; ?></p>
                        <?php } ?>

                        <div>
                            <button type="submit" class="create">Create Account</button>
                            <p>Already have an account? <span class="log"><a href="adminLog.php">Sign in</a></span></p>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <script src="../JavaScript/signup.js"></script>
    </body>
</html>
