<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
ob_start();
include "e-ticket.php";
$template = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($template);
$mpdf->Output();