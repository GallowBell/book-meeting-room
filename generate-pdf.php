<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// Require the connection file
require_once __DIR__ . '/connection.php';

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
$imagePath = 'assets/img/report_page_0002.jpg';

// Get the dimensions of the A4 page
$pageWidth = 210; // Width in mm
$pageHeight = 297; // Height in mm

/* 

$query = $conn->query("SELECT 
    CONCAT(meeting_name, ' - ', meeting_room) as title,
    CONCAT(reservation_date, ' ', start_time) as `start`,
    CONCAT(reservation_date_end, ' ', end_time) as `end`,
    reservation_date,
    start_time,
    reservation_date_end,
    end_time,
    reservation_id,
    CASE
      WHEN meeting_room = 'ห้องประชุมชั้น 4' THEN 'bg-success'
      WHEN meeting_room = 'ห้องประชุมชั้น 5' THEN 'bg-primary'
          ELSE 'bg-danger'
    END as color_1
    FROM `reservations`
    WHERE is_approve = 1");
$data = $query -> fetch_all(MYSQLI_ASSOC);

*/

// เอา $data มาวนลูปเพื่อสร้างรายการการจอง ในไฟล์ txt-to-img.php
require_once __DIR__ . '/txt-to-img.php';

$html = '<img style="width: '.$pageWidth.'mm; height: '.$pageHeight.'mm; margin: 0; padding: 0; border: none;" src="'.$imagePath.'"></img>';

$mpdf->WriteHTML($html);

// Output the PDF to the browser
$mpdf->Output('', 'I');

?>
