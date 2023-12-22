<?php
// A function that checks if the user is logged in and has a valid session
function check_login($con, $allowed_pages = array('admin-reserve.php','admin-user','admin-message','admin-rating')){
    // Check if the user is logged in by checking if the session variable 'user_id' is set
    if(isset($_SESSION['user_id'])){
        // Get the user's data from the database using their user ID
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM registrationform WHERE user_id = '$id' LIMIT 1";
        $result = mysqli_query($con, $query);
        // If the query is successful and returns at least one row, return the user's data
        if($result && mysqli_num_rows($result) > 0 ){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // If the user is not logged in, check if the current page is in the array of allowed pages
    else{
        if(in_array(basename($_SERVER['PHP_SELF']), $allowed_pages)){
            // If the current page is in the array of allowed pages, return nothing
            return;
        }
        // If the current page is not in the array of allowed pages, redirect the user to the login page and stop the script
        header("Location: adminLog.php");
        die();
    }
}

// A function to generate a unique registration ID
function getRegistrationID($userID) {
    global $conn;
    $id = random_num(9); // Generate a random number for the ID

    // Check if the ID already exists in the database
    $query = "SELECT * FROM registrationform WHERE user_id = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // If the ID already exists, generate a new one recursively
        return getRegistrationID($userID);
    }

    return $id;
}



//assigning the function of random_num from signup//
function random_num($length){
    $text = "";

    //make sure that the length of the generated number is not less than 9//
    if($length < 9){
        $length = 9;
    }

    //create a function for $len from random_num//
    $len = rand (8, $length);

    //for loop - repeat the function of $len//
    for ($i=0; $i < $len; $i++){

        $text .= rand(0,9);
    }

    //collect the data
    return $text;
}



?> 