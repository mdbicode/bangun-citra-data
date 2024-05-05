<?php
session_start();

if ($_SESSION['username']) {
    header('Location: admin');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === "bcd" && $password === "bcd123") {
        session_start();
        $_SESSION['username'] = 'bcd';
        header('Location: admin');
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }
}

?>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    width: 300px;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.error-message {
    color: red;
    margin-bottom: 15px;
    text-align: center;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username" class="form-label">Username:</label><br>
            <input type="text" id="username" name="username" class="form-input" required><br>
            <label for="password" class="form-label">Password:</label><br>
            <input type="password" id="password" name="password" class="form-input" required><br>
            <input type="submit" value="Login" class="btn-login">
        </form>
    </div>
</body>
</html>

