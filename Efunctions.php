<?php
session_start();

function check_verified()
{
    $id = $_SESSION['USER']->id;
    $query = "SELECT * FROM user WHERE id = :id LIMIT 1";
    $vars = array(':id' => $id);
    $row = database_run($query, $vars);

    if (is_array($row)) {
        $row = $row[0];

        if ($row->email == $row->email_verified) {
            return true;
        }
    }

    return false;
}

function check_login($redirect = true)
{
    if (isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])) {
        return true;
    }

    if ($redirect) {
        header("Location: login.php");
        die;
    } else {
        return false;
    }
}

function login($data)
{
    $errors = array();

    // Validate email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email";
    }

    // Validate password length
    if (strlen(trim($data['password'])) < 8) {
        $errors[] = "Password must be at least 4 chars long";
    }

    // Check for errors
    if (count($errors) == 0) {
        $arr['email'] = $data['email'];
        $password = hash('sha256', $data['password']);

        $query = "SELECT * FROM user WHERE email = :email LIMIT 1";

        $row = database_run($query, $arr);

        if (is_array($row)) {
            $row = $row[0];

            if ($password === $row->password) {
                $_SESSION['USER'] = $row;
                $_SESSION['LOGGED_IN'] = true;

            } else {
                $errors[] = "Wrong email or password";
            }

        } else {
            $errors[] = "Wrong email or password";
        }
    }

    return $errors;
}
function signup($data)
{
    $errors = array();

    // validate
    if (!preg_match('/^[a-zA-Z\s]+$/', $data['fullname'])) {
        $errors[] = "Please enter a valid fullname";
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email";
    }

    if (strlen(trim($data['password'])) < 8) {
        $errors[] = "Password must be at least 8 chars long";
    }
    $check = database_run("SELECT * FROM user WHERE email = :email LIMIT 1", ['email' => $data['email']]);
    if (is_array($check)) {
        $errors[] = "That email already exists";
    }

    // save
    if (count($errors) == 0) {
        $arr['fullname'] = $data['fullname'];
        $arr['email'] = $data['email'];
        $arr['password'] = hash('sha256', $data['password']);
        $arr['date'] = date("Y-m-d H:i:s");

        $query = "INSERT INTO user (fullname, email, password, date) VALUES (:fullname, :email, :password, :date)";

        database_run($query, $arr);
    }

    return $errors;
}

function database_run($query, $vars = array())
{
    $string = "mysql:host=localhost;dbname=db_derma101";

    try {
        $con = new PDO($string, 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $con->prepare($query);
        $check = $stm->execute($vars);

        if ($check) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);

            if (count($data) > 0) {
                return $data;
            }
        }

        return false;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
