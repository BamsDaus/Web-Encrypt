<?php
$con = mysqli_connect("localhost", "root", "", "hash_ksk") or die (mysql_error());
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Hash Create Account</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="mainform">
            <h2>BUAT AKUN</h2>
            <form class="" action="" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="alamat" placeholder="Alamat">
                <input type="text" name="telp" placeholder="Nomor Telepon">
                <input type="text" name="email" placeholder="E-Mail">
                <input type="text" name="password" placeholder="Password">
                <button type="submit" name="creacc">Buat Akun</button>
                <a href="hash_login.php" class="nwac">kembali ke login</a>
            </form>
        </div>
        <?php
        if (isset($_GET['createSuccess'])) {
            echo "<div class = 'alert'>Akun Berhasil Dibuat!</div>";
        }
         ?>
    </body>
</html>

<?php
isset($_POST["username"])?$username=$_POST["username"]:$username="";
isset($_POST["alamat"])?$alamat=$_POST["alamat"]:$alamat="";
isset($_POST["telp"])?$telp=$_POST["telp"]:$telp="";
isset($_POST["email"])?$email=$_POST["email"]:$email="";
isset($_POST["password"])?$password=$_POST["password"]:$password="";

if ($username == "" or $alamat="" or $telp="" or $email="" or $password == "") {

} else {
    //get input
    $user = $_POST["username"];
    $addr = $_POST["alamat"];
    $phn = $_POST["telp"];
    $eml = $_POST["email"];
    $pass = $_POST["password"];

    //encrypt pass with sha1
    $pass_sha1 = sha1($pass);

    //encrypt pass with md5
    $pass_md5 = md5($pass_sha1);

    //echo $user;
    //echo "<br> $pass_md5";

    mysqli_query($con, "insert into account values ('$user', '$addr', '$phn', '$eml', '$pass_md5')") or die (mysqli_error($con));
    mysqli_select_db($con, "hash_ksk") or die (mysqli_error($con));
    //echo "AKUN TELAH DIBUAT!";
    header("location:hash_newacc.php?createSuccess");
}
 ?>
