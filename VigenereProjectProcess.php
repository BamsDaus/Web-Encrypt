<?php
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
            $Ki = ord($txKey[$iterate]) - ord("a");
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
?>
