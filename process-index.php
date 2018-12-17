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
    $inText = strtolower($inText);

    $kyNim = $_POST['kynim'];
    $splitKy = str_split($kyNim);
    //1[0] 6[1] 0[2] 5[3] 3[4] 3[5] 6[6] 1[7] 1[8] 4[9] 5[10] 1[11]
    $key1 = $splitKy[6].$splitKy[7];
    $key2 = $splitKy[8].$splitKy[9];
    $key3 = $splitKy[10].$splitKy[11];

    $firstEnc = encrypt($inText, $key1);
    echo $firstEnc."<br>";

    $secondEnc = encrypt($firstEnc, $key2);
    echo $secondEnc."<br>";

    $thirdEnc = encrypt($secondEnc, $key3);
    echo $thirdEnc."<br>";
} elseif (isset($_POST['decrypt'])) {
    $inText = $_POST['chipertx'];
    $inText = strtolower($inText);

    $kyNim = $_POST['kynim'];
    $splitKy = str_split($kyNim);
    //1[0] 6[1] 0[2] 5[3] 3[4] 3[5] 6[6] 1[7] 1[8] 4[9] 5[10] 1[11]
    $key1 = $splitKy[6].$splitKy[7];
    $key2 = $splitKy[8].$splitKy[9];
    $key3 = $splitKy[10].$splitKy[11];

    $firstDec = decrypt($inText, $key1);
    echo $firstDec."<br>";

    $secondDec = decrypt($firstDec, $key2);
    echo $secondDec."<br>";

    $thirdDec = decrypt($secondDec, $key3);
    echo $thirdDec."<br>";
}
 ?>
