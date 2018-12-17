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
            <h2>Reset Password</h2>
            <form class="" action="" method="post">
                <table>
                    <td><input type="text" name="phones" placeholder="Nomor Telepon"></td>
                    <td><input type="text" name="mail" placeholder="E-mail"></td>
                </table>
                <label class="clspan">Pastikan Nomor Telepon dan Email Anda Sesuai!</label>
                <button type="submit" name="resBut">Kirim</button>
            </form>
            <div class="footer">
                <label class="spanNoLine">
                    Kembali Ke
                    <a href="hash_login.php"> login </a>
                    atau
                    <a href="hash_newacc.php"> daftar</a>
                </label>
            </div>
            <?php
            if (isset($_GET['messageFailed'])) {
                echo "<script type='text/javascript'>alert('Data Tidak Ditemukan!');</script>";
            } elseif (isset($_GET['resetHere'])) {
                include 'hash_reset.php';
            }
             ?>
        </div>
    </body>
</html>

<?php
if (isset($_POST['resBut'])) {
    $phone = $_POST['phones'];
    $mail = $_POST['mail'];

    // $inPass_sha1 = sha1($inPass);
    // $inPass_md5 = md5($inPass_sha1);
    $query_reset = mysqli_query($con, "select * from account where no_telp = '$phone' and email = '$mail'");
    $exist = mysqli_fetch_array($query_reset);
    $cnt = mysqli_num_rows($query_reset);
    if ($cnt != 0) {
        header("location:hash_reset.php");
    } else {
        header("location:hash_forgot.php?messageFailed");
    }
}
 ?>
