<?php

require "Efunctions.php";

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST")
{

	$errors = signup($_POST);

	if(count($errors) == 0)
	{
		header("Location: login.php");
		die;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
</head>
<body>
	<div>
			<?php if(count($errors) > 0):?>
				<?php foreach ($errors as $error):?>
					<?= $error?> <br>
				<?php endforeach;?>
			<?php endif;?>
    </div>

    <div class="signup-container">
        <div class="signup-panels">
            <div class="signup-panel signup-upper-panel">
                <img src="logo.png" alt="Logo" class="signup-logo">
                <h2>Join In Derma101</h2>
                <p class="signup-tagline">Derma 101 aims to provide professional excellent dermatological services specializing in both pathologic and cosmetic dermatology upholding the highest ethical standards and quality care.</p>
            </div>
            <div class="signup-panel signup-lower-panel">
                <h3 class="signup-welcome">Create Your Account</h3>
                <p class="signup-tagline-welcome">It's free and easy</p>
                <form method="post">
                    <div class="signup-form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                    <div class="signup-form-group">
                        <label for="email">Email or Phone Number</label>
                        <input type="text" id="email" name="email" required>
                    </div>
                    <div class="signup-form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <p class="password-hint">Must be 8 characters</p>
                    </div>
                    <div class="signup-form-group terms-checkbox">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms" class="terms-agreement">
                            By creating an account means you agree to the
                            <a href="terms_and_conditions.html" target="_blank">Terms and Conditions</a>
                            and
                            <a href="privacy_policy.html" target="_blank">Privacy Policy</a>
                        </label>
                    </div>
                    <button class="signup-btn" type="submit">Sign Up</button>
                </form>
                <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
<script>
        function validateForm() {
            var password = document.getElementById('password').value;

            if (password.length < 8) {
                alert("Password must be at least 8 characters");
                return false; // Prevent form submission
            } else {
                return true; // Allow form submission
            }
        }
    </script>
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

        .signup-container {
            max-width: 300px; /* Adjust as needed */
            width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 10px;
            display: flex;
            flex-direction: column; /* Align panels vertically by default */
        }

        .signup-panels {
            display: flex;
            flex-direction: column; /* Align panels vertically by default */
        }

        .signup-panel {
            padding: 20px;
            text-align: center;
            flex: 1; /* Take up equal space in a column */
        }

        .signup-upper-panel {
            background: url('sidenav-bg.png') center/cover;
            color: #be9355;
            border-radius: 10px 10px 0 0; /* Adjust as needed */
        }

        .signup-logo {
            width: 114px;
            height: 110px;
            margin-bottom: 20px;
            align-content: center;
        }

        .signup-tagline {
            font-size: 12px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 1.5;
            color:black;
        }

        .signup-lower-panel {
            background: #fff;
            padding: 20px;
            border-radius: 0 0 10px 10px; /* Adjust as needed */
        }

        .signup-welcome {
            font-size: 18px;
            color: #be9355;
            margin-bottom: 10px;
            text-align: center;
        }

        .signup-tagline-welcome {
            font-size: 12px;
            margin-bottom: 20px;
            color: black;
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

        .signup-form-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative; /* Add this to make sure the checkbox is positioned relative to this container */
        }

        .signup-btn {
            background-color: #be9355;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .login-link {
            margin-top: 20px;
            color: #555;
            font-size: 12px;
        }

        .password-hint {
            font-size: 12px;
            margin-top: 5px;
            color: #555;
            margin-bottom: 5px; /* Add margin-bottom to give space between the hint and checkbox */
        }

        .terms-checkbox {
            display: flex;
            align-items: center;
            margin-top: 5px; /* Adjust as needed */
        }

        #terms {
            width: 20px; /* Set width of checkbox */
            height: 20px; /* Set height of checkbox */
            margin-right: 5px;
        }

        .terms-agreement {
            font-size: 12px;
            color: #555;
            flex: 1; /* Allow the label to fill available horizontal space */
            max-width: 470px; /* Set maximum width for the label */
            overflow: hidden;
            text-overflow: ellipsis; /* Add ellipsis (...) for overflow text */
            margin-top: 10px;
        }

        /* Media Queries for Responsive Design */
        @media only screen and (min-width: 769px) {
            .signup-container {
                max-width: 717px; /* Adjust as needed for desktop view */
            }

            .signup-panels {
                flex-direction: row; /* Arrange panels horizontally on desktop */
            }

            .signup-upper-panel {
                border-radius: 10px 0 0 10px; /* Adjust as needed */
                width: 717px; /* Set specific width for the left panel */
                max-width: 50%; /* Limit to 50% of the viewport width */
            }

            .signup-lower-panel {
                border-radius: 0 10px 10px 0; /* Adjust as needed */
                width: 717px; /* Set specific width for the right panel */
                max-width: 50%; /* Limit to 50% of the viewport width */
            }
        }
    </style>