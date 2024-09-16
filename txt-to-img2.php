<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/connection.php';

$xAxis = 0;
$yAxis = 0;

$sum = 0; //อยู่บนสุด

$img_path = __DIR__ . '/assets/img/booking_sum_page.jpg';
$font = __DIR__. '/font/th_sarabun/THSarabunNew.ttf';
$FontSize = 60.5;

$img = imagecreatefromjpeg($img_path);
$black = imagecolorallocate($img, 0, 0, 0);

function AddText($x, $y, $text){
    global $img, $black, $font, $FontSize;
    imagettftext($img, $FontSize, 0, $x, $y, $black, $font, $text);
}

// Get the first and last day of each month in the current year
function getFirstAndLastDaysOfEachMonth() {
    $currentYear = date('Y');
    $months = [];

    for ($month = 1; $month <= 12; $month++) {
        $firstDay = new DateTime("$currentYear-$month-01");
        $lastDay = (clone $firstDay)->modify('last day of this month');

        $months[] = [
            'first_day' => $firstDay->format('Y-m-d'),
            'last_day' => $lastDay->format('Y-m-d'),
            'month' => $firstDay->format('F'),
        ];
    }

    return $months;
}

// Example usage
$months = getFirstAndLastDaysOfEachMonth();
$data = [];

foreach ($months as $month) {
    $query = $conn->query("SELECT reservation_id, meeting_room, count(meeting_room) as total, SUM(participant_count) as total_participant FROM `reservations` WHERE is_approve = 1 AND reservation_date BETWEEN '".$month['first_day']."' AND '".$month['last_day']."' GROUP BY meeting_room;");
    $data[$month['month']] = $query->fetch_all(MYSQLI_ASSOC);
}

//echo "<strong>$monthName</strong><br>";
$x_step = 25;
$y_step = 160;


$last_X = 0;

// Loop through each month and output data
/* foreach ($data as $monthName => $monthData) {
    if (empty($monthData)) {
        echo $monthName . ': No data<br>';
        continue;
    } */

    $sum = 0;
    $last_Y += $y_step;
    foreach ($monthData['September'] as $key => $value) {
        AddText(590 + $x_step, $last_Y, 'รวมห้อง: ' . $value['total']);
        $sum += $value['total_participant'];
    }
    foreach ($monthData['October'] as $key => $value) {
        AddText(590 + $x_step, $last_Y, 'รวมห้อง: ' . $value['total']);
        $sum += $value['total_participant'];
    }
    AddText(2050, $last_Y, $sum);
//}

// Save the modified image as booking_sum_page1.jpg
$result = imagejpeg($img, __DIR__ . '/assets/img/booking_sum_page1.jpg', 100);

// Free up memory
imagedestroy($img);

return $result;


?>