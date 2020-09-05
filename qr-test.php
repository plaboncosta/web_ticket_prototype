<?php
include './phpqrcode/qrlib.php';

$path = 'assets/qr-code-images/';
if (!file_exists('./assets/qr-code-images/')) {
    mkdir("./assets/qr-code-images", 0777);
}

$file = $path . 'qr-code' . '.png';

// Text to output
$text = "Name: Plabon \n";
$text .= "Title: Joseph Costa";

QRcode::png($text, $file, 'L', 10, 2);

echo '<img src="' . $file . '" />';