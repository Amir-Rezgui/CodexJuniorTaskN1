<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $password = $_POST["password"];

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $mysqli = new mysqli("localhost", "root", "", "cdx");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Check if the username already exists using prepared statement
    $checkQuery = "SELECT username FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($checkQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        // Insert the new user into the database using prepared statement
        $insertQuery = "INSERT INTO users (username, password_hash) VALUES (?, ?)";
        $stmt = $mysqli->prepare($insertQuery);
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register-container">
        <h2>Create an Account</h2>
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="options">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>
