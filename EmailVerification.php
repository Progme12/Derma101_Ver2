<?php

	require "mail.php";
	require "Efunctions.php";
	check_login();

	$errors = array();

	if($_SERVER['REQUEST_METHOD'] == "GET" && !check_verified()){

		//send email
		$vars['code'] =  rand(10000,99999);

		//save to database
		$vars['expires'] = (time() + (60 * 10));
		$vars['email'] = $_SESSION['USER']->email;

		$query = "insert into verify (code,expires,email) values (:code,:expires,:email)";
		database_run($query,$vars);

		$message = "Thank you for signing up with Derma101! Your verification code is: " . $vars['code'];
		$subject = "Email verification";
		$recipient = $vars['email'];
		send_mail($recipient,$subject,$message);
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		if(!check_verified()){

			$query = "select * from verify where code = :code && email = :email";
			$vars = array();
			$vars['email'] = $_SESSION['USER']->email;
			$vars['code'] = $_POST['code'];

			$row = database_run($query,$vars);

			if(is_array($row)){
				$row = $row[0];
				$time = time();

				if($row->expires > $time){

					$id = $_SESSION['USER']->id;
					$query = "update user set email_verified = email where id = '$id' limit 1";
					database_run($query);

					header("Location: profile.php");
					die;
				}else{
					echo "Code expired";
				}

			}else{
				echo "wrong code";
			}
		}else{
			echo "You're already verified";
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <div class="signup-container">
        <div class="signup-panels">
            <div class="signup-panel signup-upper-panel">
                <img src="logo.png" alt="Logo" class="signup-logo">
                <h2>Join In Derma101</h2>
                <p class="signup-tagline">Derma 101 aims to provide professional excellent dermatological services specializing in both pathologic and cosmetic dermatology upholding the highest ethical standards and quality care.</p>
            </div>
            <div class="signup-panel signup-lower-panel">
                <h3 class="signup-welcome">Email Verification</h3>
                <p class="signup-tagline-welcome">Verify your email to complete the registration</p>
                <?php if (count($errors) > 0): ?>
                        <?php foreach ($errors as $error): ?>
                            <?= $error ?> <br>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <form method="post">
                    <!-- Replace "Full Name" with the appropriate fields for email verification -->
                    <div class="signup-form-group">
                        <label for="code">Verification Code</label>
                        <input type="text" id="code" name="code" required>
                    </div>
                    <!-- Remove or modify the other form fields based on your email verification requirements -->
                    <button class="signup-btn" type="submit">Verify Email</button>
                </form>
                <!-- You can add a link here to resend the verification email if needed -->
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