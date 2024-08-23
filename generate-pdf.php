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

$mpdf = new \Mpdf\Mpdf();

$mpdf->SetLeftMargin(0);
$mpdf->SetTopMargin(5);
$mpdf->SetRightMargin(0);
$mpdf->SetDisplayMode('fullwidth');
$mpdf->SetAutoPageBreak(false, 5);
// Define the path to the image (use forward slashes)
$imagePath = 'assets/img/report_page_0001.jpg';

// Get the dimensions of the A4 page
$pageWidth = 210; // Width in mm
$pageHeight = 297; // Height in mm

$html = '<img style="width: '.$pageWidth.'mm; height: '.$pageHeight.'mm; margin: 0; padding: 0; border: none;" src="'.$imagePath.'"></img>';


$mpdf->WriteHTML($html);


// Output the PDF to the browser
$mpdf->Output('output.pdf', 'I');

?>
