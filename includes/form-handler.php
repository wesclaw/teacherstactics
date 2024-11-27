<?php /*

session_start();

require_once('../includes/dbh.inc.php'); // Including the database connection

$error = ''; 

// Form validation logic
if (empty($_POST["name"])) {
    $error = 'Please enter your name.';
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $error = 'Please enter a valid email address.';
} elseif (strlen($_POST["password"]) < 8) {
    $error = 'Password must be at least 8 characters long.';
} elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
    $error = 'Password must contain at least one letter.';
} elseif (!preg_match("/[0-9]/i", $_POST["password"])) {
    $error = 'Password must contain at least one number.';
} elseif ($_POST["password"] !== $_POST["repeat_password"]) {
    $error = 'Passwords do not match.';
}

// Check reCAPTCHA
$recaptchaSecretKey = '6LevAIwqAAAAAJQTZgGnj3CmpHSm9C5qIeN3dIrW'; // Replace with your actual secret key
$recaptchaResponse = $_POST['g-recaptcha-response'];

// Verify reCAPTCHA response with Google
$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
$response = file_get_contents($verifyUrl . '?secret=' . $recaptchaSecretKey . '&response=' . $recaptchaResponse);
$responseKeys = json_decode($response, true);

// If reCAPTCHA failed, return an error
if (intval($responseKeys['success']) !== 1) {
    $error = 'Please verify that you are not a robot.';
}

// If there are validation errors, store them in session and redirect back to the form
if (!empty($error)) {
    $_SESSION['error'] = $error; // Store the error in session
    header("Location: ../pages/registration.php"); // Redirect back to the form
    exit(); 
}

// If no errors, proceed to hash the password and insert data into the database
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// SQL query to insert the new user into the database
$sql = "INSERT INTO users (first_name, email, password, profile_img) VALUES (?, ?, ?, ?)";

$stmt = $conn->stmt_init(); // Initialize the prepared statement

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $conn->error); // Handle SQL errors
}

// Bind the parameters and execute the statement, including the default profile image
$defaultProfileImg = '../user/userImages/man1.png'; // Set the default profile image path
$stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $password_hash, $defaultProfileImg);

if ($stmt->execute()) {
    // If user was successfully inserted, store user info in session
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['profile_img'] = $defaultProfileImg; // Store the default image in session

    // Redirect to the main user page
    header("Location: /user/main.php");
    exit(); // Stop further script execution
} else {
    echo "Error: " . $stmt->error; // Handle execution errors
}

// Close the statement and connection
$stmt->close();
$conn->close();


*/


session_start();

require_once('../includes/dbh.inc.php'); // Including the database connection

$error = ''; 

// Form validation logic
if (empty($_POST["name"])) {
    $error = 'Please enter your name.';
} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $error = 'Please enter a valid email address.';
} elseif (strlen($_POST["password"]) < 8) {
    $error = 'Password must be at least 8 characters long.';
} elseif (!preg_match("/[a-z]/i", $_POST["password"])) {
    $error = 'Password must contain at least one letter.';
} elseif (!preg_match("/[0-9]/i", $_POST["password"])) {
    $error = 'Password must contain at least one number.';
} elseif ($_POST["password"] !== $_POST["repeat_password"]) {
    $error = 'Passwords do not match.';
}

// Check if the email already exists in the database
$email = $_POST["email"];
$sql_check_email = "SELECT * FROM users WHERE email = ?"; // Query to check if email already exists

$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email); // Bind email parameter
$stmt_check_email->execute();
$result = $stmt_check_email->get_result();

if ($result->num_rows > 0) {
    $error = 'This email address is already in use.';
}

// Check reCAPTCHA
$recaptchaSecretKey = '6LevAIwqAAAAAJQTZgGnj3CmpHSm9C5qIeN3dIrW'; // Replace with your actual secret key
$recaptchaResponse = $_POST['g-recaptcha-response'];

// Verify reCAPTCHA response with Google
$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
$response = file_get_contents($verifyUrl . '?secret=' . $recaptchaSecretKey . '&response=' . $recaptchaResponse);
$responseKeys = json_decode($response, true);

// If reCAPTCHA failed, return an error
if (intval($responseKeys['success']) !== 1) {
    $error = 'Please verify that you are not a robot.';
}

// If there are validation errors, store them in session and redirect back to the form
if (!empty($error)) {
    $_SESSION['error'] = $error; // Store the error in session
    header("Location: ../pages/registration.php"); // Redirect back to the form
    exit(); 
}

// If no errors, proceed to hash the password and insert data into the database
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// SQL query to insert the new user into the database
$sql = "INSERT INTO users (first_name, email, password, profile_img) VALUES (?, ?, ?, ?)";

$stmt = $conn->stmt_init(); // Initialize the prepared statement

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $conn->error); // Handle SQL errors
}

// Bind the parameters and execute the statement, including the default profile image
$defaultProfileImg = '../user/userImages/man1.png'; // Set the default profile image path
$stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $password_hash, $defaultProfileImg);

if ($stmt->execute()) {
    // If user was successfully inserted, store user info in session
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['profile_img'] = $defaultProfileImg; // Store the default image in session

    // Redirect to the main user page
    header("Location: /user/main.php");
    exit(); // Stop further script execution
} else {
    echo "Error: " . $stmt->error; // Handle execution errors
}

// Close the statement and connection
$stmt->close();
$conn->close();
