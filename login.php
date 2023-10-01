<?php
session_start();

// Check if the user is already logged in and redirect to the index page if so
if (isset($_SESSION["user_id"])) {
    header("Location: index.php"); // Redirect to your main page (index.php)
    exit();
}

$error = ""; // Initialize an error message variable

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Replace with your database connection code
    $mysqli = new mysqli("localhost", "root", "", "cdx");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Replace this query with a prepared statement to retrieve user information from the database
    $query = "SELECT user_id, username, password_hash FROM users WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password_hash"];

        // Verify the password using password_verify()
        if (password_verify($password, $hashedPassword)) {
            // Authentication successful, create a session
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];

            // Redirect to the index page (your main page)
            header("Location: index.php"); // Redirect to your main page (index.php)
            exit();
        }
    }

    // Close the database connection
    $mysqli->close();
    $error = "Incorrect username or password. Please try again.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="options"><a href="register.php">Register</a></div>
    </div>
</body>
</html>
