<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// Create an instance of the class
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/font/th_sarabun',
    ]),
    'fontdata' => $fontData + [
        'notosanthai' => [
            'R' => 'THSarabunNew.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ]
    ],
    'default_font' => 'notosanthai',
    'format' => 'A4' // Ensure the format is A4
]);

// Define the path to the image (use forward slashes)
$imagePath = 'assets/img/report_page_0001.jpg';

// Get the dimensions of the A4 page
$pageWidth = 210; // Width in mm
$pageHeight = 297; // Height in mm

// Add the image to the PDF, scaling it to cover the full page
$mpdf->Image($imagePath, 0, 0, $pageWidth, $pageHeight, 'jpg', '', true, false);

// Set the font, size, and color for the text
$mpdf->SetFont('notosanthai', 'B', 36); // Larger font size for visibility
$mpdf->SetTextColor(255, 255, 255); // White color for contrast

// Set the position (X, Y) for the text
$x = 10;  // X position in mm (10 mm from the left)
$y = 150;  // Y position in mm (150 mm from the top, roughly center vertically)

// Move the cursor to the specified position
$mpdf->SetXY($x, $y);

// Write the text on the image at the specified position
$mpdf->Cell($pageWidth - 20, 10, "Your Overlay Text Here", 0, 1, 'C'); // Centered text

// Output the PDF to the browser
$mpdf->Output('output.pdf', 'I');

?>
