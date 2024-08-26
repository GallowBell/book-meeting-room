<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/connection.php';

/**
 * @var string $img_path path to the image
 */
$img_path = __DIR__ . '/assets/img/report_page_0001.jpg';

/**
 * @var string $second_img_path path to the image
 */
$second_img_path = __DIR__ . '/assets/img/checkmark.png'; // Path to the second image

/**
 * @var string $font path to the font
 */
$font = __DIR__. '/font/th_sarabun/THSarabunNew.ttf';

/**
 * @var int $FontSize font size
 */
$FontSize = 40.5;

$img = imagecreatefromjpeg($img_path);
$second_img = imagecreatefrompng($second_img_path);
$black = imagecolorallocate($img, 0, 0, 0);

function AddCheckBox($x, $y){
    global $img, $second_img, $black, $font, $FontSize;
    // Define the position where the second image will be drawn
    $second_img_x = $x; // X position for the second image
    $second_img_y = $y; // Y position for the second image

    // Get the width and height of the second image
    $second_img_width = imagesx($second_img);
    $second_img_height = imagesy($second_img);

    // Draw the second image onto the first image
    imagecopy($img, $second_img, $second_img_x, $second_img_y, 0, 0, $second_img_width, $second_img_height);
}

function AddText($x, $y, $text){
    global $img, $black, $font, $FontSize;
    // Add text to the image
    imagettftext($img, $FontSize, 0, $x, $y, $black, $font, $text);
}

if(!isset($_GET['reservation_id'])){
    die('Reservation ID is required');
}

$reservation_id = $_GET['reservation_id'];

// Get the data from the database
$query = $conn->query("SELECT 
        *,
        CONCAT(meeting_name, ' - ', meeting_room) as title,
        CONCAT(reservation_date, ' ', start_time) as `start`,
        CONCAT(reservation_date_end, ' ', end_time) as `end`,
        CONCAT(reservation_date, ' ', start_time) as `start_d`,
        CONCAT(reservation_date_end, ' ', end_time) as `end_d`,
        CASE
        WHEN meeting_room = 'ห้องประชุมชั้น 4' THEN 'bg-success'
        WHEN meeting_room = 'ห้องประชุมชั้น 5' THEN 'bg-primary'
            ELSE 'bg-danger'
        END as color_1
    FROM `reservations`
  
    WHERE is_approve = 1 AND reservation_id = $reservation_id");

$data = $query -> fetch_all(MYSQLI_ASSOC);

if(count($data) == 0){
    die('Reservation data not found');
}

// $data = ข้อมูลจากตาราง reservations
foreach ($data as $key_1 => $value_1) {

    $sql2 = "SELECT * FROM `equipment_reservations` WHERE reservation_id = ".$value_1['reservation_id'];
    $query = $conn->query($sql2);
    $equipment_reservations = $query->fetch_all(MYSQLI_ASSOC);

    // X, Y, Text
    AddText(325, 255,  $value_1['government_sector']);
    AddText(120, 340,  $value_1['document_number']);
    AddText(1100, 340,  $value_1['Timestamps']);
    AddText(420, 555,  $value_1['government_sector']);
    AddText(375, 1050,  $value_1['participant_count']);
    AddText(375, 1050,  $value_1['participant_count']);
    AddText(375, 1050,  $value_1['participant_count']);
    AddText(700, 1050,  $value_1['reservation_date'] . ' ถึง ' . $value_1['reservation_date_end']);
    AddText(1280, 1050,  $value_1['start_time']);
    AddText(1550, 1050,   $value_1['end_time']); 

    // Adjust X and Y based on meeting_room
    if ($value_1['meeting_room'] == 'ห้องประชุมชั้น 4') {
        $x = 195;
        $y = 645;
    } elseif ($value_1['meeting_room'] == 'ห้องประชุมชั้น 5') {
        $x = 950;
        $y = 640;
    } elseif ($value_1['meeting_room'] == 'ห้องประชุมชั้น 9') {
        $x = 195;
        $y = 715;
    }

    // Add the text with the adjusted X, Y coordinates
    AddCheckBox($x, $y);


    // $equipment_reservations = ข้อมูลจากตาราง equipment_reservations
    foreach ($equipment_reservations as $key_2 => $value_2) {
        foreach ($value_2 as $key_3 => $value_3) {

            // X, Y ของ CheckBox
            // x = แนวนอน
            // y = แนวตั้ง
            if($value_3 == 'ชุดโต๊ะหมู่บูชา'){
                AddCheckBox(200, 1210);
            }
            if($value_3 == 'จาน + ช้อนส้อม'){
                AddCheckBox(200, 1280);
            }
            if($value_3 == 'ถาดเสิร์ฟ'){
                AddCheckBox(1000, 1280);
            }
            if($value_3 == 'จานแก้วใส'){
                AddCheckBox(200, 1350);
            }
            if($value_3 == 'ช้อนเล็ก'){
                AddCheckBox(200, 1420);
            }
            if($value_3 == 'ส้อมเล็ก'){
                AddCheckBox(1000, 1420);
            }
            if($value_3 == 'ชุดกาเเฟ'){
                AddCheckBox(200, 1490);
            }
            if($value_3 == 'ถ้วย'){
                AddCheckBox(200, 1560);
            }
            if($value_3 == 'เเก้วน้ำดื่ม'){
                AddCheckBox(200, 1630);
            }
            if($value_3 == 'เหยือกน้ำ'){
                AddCheckBox(200, 1700);
            }
            if($value_3 == 'คูลเลอร์ใส่น้ำดื่ม'){
                AddCheckBox(1000, 1700);
            }
            if($value_3 == 'คูลเลอร์ใส่น้ำร้อน'){
                AddCheckBox(200, 1770);
            }
            if($value_3 == 'กระติกน้ำเเข็ง'){
                AddCheckBox(1000, 1770);
            }
            if($value_3 == 'ผ้าปูโต๊ะ'){
                AddCheckBox(200, 1840);
            }
            if($value_3 == 'ผ้าคลุมเก้าอี้'){
                AddCheckBox(1000, 1840);
            }
            if($value_3 == 'อื่นๆ'){
                AddCheckBox(200, 1910);
            }
            if($value_3 == 'ที่จอดรถชั้น'){
                AddCheckBox(200, 1980);
            }
            if($value_3 == 'จำนวนคัน'){
                
            }
            if($value_3 == 'เลขทะเบียนรถ'){
                // AddCheckBox(200, 1350);
            }




            //example
            // AddText(300, 250, ' ชื่อ - นามสกุล 1 ');
            // AddText(100, 325, ' ชื่อ - นามสกุล 2');
            
        }
    }

}





$result = imagejpeg($img, __DIR__ . '/assets/img/report_page_0002.jpg', 100);

// Free up memory
imagedestroy($img);

return $result;

?>