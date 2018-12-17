<?php
$con = mysqli_connect("localhost", "root", "", "hash_ksk") or die (mysql_error());
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Reset Password</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="mainform">
            <h2>UBAH PASSWORD</h2>
            <form class="" action="" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="password" placeholder="New Password">
                <button type="submit" name="conf">Confirm</button>
            </form>
        </div>
        <?php
        if (isset($_GET['createSuccess'])) {
            echo "<div class = 'alert'>Password Berhasil Diganti!</div>";
        }
         ?>
    </body>
</html>

<?php
if (isset($_POST['conf'])) {
    $inUser = $_POST['username'];
    $inPass = $_POST['password'];

    $inPass_sha1 = sha1($inPass);
    $inPass_md5 = md5($inPass_sha1);

    $query_akun = mysqli_query($con, "update account set password = '$inPass_md5' where username = '$inUser'");
    $exist = mysqli_fetch_array($query_akun);
    $cnt = mysqli_num_rows($query_akun);
    if ($cnt == 1) {
        $_SESSION['login'] = $inUser;
        header("location:hash_login.php");
    } else {
        header("location:hash_login.php?messageFailed");
    }
}
 ?>
