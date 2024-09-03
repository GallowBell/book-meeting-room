<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/connection.php';

$xAxis = 0;
$yAxis = 0;

/**
 * @var string $img_path path to the image
 */
$img_path = __DIR__ . '/assets/img/report_page_0001.jpg';

$img_path3 = __DIR__ . '/assets/img/report_page_0003.jpg';

/**
 * @var string $second_img_path path to the image
 */
$second_img_path = __DIR__ . '/assets/img/checkmark.png'; // Path to the second image
$third_img_path = __DIR__ . '/assets/img/circlemark.png'; // Path to the second image

/**
 * @var string $font path to the font
 */
$font = __DIR__. '/font/th_sarabun/THSarabunNew.ttf';

/**
 * @var int $FontSize font size
 */
$FontSize = 40.5;

$img = imagecreatefromjpeg($img_path);
$img2 = imagecreatefromjpeg($img_path3);
$second_img = imagecreatefrompng($second_img_path);
$third_img = imagecreatefrompng($third_img_path);
$black = imagecolorallocate($img, 0, 0, 0);
$black2 = imagecolorallocate($img2, 0, 0, 0);

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

function AddCheckCircle($x, $y, $new_width, $new_height) {
    global $img, $third_img, $black, $font, $FontSize;

    // Define the position where the resized third image will be drawn
    $third_img_x = $x; // X position for the third image
    $third_img_y = $y; // Y position for the third image

    // Get the original width and height of the third image
    $third_img_width = imagesx($third_img);
    $third_img_height = imagesy($third_img);

    // Create a new true color image with the new dimensions
    $resized_img = imagecreatetruecolor($new_width, $new_height);

    // Preserve transparency for PNG images
    imagealphablending($resized_img, false);
    imagesavealpha($resized_img, true);

    // Fill the resized image with a transparent color
    $transparent = imagecolorallocatealpha($resized_img, 0, 0, 0, 127);
    imagefill($resized_img, 0, 0, $transparent);

    // Resize the third image
    imagecopyresampled(
        $resized_img,  // Destination image resource
        $third_img,    // Source image resource
        0, 0,          // Destination X, Y (top-left corner)
        0, 0,          // Source X, Y (top-left corner)
        $new_width, $new_height,  // Destination width, height
        $third_img_width, $third_img_height // Source width, height
    );

    // Draw the resized third image onto the main image
    imagecopy($img, $resized_img, $third_img_x, $third_img_y, 0, 0, $new_width, $new_height);

    // Free up memory by destroying the resized image resource
    imagedestroy($resized_img);
}



function AddText($x, $y, $text){
    global $img, $black2, $font, $FontSize;
    // Add text to the image
    imagettftext($img, $FontSize, 0, $x, $y, $black2, $font, $text);
}

function AddCheckBox2($x, $y){
    global $img2, $second_img, $black2, $font, $FontSize;
    // Define the position where the second image will be drawn
    $second_img_x = $x; // X position for the second image
    $second_img_y = $y; // Y position for the second image

    // Get the width and height of the second image
    $second_img_width = imagesx($second_img);
    $second_img_height = imagesy($second_img);

    // Draw the second image onto the first image
    imagecopy($img2, $second_img, $second_img_x, $second_img_y, 0, 0, $second_img_width, $second_img_height);
}

function AddText2($x, $y, $text){
    global $img2, $black2, $font, $FontSize;
    // Add text to the image
    imagettftext($img2, $FontSize, 0, $x, $y, $black2, $font, $text);
}

// Function to format date to Thai locale with full date style and convert year to BE
function formatThaiDate($date) {
    $formatter = new IntlDateFormatter(
        'th_TH', 
        IntlDateFormatter::LONG, 
        IntlDateFormatter::NONE, 
        'Asia/Bangkok', 
        IntlDateFormatter::GREGORIAN
    );
    
    // Format the date
    $formattedDate = $formatter->format(new DateTime($date));
    
    // Convert the year to BE
    $dateTime = new DateTime($date);
    $yearBE = $dateTime->format('Y') + 543;
    
    // Replace the year in the formatted date
    $formattedDate = str_replace($dateTime->format('Y'), $yearBE, $formattedDate);
    
    return $formattedDate;
}

