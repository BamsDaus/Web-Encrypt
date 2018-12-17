<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Encryptor Decryptor Chiper</title>
        <style media="screen">
            body{
                font-family: sans-serif;
                background: #ebf9fb;
            }
            .mainform{
                width: 410px;
                background: white;
                margin: 80px auto;
                margin-bottom: 10px;
                padding: 30px 20px;
                box-shadow: 0px 0px 100px 4px #d6d6d6;0px;
            }
            .titext{
                text-align: center;
                text-transform: uppercase;
                font-weight: bold;
            }
            .txsz{
                font-size: 13px;
            }
            .txbx{
            	box-sizing : border-box;
            	width: 100%;
            	padding: 10px;
            	font-size: 11pt;
            	margin-bottom: 2px;
            }
            .txspc{
                margin-bottom: 10px;
            }
            .btnsty{
                background: #2aa7e2;
            	color: white;
            	font-size: 11pt;
            	width: 100%;
            	border: none;
            	border-radius: 3px;
            	padding: 10px 20px;
            }
            .btnsty:hover{
                background: #1492cd;
            }
            table{
                width: 410px;
            }
            .alert{
                margin-top: 25px;
            	background: #e44e4e;
            	color: white;
            	padding: 10px;
            	text-align: center;
            	border:1px solid #b32929;
            }
            .showUp{
                margin-top: 3px;
            	background: #4ecee4;
            	color: white;
            	padding: 10px;
            	text-align: left;
                width: 430px;
                margin-left: auto;
                margin-right: auto;
            }
            .showUpIn{
                margin-top: 10px;
            	background: #4ecee4;
                text-align: center;
            	color: white;
            	padding: 10px;
                width: 430px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
        <div class="mainform">
            <form id="chiperForm" method="post">
                <p class="titext">Enkripsi Dekripsi</p>
                <p class="titext txsz">Caesar Chiper</p>
                <table>
                    <tr>
                        <td>
                            <input pattern="[a-zA-Z ]+" class="txbx" type="text" name="plaintx" placeholder="Plain Text">
                        </td>
                        <td>
                            <input class="txbx" type="text" name="chipertx" placeholder="Chiper Text">
                        </td>
                        <tr>
                            <td colspan="2"><input class="txbx txspc" type="text" name="kynim" placeholder="NIM Anda"></td>
                        </tr>
                    </tr>
                    <tr>
                        <td><input class="btnsty" type="submit" name="encrypt" value="Enkripsi"></td>
                        <td><input class="btnsty" type="submit" name="decrypt" value="Dekripsi"></td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_GET['alertmessage'])) {
                if ($_GET['alertmessage'] == "encryptFailed") {
                    echo "<div class='alert'>Plainteks atau NIM Masih Kosong !!</div>";
                } elseif ($_GET['alertmessage'] == "decryptFailed") {
                    echo "<div class='alert'>Chiperteks atau NIM Masih Kosong !!</div>";
                } elseif ($_GET['alertmessage'] == "falseplaintx") {
                    echo "<div class='alert'>Plainteks Hanya Boleh Alfabet Tanpa Spasi !!</div>";
                } elseif ($_GET['alertmessage'] == "falsenim") {
                    echo "<div class='alert'>NIM Hanya Boleh Angka !!</div>";
                } elseif ($_GET['alertmessage'] == "falsechipertx") {
                    echo "<div class='alert'>Chiper Hanya Boleh Alfabet Tanpa Spasi !!</div>";
                } elseif ($_GET['alertmessage'] == "offsetminus") {
                    echo "<div class='alert'>NIM Harus 11 Digit !!</div>";
                }

            }
            ?>
        </div>
    </body>
</html>

<?php
function encrypt($inText, $kyNim)
{
    $enc = "";
    $kyNim = $kyNim % 26;
    $arrPlain = str_split($inText);

    $loop = 0;
    while ($loop < count($arrPlain)) {
        if (($arrPlain[$loop] >= "a") && ($arrPlain[$loop] <= "z")) {
            if ((ord($arrPlain[$loop]) + $kyNim) > ord('z')) {
                $enc .= chr(ord($arrPlain[$loop]) + $kyNim - 26);
            } else {
                $enc .= chr(ord($arrPlain[$loop]) + $kyNim);
            }
        } else {
            $enc .= " ";
        }
        $loop++;
    }
    return $enc;
}

