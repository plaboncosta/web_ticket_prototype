<?php
session_start();

if(!$_SESSION["user_id"]) {
    $redirect_url = $base_url . '/index.php';
    header('Location: '. $redirect_url);
}

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
ob_start();
include "e-ticket.php";
$template = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($template);
$mpdf->Output('e-ticket.pdf', 'I');