function formatThaiDate2($date) {
    $formatter = new IntlDateFormatter(
        'th_TH', 
        IntlDateFormatter::MEDIUM, 
        IntlDateFormatter::NONE, 
        'Asia/Bangkok', 
        IntlDateFormatter::GREGORIAN
    );
    
    // Format the date
    $formattedDate = $formatter->format(new DateTime($date));
    
    // Convert the year to BE
    $dateTime = new DateTime($date);
    $yearBE = $dateTime->format('Y') + 543;
    
    // Replace the year in the formatted date
    $formattedDate = str_replace($dateTime->format('Y'), $yearBE, $formattedDate);
    
    return $formattedDate;
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

    WHERE  reservation_id = $reservation_id");

$data = $query -> fetch_all(MYSQLI_ASSOC);

if(count($data) == 0){
    die('Reservation data not found');
}

if ($data[0]['is_approve'] == -1 || $data[0]['is_approve'] == 0) {
    // Output the SweetAlert2 scripts
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
    window.onload = function() {
        Swal.fire({
            title: 'ไม่สามารถโหลดเอกสารได้',
            text: 'เนื่องจากสถานะยังไม่อนุมัติ',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'booking-report.php';
            }
        });
    };
    </script>";

    // Terminate the script after outputting the message
    exit;
}


