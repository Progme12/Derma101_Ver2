<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
                <h3 class="welcome">Password Reset</h3>
                <p class="tagline-welcome">There is nothing to worry about; we'll send you a message to help you reset your password</p>
                <div class="form-group">
                    <form method="POST" action="send-password-reset.php">
                        <label for="email">E-mail or Phone Number</label>
                        <input type="text" id="email" name="email" required>
                        <button class="reset-btn" type="submit">Send Reset</button>
                    </form>
                </div>
                <p class="resend-email">Resend email</p>
                <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
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
            max-width: 400px; /* Adjusted width */
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
            margin-bottom: 20px;
            text-align: center;
        }

        .tagline-welcome {
            font-size: 12px;
            margin-bottom: 50px;
            color: black;
        }

        .form-group {
            margin-bottom: 35px;
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
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .reset-btn {
            background-color: #be9355;
            margin-left: 116px;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .resend-email,
        .login-link {
            margin-top: 30px;
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