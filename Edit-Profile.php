<?php
include "db_connection.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-VmPD39mxp18+8tP4bLczn0AxEgFBsXlkGQU6i1RzTXOS8Qw/f8tDif8RfYpG2tYMYzJ3Up30UEV73bS45aTRdg==" crossorigin="anonymous" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            background-color: whitesmoke;
            justify-content: space-between;
            align-items: center;
            color: #BE9355;
            padding: 10px 20px;
        }

        .navbar .logo img {
            height: 40px;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin-right: 20px;
        }

        .nav-links li a {
            color: #BE9355;
            text-decoration: none;
        }

        .notif-number {
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 12px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .username {
            margin-right: 10px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #333;
            padding: 10px;
            list-style: none;
            margin-top: 20px;
        }

        .dropdown-menu li {
            margin-bottom: 5px;
        }

        .user-info:hover .dropdown-menu {
            display: block;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .profile-section h2 {
            margin-bottom: 10px;
        }

        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }

        .profile-info div {
            display: flex;
            flex-direction: column;
        }

        .profile-info label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-info input,
        .profile-info select {
            padding: 5px;
        }

        .security-section {
            margin-bottom: 30px;
        }

        .security-section h2 {
            margin-bottom: 10px;
        }

        .security-info {
        display: flex;
        flex-direction: row; /* Align items vertically */
        align-items: flex-start; /* Align items to the start of the container */
        margin-bottom: 10px; /* Add some space between security info sections */
}

        .security-info input[type="password"],
        .security-info button {
        margin-right: 8px;
        padding: 7px; /* Add some space between the input box and the button */
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-update {
            background-color: #4CAF50;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        #update-password-btn {
            padding: 8px 11px;
            border: none;
            background-color: #BE9355;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #update-password-btn:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
<nav class="navbar">
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">Patients</a></li>
        <li><a href="#">Appointments <span class="notif-number">3</span></a></li>
        <li><a href="#">Inventory</a></li>
    </ul>
    <div class="user-info">
        <span class="username">Hi, {username}</span>
        <img src="user-icon.png" alt="User Icon">
        <ul class="dropdown-menu">
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
</nav>

    <div class="container">
        <h1>Profile</h1>
        <form method="post" action="update_profile.php">
        <div class="profile-section">
            <h2>Personal Information</h2>
            <div class="profile-info">
                <div>
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" value="John">
                </div>
                <div>
                    <label for="middle-name">Middle Name</label>
                    <input type="text" id="middle-name" value="Doe">
                </div>
                <div>
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" value="Smith">
                </div>
                <div>
                    <label for="date-of-birth">Date of Birth</label>
                    <input type="date" id="date-of-birth">
                </div>
                <div>
                    <label for="sex">Sex</label>
                    <select id="sex">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div>
                    <label for="status">Status</label>
                    <input type="text" id="status" value="Single">
                </div>
                <div>
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" value="1234567890">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" value="john@example.com">
                </div>
            </div>
        </div>

        <div class="security-section">
        <h2>Security</h2>
        <div class="security-info">
        <label for="password">Change Password (last updated: July 1, 2023)</label>
        </div>
        <div class="security-info">
        <input type="password" id="password" placeholder="New Password">
        <button id="update-password-btn">Update Password</button>
    </div>
</div>

        <div class="button-container">
            <button class="btn-delete">Delete Account</button>
            <button class="btn-update">Update Profile</button>
            </div>
    </form>
</div>
</body>
</html>
