
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./table1.css">
    <title>Users Page</title>
</head>
<body>
    <br><br><br><br>
    <h1 style="text-align: center;">Hello! Welcome to Users Database.</h1><br>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Matric</th>
                <th>Password</th>
                <th>Role</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
            require('connection.php');
            $data = crudsystem::selectData();
            if (isset($_GET['delete'])) {
                $matric = $_GET['delete'];
                $result = (new crudsystem())->delete($matric);
                if ($result) {
                    echo "<script>alert('Record deleted successfully.'); window.location.href = 'User.php';</script>";
                } else {
                    echo "<script>alert('Error deleting record.');</script>";
                }
            }

            if (count($data) > 0) {
                foreach ($data as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['matric'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['password'] . '</td>';
                    echo '<td>' . $row['role'] . '</td>';
                    echo '<td><a href="?delete=' . $row['matric'] . '">Delete</a></td>';
                    echo '<td><a href="update.php?matric=' . $row['matric'] . '">Update</a></td>';
                    echo '</tr>';
                }
            }
        ?>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <a href="./login.php" class="center-logout">Log Out</a>
</body>
</html>
