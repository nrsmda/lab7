
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./update1.css">
    <title>Update User</title>
</head>
<body>
    <?php
        session_start();
        require('connection.php');

        if (isset($_GET['matric'])) {
            $matric = $_GET['matric'];
            $data = crudsystem::selectData();
            $user = array_filter($data, function ($user) use ($matric) {
                return $user['matric'] === $matric;
            });
            if (!empty($user)) {
                $user = array_values($user)[0];
            } else {
                echo "User not found.";
                exit;
            }
        }

        if (isset($_POST['button'])) {
            $matric = $_POST['matric'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (!empty($matric) && !empty($name) && !empty($password) && !empty($role)) {
                $crud = new crudsystem();
                $updateResult = $crud->update($matric, $name, $password, $role);

                if ($updateResult) {
                    $_SESSION['validate'] = true;
                    header("Location: User.php");
                    exit();
                } else {
                    echo 'Update failed.';
                }
            } else {
                echo 'Please fill all the fields!';
            }
        }
    ?>
    <div class="signup-form">
        <h2>Update User</h2>
        <form action="" method="POST">
            <label for="matric">Matric Number</label>
            <input type="text" id="matric" name="matric" value="<?php echo isset($user['matric']) ? $user['matric'] : ''; ?>" readonly required>
            
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo isset($user['name']) ? $user['name'] : ''; ?>" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo isset($user['password']) ? $user['password'] : ''; ?>" required>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="" disabled>Select your role</option>
                <option value="Student" <?php echo isset($user['role']) && $user['role'] === 'Student' ? 'selected' : ''; ?>>Student</option>
                <option value="Lecturer" <?php echo isset($user['role']) && $user['role'] === 'Lecturer' ? 'selected' : ''; ?>>Lecturer</option>
            </select>
            <button type="submit" name="button">Update</button>
        </form>
    </div>
</body>
</html>