// $data = ข้อมูลจากตาราง reservations
foreach ($data as $key_1 => $value_1) {

    $sql2 = "SELECT * FROM `equipment_reservations` WHERE reservation_id = ".$value_1['reservation_id'];
    $query = $conn->query($sql2);
    $equipment_reservations = $query->fetch_all(MYSQLI_ASSOC);

    
    $query = $conn->query("SELECT * FROM `equipment_sod_reservations` WHERE reservation_id = ".$value_1['reservation_id']);
    $equipment_sod_reservations = $query->fetch_all(MYSQLI_ASSOC);


    // X, Y, Text
    AddText(590, 370,  $value_1['government_sector']);
    AddText(1800, 370,  $value_1['contact_number']);
    AddText(505, 455,  $value_1['document_number']);
    AddText(590, 455,  '/'.(date('Y')+543));
    AddText(1400, 455,  formatThaiDate($value_1['Timestamps']));
    AddText(650, 740,  $value_1['government_sector']);
    AddText(1360, 1145,  $value_1['meeting_name']);
    AddText(630, 1285,  $value_1['participant_count']);
    //AddText(700, 1050, $thai_date . ' ถึง ' . $value_1['reservation_date_end']);
    // AddText(980, 1285,  formatThaiDate2($value_1['reservation_date']) . ' ถึง ' . formatThaiDate2($value_1['reservation_date_end']));
    AddText(
        980,
        1285,
        formatThaiDate2($value_1['reservation_date']) .
        ($value_1['reservation_date_end'] !== $value_1['reservation_date'] ? ' ถึง ' . formatThaiDate2($value_1['reservation_date_end']) : '')
    );
    
    AddText(1600, 1285,  $value_1['start_time']);
    AddText(1890, 1285,   $value_1['end_time']); 
    AddText(500, 1360,   $value_1['notes']); 

    // Adjust X and Y based on meeting_room
    if ($value_1['meeting_room'] == 'ห้องประชุมชั้น 4') {
        $x = 420;
        $y = 860;
    } elseif ($value_1['meeting_room'] == 'ห้องประชุมชั้น 5') {
        $x = 1135;
        $y = 860;
    } elseif ($value_1['meeting_room'] == 'ห้องประชุมชั้น 9') {
        $x = 420;
        $y = 940;
    }

    // Add the text with the adjusted X, Y coordinates
    AddCheckBox($x, $y);

    if ($value_1['meeting_type'] == 'ฝึกอาชีพ') {
        $x = 450;
        $y = 1100;
    } elseif ($value_1['meeting_type'] == 'อบรม') {
        $x = 690;
        $y = 1100;
    } elseif ($value_1['meeting_type'] == 'ประชุม') {
        $x = 865;
        $y = 1100;
    } elseif ($value_1['meeting_type'] == 'รับคณะ') {
        $x = 1055;
        $y = 1100;
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
                AddCheckBox(415, 1470);
            }
            if($value_3 == 'จาน + ช้อนส้อม'){
                AddCheckBox(415, 1550); //+80
                AddText(950, 1590,  $value_2['equipment_quantity']); //+80
            }
            if($value_3 == 'ถาดเสิร์ฟ'){
                AddCheckBox(1285, 1550);
                AddText(1700, 1590,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'จานแก้วใส'){
                AddCheckBox(415, 1630);
                if ($value_2['equipment_size'] == 'ใหญ่') {
                    AddCheckCircle(770, 1620, 90, 90);
                }
                if ($value_2['equipment_size'] == 'กลาง') {
                    AddCheckCircle(888, 1614, 100, 100);
                }
                if ($value_2['equipment_size'] == 'เล็ก') {
                    AddCheckCircle(1010, 1615, 90, 90);
                }
                AddText(1270, 1670,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'ช้อนเล็ก'){
                AddCheckBox(415, 1710);
                AddText(800, 1750,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'ส้อมเล็ก'){
                AddCheckBox(1285, 1710);
                AddText(1670, 1750,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'ชุดกาเเฟ'){
                AddCheckBox(415, 1785);
                AddText(1220, 1830,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'ถ้วย'){
                AddCheckBox(415, 1865);
                if ($value_2['equipment_size'] == 'ใหญ่') {
                    AddCheckCircle(640, 1850, 100, 100);
                }
                if ($value_2['equipment_size'] == 'กลาง') {
                    AddCheckCircle(760, 1850, 110, 110);
                }
                if ($value_2['equipment_size'] == 'เล็ก') {
                    AddCheckCircle(885, 1860, 90, 90);
                }
                AddText(1130, 1915,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'เเก้วน้ำดื่ม'){
                AddCheckBox(415, 1955);
                AddText(930, 1995,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'เหยือกน้ำ'){
                AddCheckBox(415, 2045);
                AddText(880, 2080,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'คูลเลอร์ใส่น้ำดื่ม'){
                AddCheckBox(1285, 2045);
                AddText(1830, 2080,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'คูลเลอร์ใส่น้ำร้อน'){
                AddCheckBox(415, 2125);
                AddText(940, 2160,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'กระติกน้ำเเข็ง'){
                AddCheckBox(1285, 2125);
                AddText(1810, 2160,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'ผ้าปูโต๊ะ'){
                AddCheckBox(415, 2210);
                AddText(840, 2240,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'ผ้าคลุมเก้าอี้'){
                AddCheckBox(1285, 2200);
                AddText(1800, 2240,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'อื่นๆ'){
                AddCheckBox(415, 2280);
                AddText(700, 2320,  $value_2['additional_details']);
            }
            if($value_3 == 'ที่จอดรถชั้น'){
                AddCheckBox(415, 2355);
                AddText(760, 2400,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'จำนวนคัน'){
                AddText(1100, 2400,  $value_2['equipment_quantity']);
            }
            if($value_3 == 'เลขทะเบียนรถ'){
                AddText(1490, 2400,  $value_2['equipment_quantity']);
            }

            //example
            // AddText(300, 250, ' ชื่อ - นามสกุล 1 ');
            // AddText(100, 325, ' ชื่อ - นามสกุล 2');
            
        }
    }


    // $equipment_sod_reservations = ข้อมูลจากตาราง equipment_sod_reservations
    foreach ($equipment_sod_reservations as $key_2 => $value_2) {
        foreach ($value_2 as $key_3 => $value_3) {

            AddText2(670, 470,  $value_1['government_sector']);
            AddText2(1800, 470,  $value_1['contact_number']);
            AddText2(620, 585,  $value_1['document_number']);
            AddText2(710, 585,  '/'.(date('Y')+543));
            AddText2(1500, 585,  formatThaiDate($value_1['Timestamps']));
            AddText2(1000, 880,  $value_1['government_sector']);

            AddText2(1500, 1235,  $value_1['meeting_name']);
            AddText2(730, 1335,  $value_1['participant_count']);
            //AddText(700, 1050, $thai_date . ' ถึง ' . $value_1['reservation_date_end']);
    
            AddText2(
                1100,
                1335,  
                formatThaiDate2($value_1['reservation_date']) .
                ($value_1['reservation_date_end'] !== $value_1['reservation_date'] ? ' ถึง ' . formatThaiDate2($value_1['reservation_date_end']) : '')
            );
            AddText2(1760, 1335,  $value_1['start_time']);
            AddText2(2080, 1335,   $value_1['end_time']); 

            if ($value_1['meeting_room'] == 'ห้องประชุมชั้น 4') {
                $x = 518;
                $y = 1010;
            } elseif ($value_1['meeting_room'] == 'ห้องประชุมชั้น 5') {
                $x = 1116;
                $y = 1010;
            } elseif ($value_1['meeting_room'] == 'ห้องประชุมชั้น 9') {
                $x = 518;
                $y = 1100;
            }
        
            // Add the text with the adjusted X, Y coordinates
            AddCheckBox2($x, $y);
        
            if ($value_1['meeting_type'] == 'ฝึกอาชีพ') {
                $x = 515;
                $y = 1195;
            } elseif ($value_1['meeting_type'] == 'อบรม') {
                $x = 757;
                $y = 1195;
            } elseif ($value_1['meeting_type'] == 'ประชุม') {
                $x = 946;
                $y = 1195;
            } elseif ($value_1['meeting_type'] == 'รับคณะ') {
                $x = 1163;
                $y = 1195;
            }
        
            // Add the text with the adjusted X, Y coordinates
            AddCheckBox2($x, $y);

            if($value_3 == 'ชุดเครื่องเสียงห้องประชุม'){
                AddCheckBox2(515, 1485);
            }
            if($value_3 == 'ชุดเครื่องเสียงนอกสถานที่'){
                AddCheckBox2(1415, 1485);
            }

            if($value_3 == 'เครื่องโปรเจคเตอร์'){
                AddCheckBox2(515, 1575);
            }
            if($value_3 == 'เครื่องเสียงลำโพงกระเป๋าหิ้ว'){
                AddCheckBox2(1416, 1575);
            }

            if($value_3 == 'เจ้าหน้าที่ควบคุม'){
                AddCheckBox2(515, 1665);
            }
            if($value_3 == 'เครื่องเสียงพกพาพร้อมไมโครโฟน'){
                AddCheckBox2(1416, 1665);
            }

            if($value_3 == 'การบันทึกเทปภาพบรรยาย'){
                AddCheckBox2(515, 1755);
            }
            if($value_3 == 'การบันทึกเทปเสียงบรรยาย'){
                AddCheckBox2(1416, 1755);
            }
            
            if($value_3 == 'การบันทึกภาพนิ่ง'){
                AddCheckBox2(515, 1845);
            }
            if($value_3 == 'การส่งข่าวประชาสัมพันธ์'){
                AddCheckBox2(1416, 1845);
            }

            if($value_3 == 'การประชุมออนไลน์'){
                AddCheckBox2(515, 1935);
                AddText2(1550, 1980,  $value_2['additional_sod_details']);
            }

            if($value_3 == 'พิธีกรดำเนินงาน (วัน/เวลา) ในวันที่'){
                AddCheckBox2(515, 2025);
                AddText2(1350, 2070,  formatThaiDate($value_2['operate_date']));
                AddText2(1950, 2070,  $value_2['operate_time']);
            }

            if($value_3 == 'ช่างภาพ (วัน/เวลา) ในวันที่'){
                AddCheckBox2(515, 2115);
                AddText2(1350, 2160,  formatThaiDate($value_2['operate_date_2']));
                AddText2(1950, 2160,  $value_2['operate_time_2']);
            }

            if($value_3 == 'เอกสารแจก'){
                AddCheckBox2(515, 2205);
                AddText2(965, 2245,  $value_2['additional_sod_details']);
                AddText2(2040, 2245,  $value_2['equipment_sod_quantity']);
            }

            if($value_3 == 'แฟ้มเอกสาร'){
                AddCheckBox2(515, 2295);
                AddText2(1050, 2335,  $value_2['equipment_sod_quantity']);
            }

            if($value_3 == 'เอกสารของที่ระลึก'){
                AddCheckBox2(1416, 2295);
                AddText2(2070, 2335,  $value_2['equipment_sod_quantity']);
            }
             
            if($value_3 == 'รถประชาสัมพันธ์เคลื่อนที่'){
                AddCheckBox2(515, 2385);
                AddText2(1070, 2425,  $value_2['additional_sod_details']);
            }

            if($value_3 == 'อื่นๆ'){
                AddCheckBox2(515, 2475);
                AddText2(800, 2515,  $value_2['additional_sod_details']);
            }
        }
    }

}





$result = imagejpeg($img, __DIR__ . '/assets/img/report_page_0002.jpg', 100);
$result2 = imagejpeg($img2, __DIR__ . '/assets/img/report_page_0004.jpg', 100);

// Free up memory
imagedestroy($img);

return $result;

?>