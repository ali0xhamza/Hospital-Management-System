<?php
ob_start(); // Prevents header already sent error
session_start();
include('db.php');
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $user_id, $db_username, $hashed_password);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $db_username;
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "No user found!";
        }
        mysqli_stmt_close($stmt);
    } else {
        $error = "Database query failed!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('image.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .sign-up-link {
            text-align: center;
            margin-top: 10px;
        }

        .sign-up-link a {
            color: #007bff;
            text-decoration: none;
        }

        .sign-up-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" onsubmit="return validateForm()">
            <input class="input-field" type="text" name="username" id="username" placeholder="Username" required>
            <input class="input-field" type="password" name="password" id="password" placeholder="Password" required>
            <button class="submit-btn" type="submit">Login</button>
        </form>

        <div class="sign-up-link">
            Not registered? <a href="index.php">Sign up here</a>.
        </div>
    </div>

    <script>
        function validateForm() {
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value;

            if (username === "" || password === "") {
                alert("Both fields are required!");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
