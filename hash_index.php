<?php
$con = mysqli_connect("localhost", "root", "", "hash_ksk") or die (mysql_error());
 ?>

 <?php
 session_start();
 if(isset($_SESSION['login'])){
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
     <head>
         <meta charset="utf-8">
         <title>Hash Dashboard</title>
         <link rel="stylesheet" href="style.css">
     </head>
     <body>
         <div class="mainform">
             <h2>LOGIN SUKSES!</h2>
             <form class="" action="" method="post">
                 <?php
                 //show data
                 $user = $_SESSION['login'];
                 $data = mysqli_query($con, "select * from account where username = '$user'");
                 while ($data2 = mysqli_fetch_array($data)) {
                     echo "
                     $data2[username] <br>
                     $data2[alamat] <br>
                     $data2[no_telp] <br>
                     $data2[email] <br>";
                 }
                  ?>
             </form>
              <div class="footer">
                  <a href="logout.php">LOG OUT</a>
              </div>
         </div>
     </body>
 </html>
 <?php
 } else {
     echo header("location:hash_login.php?sessionOut");
 }
  ?>
