
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <title>Login</title>
    <style>
        .form{
            width: 230px;
            height: 280px;
        }
    </style>
</head>
<body>

        <?php
            require('./connection.php');
            if (isset($_POST['login_button'])) {
                $_SESSION['validate']=false;
                $matric=$_POST['matric'];
                $password=$_POST['password'];
                
                $p=crudsystem::connect()->prepare('SELECT * FROM users WHERE matric=:m and password=:p');
                $p->bindValue(':m',$matric);
                $p->bindValue(':p',$password);
                $p->execute();
                
                $d=$p->fetchAll(PDO::FETCH_ASSOC);
                if ($p->rowCount()>0) {
                    $_SESSION['matric']=$matric;
                    $_SESSION['password']=$password;
                    $_SESSION['validate']=true;
                    echo '<script>alert("Successfully Logged!");</script>';
                    header('location:User.php');
                }else {
                    echo'<script>alert("Make sure that you are registered!");</script>';
                }

        }
        ?>
    <div class="form">
        <div class="title">
            <p>Login</p>
        </div>
        <form action="" method="post">
            <input type="text" name="matric" placeholder="Matric">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login" name="login_button"> 
            <a href="./signUp.php" style="position:center; left:50px;top:-8px; font-size:14px">Click here to sign up</a>
        </form>
    </div>
</body>
</html>