function decrypt($inText, $kyNim)
{
    $dec = "";
    $kyNim = $kyNim % 26;
    $arrPlain = str_split($inText);

    $loop = 0;
    while ($loop < count($arrPlain)) {
        if (($arrPlain[$loop] >= "a") && ($arrPlain[$loop] <= "z")) {
            if ((ord($arrPlain[$loop]) - $kyNim) < ord('a')) {
                $dec .= chr(ord($arrPlain[$loop]) - $kyNim + 26);
            } else {
                $dec .= chr(ord($arrPlain[$loop]) - $kyNim);
            }
        } else {
            $dec .= " ";
        }
        $loop++;
    }
    return $dec;
}

if (isset($_POST['encrypt'])) {
    $inText = $_POST['plaintx'];
    $kyNim = $_POST['kynim'];
    //$countNim = count($kyNim);
    if (strlen($kyNim) < 12) {
        header("location:ProjectCaesarChipper.php?alertmessage=offsetminus");
    } else {
        if ($inText == null) {
            header("location:ProjectCaesarChipper.php?alertmessage=encryptFailed");
        //} elseif (!ctype_alpha($inText)) {
        //    header("location:ProjectCaesarChipper.php?alertmessage=falseplaintx");
        } elseif ($kyNim == null) {
            header("location:ProjectCaesarChipper.php?alertmessage=encryptFailed");
        } elseif (!ctype_digit($kyNim)) {
            header("location:ProjectCaesarChipper.php?alertmessage=falsenim");
        } else {
            $inText = strtolower($inText);
            $splitKy = str_split($kyNim);

            //1[0] 6[1] 0[2] 5[3] 3[4] 3[5] 6[6] 1[7] 1[8] 4[9] 5[10] 1[11]
            $key1 = $splitKy[6].$splitKy[7];
            $key2 = $splitKy[8].$splitKy[9];
            $key3 = $splitKy[10].$splitKy[11];

            echo "<div class='showUpIn'><b>PLAINTEKS</b><br>\" ".$inText." \"</div>";
            echo "<div class='showUp'>";
            $firstEnc = encrypt($inText, $key1);
            echo "Enkripsi 1 (".$key1.") : ".$firstEnc."<br>";
            $secondEnc = encrypt($firstEnc, $key2);
            echo "Enkripsi 2 (".$key2.") : ".$secondEnc."<br>";
            $thirdEnc = encrypt($secondEnc, $key3);
            echo "Enkripsi 3 (".$key3.") : ".$thirdEnc."<br>";
            echo "</div>";
            //header("location:ProjectCaesarChipper.php?alertmessage=cryptProcess");
        }
    }

} elseif (isset($_POST['decrypt'])) {
    $inText = $_POST['chipertx'];
    $kyNim = $_POST['kynim'];

    if ($inText == null) {
        header("location:ProjectCaesarChipper.php?alertmessage=decryptFailed");
    //} elseif (!ctype_alpha($inText)) {
    //    header("location:ProjectCaesarChipper.php?alertmessage=falsechipertx");
    } elseif ($kyNim == null) {
        header("location:ProjectCaesarChipper.php?alertmessage=decryptFailed");
    } elseif (!ctype_digit($kyNim)) {
        header("location:ProjectCaesarChipper.php?alertmessage=falsenim");
    } else {
        $inText = strtolower($inText);
        $splitKy = str_split($kyNim);
        //1[0] 6[1] 0[2] 5[3] 3[4] 3[5] 6[6] 1[7] 1[8] 4[9] 5[10] 1[11]
        $key1 = $splitKy[6].$splitKy[7];
        $key2 = $splitKy[8].$splitKy[9];
        $key3 = $splitKy[10].$splitKy[11];

        echo "<div class='showUpIn'><b>CHIPERTEKS</b><br>\" ".$inText." \"</div>";
        echo "<div class='showUp'>";
        $firstDec = decrypt($inText, $key1);
        echo "Dekripsi 1 (".$key1.") : ".$firstDec."<br>";
        $secondDec = decrypt($firstDec, $key2);
        echo "Dekripsi 2 (".$key2.") : ".$secondDec."<br>";
        $thirdDec = decrypt($secondDec, $key3);
        echo "Dekripsi 3 (".$key3.") : ".$thirdDec."<br>";
        echo "</div>";
    }
}
 ?>
