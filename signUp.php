<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./signUp.css">
    <title>Sign Up</title>
    <style>
        .center {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
require('./connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $matric = trim($_POST['matric']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (!empty($name) && !empty($matric) && !empty($password) && !empty($role)) {


        try {
            $pdo = Database::connect();
            $stmt = $pdo->prepare('INSERT INTO users (name, matric, password, role) VALUES (:n, :m, :p, :r)');
            $stmt->bindValue(':n', $name);
            $stmt->bindValue(':m', $matric);
            $stmt->bindValue(':p', $password);
            $stmt->bindValue(':r', $role);
            $stmt->execute();
            echo '<script>alert("Registration successful!");</script>';
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                echo '<script>alert("Error: Matric number already exists!");</script>';
            } else {
                echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
            }
        }
    } else {
        echo '<script>alert("All fields are required!");</script>';
    }
}
?>
    <div class="form">
        <div class="title">
            <p>Register Form</p>
        </div>
        <form action="" method="post">
            <input type="text" name="matric" placeholder="Matric" required>
            <input type="text" name="name" placeholder="Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="role" placeholder="Role (Lecturer/Student)" required>
            <input type="submit" value="Sign Up" name="signUP_button">
            <a href="./login.php">Do you have an account? Sign in</a>
        </form>
    </div>
</body>
</html>