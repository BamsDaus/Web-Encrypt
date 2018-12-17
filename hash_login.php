<?php
$con = mysqli_connect("localhost", "root", "", "hash_ksk") or die (mysql_error());
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Hash Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="mainform">
            <h2>FORM LOGIN</h2>
            <form class="" action="" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="login">Login</button>
            </form>
             <div class="footer">
                 <a href="hash_forgot.php" class="frgt">Forgot Your Password?</a>
                 <span> | </span>
                 <a href="hash_newacc.php" class="nw">Don't Have an Account?</a>
             </div>
        </div>
        <?php
        if (isset($_GET['messageFailed'])) {
            echo "<div class = 'alert'>Username dan Password Tidak Sesuai!!</div>";
        } elseif (isset($_GET['sessionOut'])) {
            echo "<div class = 'alert'>Silahkan Login Dahulu!!!</div>";
        }
         ?>
    </body>
</html>

<?php
session_start();
if (isset($_POST['login'])) {
    $inUser = $_POST['username'];
    $inPass = $_POST['password'];

    $inPass_sha1 = sha1($inPass);
    $inPass_md5 = md5($inPass_sha1);

    $query_akun = mysqli_query($con, "select * from account where username = '$inUser' and password = '$inPass_md5'");
    $exist = mysqli_fetch_array($query_akun);
    $cnt = mysqli_num_rows($query_akun);
    if ($cnt == 1) {
        $_SESSION['login'] = $inUser;
        header("location:hash_index.php");
    } else {
        header("location:hash_login.php?messageFailed");
    }
}
 ?>
