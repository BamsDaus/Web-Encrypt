<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Vigenere Chiper</title>
        <link rel="stylesheet" href="VigenereCSS.css">
    </head>
    <body>
        <div class="mainform">
            <form class="" action="vigenereProjectIndex.php" method="post">
				<p class="titext">Enkripsi Dekripsi</p>
                <p class="titext txsz">Vigenere Chiper</p>
                <table>
                    <tr>
                        <td colspan="2"><input class="txbx txspc" type="text" name="txKey" placeholder="Teks Key"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="txbx txspc" type="text" name="txPlain" placeholder="Teks Plain"></td>
                    </tr>
                    <tr>
                        <td><input class="btnsty" type="submit" name="encSub" value="ENCRYPT"></td>
                        <td><input class="btnsty" type="submit" name="decSub" value="DECRYPT"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>

<?php
$txKey = "";
$txPlain = "";
$validateRequest = true;

function encSub($txKey, $txPlain)
{
    $txKey = strtolower($txKey);

    $iterate = 0;
	$keyLen = strlen($txKey);
	$plainLen = strlen($txPlain);

    for ($i=0; $i < $plainLen; $i++) {
        if (ctype_alpha($txPlain[$i])) {
            // Formula --> Ei = (Ki + Pi) mod 26
            $Ki = ord($txKey[$iterate]) - ord("a");
            if (ctype_upper($txPlain[$i])) {
                $Pi = ord($txPlain[$i]) - ord("A");
                $txPlain[$i] = chr((($Ki + $Pi) % 26) + ord("A"));
            } else {
                $Pi = ord($txPlain[$i]) - ord("a");
                $txPlain[$i] = chr((($Ki + $Pi) % 26) + ord("a"));
            }
        }
        $iterate++;
        if ($iterate == $keyLen) {
            $iterate = 0;
        }
    }
    return $txPlain;
}

function decSub($txKey, $txPlain)
{
    $txKey = strtolower($txKey);

    $iterate = 0;
	$keyLen = strlen($txKey);
	$plainLen = strlen($txPlain);

    for ($i=0; $i < $plainLen; $i++) {
        if (ctype_alpha($txPlain[$i])) {
            // Formula --> Di = (Ei - Ki + 26) mod 26
            if (ctype_upper($txPlain[$i])) {
                $x = (ord($txPlain[$i]) - ord("A")) - (ord($txKey[$iterate]) - ord("a"));

				if ($x < 0) {
					$x += 26;
				}
				$x = $x + ord("A");
				$txPlain[$i] = chr($x);
            } else {
                $x = (ord($txPlain[$i]) - ord("a")) - (ord($txKey[$iterate]) - ord("a"));
				if ($x < 0) {
					$x += 26;
				}
				$x = $x + ord("a");
				$txPlain[$i] = chr($x);
            }
        }
        $iterate++;
        if ($iterate == $keyLen) {
            $iterate = 0;
        }
    }
    return $txPlain;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$txKey = $_POST['txKey'];
	$txPlain = $_POST['txPlain'];

    if (empty($_POST['txKey'])) {
        echo "<script type='text/javascript'>alert('Key Tidak Boleh Kosong');</script>";
        $validateRequest = false;
    } else if (empty($_POST['txPlain'])) {
		echo "<script type='text/javascript'>alert('Plain Teks Tidak Boleh Kosong');</script>";
		$validateRequest = false;
	} elseif (!ctype_alpha($_POST['txKey'])) {
        echo "<script type='text/javascript'>alert('Key Harus Alfabet');</script>";
    }

    if ($validateRequest) {
        if (isset($_POST['encSub'])) {
            $result = encSub($txKey, $txPlain);
			echo "<div class='showUpIn'>";
			echo "<b>Input Key</b> <br> \" ".$txKey." \"<br>";
			echo "<b>Input Teks</b> <br>\" ".$txPlain." \" <br>";
			echo "<b>Hasil Enkripsi</b> <br> \" ".$result." \" ";
			echo "</div>";
        } elseif (isset($_POST['decSub'])) {
            $result = decSub($txKey, $txPlain);
			echo "<div class='showUpIn'>";
			echo "<b>Input Key</b> <br> \" ".$txKey." \"<br>";
			echo "<b>Input Teks</b> <br>\" ".$txPlain." \" <br>";
			echo "<b>Hasil Dekripsi</b> <br> \" ".$result." \" ";
			echo "</div>";
        }
    }
}
?>
