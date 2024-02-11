<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if 'token' key exists in $_POST
    if (isset($_POST["token"])) {
        // Retrieve form data
        $token = $_POST["token"];
        $password = $_POST["password"];
        $password_confirmation = $_POST["password_confirmation"];

        $token_hash = hash("sha256", $token);

        $mysqli = require __DIR__ . "/db_connection.php";

        $sql = "SELECT * FROM user
                WHERE reset_token_hash = ?";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("s", $token_hash);

        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        if ($user === null) {
            die("Token not found");
        }

        if (strtotime($user["reset_token_expires_at"]) <= time()) {
            die("Token has expired");
        }

        if (strlen($password) < 8) {
            die("Password must be at least 8 characters");
        }

        if ($password !== $password_confirmation) {
            die("Passwords must match");
        }

        $password= password_hash($password, PASSWORD_DEFAULT);

        $update_sql = "UPDATE user
                       SET password= ?,
                           reset_token_hash = NULL,
                           reset_token_expires_at = NULL
                       WHERE id = ?";

        $update_stmt = $mysqli->prepare($update_sql);

        $update_stmt->bind_param("ss", $password_hash, $user["id"]);

        if (!$update_stmt->execute()) {
            die("Error updating password: " . $update_stmt->error);
        }
    }
}
echo "Password updated. You can now login.";
?>