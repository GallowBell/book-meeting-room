<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/font/th_sarabun',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'notosanthai' => [
            'R' => '/THSarabunNew.ttf',
            'B' => '/THSarabunNew Bold.ttf',
            //'useOTL' => 0xFF,
            'useKashida' => 75,
        ]
    ],
    'default_font' => 'notosanthai'
]);

// Define the HTML content with Thai language
$html = "<h1>การยืนยันการจองห้องประชุม</h1>
<p><strong>ห้องประชุม:</strong> ห้องประชุม A</p>
<p><strong>วันที่:</strong> 2023-10-15</p>
<p><strong>เวลา:</strong> 10:00 น. - 11:00 น.</p>
<p><strong>ผู้เข้าร่วม:</strong></p>
<ul>
    <li>จอห์น โด</li>
    <li>เจน สมิธ</li>
    <li>ไมเคิล บราวน์</li>
</ul>";

// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();

?>