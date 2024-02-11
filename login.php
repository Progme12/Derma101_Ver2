<?php

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "Efunctions.php";

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate login
    $errors = login($_POST);

    if (count($errors) == 0) {
        // Redirect to the profile page after successful login
        header("Location: profile.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS styles or link your external stylesheet here -->
</head>
<body>
    <div class="container">
        <div class="panels">
            <div class="panel upper-panel">
                <img src="logo.png" alt="Logo" class="logo">
                <h2>Join In Derma101</h2>
                <p class="tagline">Derma 101 aims to provide professional excellent dermatological services specializing in both pathologic and cosmetic dermatology upholding the highest ethical standards and quality care.</p>
            </div>
            <div class="panel lower-panel">
                <h3 class="welcome">Welcome Back</h3>
                <p class="tagline-welcome">Enhance your Beauty today</p>
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email or Phone Number</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="sign-in-btn">Sign In</button>
                </form>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <?= $error ?> <br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <p class="sign-up-link">Don't have an account yet? <a href="signup.php">Sign Up</a></p>
                <p class="admin-link">Are you an admin? <a href="admin-interface.php">Login here</a></p>
            </div>
        </div>
    </div>
</body>
</html>


<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 300px; /* Adjust as needed */
            width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 10px;
            display: flex;
            flex-direction: column; /* Align panels vertically by default */
        }

        .panels {
            display: flex;
            flex-direction: column; /* Align panels vertically by default */
        }

        .panel {
            padding: 20px;
            text-align: center;
            flex: 1; /* Take up equal space in a column */
        }

        .upper-panel {
            background: url('sidenav-bg.png') center/cover;
            color: #be9355;
            border-radius: 10px 10px 0 0; /* Adjust as needed */
        }

        .logo {
            width: 114px;
            height: 110px;
            margin-bottom: 20px;
            align-content: center;
        }

        .tagline {
            font-size: 12px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 1.5;
            color:black;
        }

        .lower-panel {
            background: #fff;
            padding: 20px;
            border-radius: 0 0 10px 10px; /* Adjust as needed */
            display: flex;
            flex-direction: column;
        }

        .welcome {
            font-size: 18px;
            color: #be9355;
            margin-bottom: 10px;
            text-align: center;
        }

        .tagline-welcome {
            font-size: 12px;
            margin-bottom: 20px;
            color: black;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .forgot-password {
            margin-top: 10px;
            margin-left: 195px; /* Move to the right */
            color: #be9355;
            text-decoration: none;
            font-size: 12px;
            display: block;
        }

        .sign-in-btn {
            background-color: #be9355;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .sign-up-link,
        .admin-link {
            margin-top: 20px;
            color: #555;
            font-size: 12px;
        }

        /* Media Queries for Responsive Design */
        @media only screen and (min-width: 769px) {
            .container {
                max-width: 717px; /* Adjust as needed for desktop view */
            }

            .panels {
                flex-direction: row; /* Arrange panels horizontally on desktop */
            }

            .upper-panel {
                border-radius: 10px 0 0 10px; /* Adjust as needed */
                width: 717px; /* Set specific width for the left panel */
                max-width: 50%; /* Limit to 50% of the viewport width */
            }

            .lower-panel {
                border-radius: 0 10px 10px 0; /* Adjust as needed */
                width: 717px; /* Set specific width for the right panel */
                max-width: 50%; /* Limit to 50% of the viewport width */
            }
        }
    </style>