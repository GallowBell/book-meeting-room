<?php

include 'connection.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* header('Content-Type: application/json');

echo json_encode($_POST);
return; */

session_start();
$user_id = $_SESSION['user_id'];
$government_sector = $_POST['government_sector'];
$document_number = $_POST['document_number'];
$meeting_room = $_POST['meeting_room'];
$meeting_name = $_POST['meeting_name'];
$meeting_type = $_POST['meeting_type'];
$participant_count = $_POST['participant_count'];
$organizer_name = $_POST['organizer_name'];
$contact_number = $_POST['contact_number'];
$r_date = explode(" ถึง ", $_POST['reservation_date']);
$reservation_date = $r_date[0];
/**
 * เอาไปใส่ database วันที่สิ้นสุด
 * @var string $reservation_date_end
 */
$reservation_date_end = isset($r_date[1]) ? $r_date[1] : $reservation_date;
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];


$equipment = isset($_POST['equipment']) ? $_POST['equipment'] : [];
$equipment_qty = isset($_POST['equipment_qty']) ? $_POST['equipment_qty'] : [];
$equipment_details = isset($_POST['equipment_details']) ? $_POST['equipment_details'] : [];
$equipment_size = isset($_POST['equipment_size']) ? $_POST['equipment_size'] : [];
$equipment_dates = isset($_POST['equipment_date']) ? $_POST['equipment_date'] : [];
$equipment_start_times = isset($_POST['equipment_start_time']) ? $_POST['equipment_start_time'] : [];
$equipment_end_times = isset($_POST['equipment_end_time']) ? $_POST['equipment_end_time'] : [];
$notes = $_POST['notes'];
$equipment_size_1 = isset($_POST['equipment_size_1']) ? $_POST['equipment_size_1'] : "";
$equipment_size_2 = isset($_POST['equipment_size_2']) ? $_POST['equipment_size_2'] : "";


// booking-sod.php
$equipment_sod = isset($_POST['equipment_sod']) ? $_POST['equipment_sod'] : [];
$equipment_sod_qty = isset($_POST['equipment_sod_qty']) ? $_POST['equipment_sod_qty'] : [];
$equipment_sod_details = isset($_POST['equipment_sod_details']) ? $_POST['equipment_sod_details'] : [];
// $equipment_sod_size = isset($_POST['equipment_sod_size']) ? $_POST['equipment_sod_size'] : [];
$equipment_sod_dates = isset($_POST['equipment_sod_date']) ? $_POST['equipment_sod_date'] : [];
$equipment_sod_start_times = isset($_POST['equipment_sod_start_time']) ? $_POST['equipment_sod_start_time'] : [];
$equipment_sod_end_times = isset($_POST['equipment_sod_end_time']) ? $_POST['equipment_sod_end_time'] : [];
// $notes = $_POST['notes'];
// $equipment_sod_size_1 = isset($_POST['equipment_size_1']) ? $_POST['equipment_size_1'] : "";
// $equipment_sod_size_2 = isset($_POST['equipment_size_2']) ? $_POST['equipment_size_2'] : "";

function InsertCar($equipment_qty = [], $equipment = '')
{
    global $conn,
        $eq_date,
        $eq_start_time,
        $eq_end_time,
        $reservation_date_end,
        $reservation_id;

    $r = [];
    foreach ($equipment_qty as $key => $value) {

        if ($key == 'floor') {
            $equipment = 'ที่จอดรถชั้น';
        }
        if ($key == 'qty') {
            $equipment = 'จำนวนคัน';
        }
        if ($key == 'car_no') {
            $equipment = 'เลขทะเบียนรถ';
        }
        // sod
        if ($key == 'date') {
            $equipment = 'ในวันที่';
        }
        if ($key == 'time') {
            $equipment = 'เวลา';
        }

        if ($value > 0  /*|| !empty($details) ||  !empty($size)*/) {
            $equipment_full_name = $equipment;
            $sql_insert_equipment = "INSERT INTO equipment_reservations (
                                                                        reservation_id,
                                                                        equipment_name,
                                                                        equipment_size,
                                                                        equipment_quantity,
                                                                        additional_details,
                                                                        reservation_date,
                                                                        reservation_date_end,
                                                                        start_time,
                                                                        end_time
                                                                )  VALUES (
                                                                    $reservation_id,
                                                                    '$equipment_full_name',
                                                                    '',
                                                                    '$value',
                                                                    '',
                                                                    '$eq_date',
                                                                    '$reservation_date_end',
                                                                    '$eq_start_time',
                                                                    '$eq_end_time')";

            $conn->query($sql_insert_equipment);
            $r[] = $sql_insert_equipment;
        }
    }
    //echo json_encode($r);
}

///ส่วนที่ 3 line แจ้งเตือน
function sendlinemesg($message=''){

    define('LINE_API', "https://notify-api.line.me/api/notify");
    define('LINE_TOKEN', "NcwsmJ87U6cXVYs8Lnbz8yGJeGLbRAos5zk1R4FPBwP"); //เปลี่ยนใส่ Token ของเราที่นี่  hT7YEphAiMRjuSyaejk7AoWJgZyfAA9e7AH2eJ8wFUL
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://notify-api.line.me/api/notify',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('message' => $message),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.LINE_TOKEN
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
   
}

function InsertEquipment($tableName = '', $equipment=[]){
    global $conn,
    $equipment_size_1,
    $equipment_size_2,
    $reservation_id,
    $equipment_qty,
    $equipment_details,
    $equipment_dates,
    $reservation_date,
    $equipment_start_times,
    $equipment_end_times,
    $start_time,
    $end_time,
    $reservation_date_end;

     // Iterate over the arrays using foreach
     foreach ($equipment as $i => $equipment_name) {
        $size = "";

        // Check if the current index is 15
        if ($i == 15) {
            // Output equipment quantity as JSON and exit
            InsertCar($equipment_qty[$i], $equipment[$i]);
            continue;
        }

        // Retrieve other details, ensuring they are properly set
        $qty = !empty($equipment_qty[$i]) ? $equipment_qty[$i] : 0;
        $details = !empty($equipment_details[$i]) ? $equipment_details[$i] : '';

        // Determine the size based on equipment type
        switch ($equipment_name) {
            case "จานแก้วใส":
                $size = $equipment_size_1;
                break;
            case "ถ้วย":
                $size = $equipment_size_2;
                break;
            default:
                $size = '';
                break;
        }

        // Default values if not set
        $eq_date = !empty($equipment_dates[$i]) ? $equipment_dates[$i] : $reservation_date;
        $eq_start_time = !empty($equipment_start_times[$i]) ? $equipment_start_times[$i] : $start_time;
        $eq_end_time = !empty($equipment_end_times[$i]) ? $equipment_end_times[$i] : $end_time;

        // Insert into database if quantity is greater than 0
        if ($qty > 0 || $i == 16) {
            $equipment_full_name = $equipment_name;
            $sql_insert_equipment = "INSERT INTO ".$tableName." (reservation_id, equipment_name, equipment_size, equipment_quantity, additional_details, reservation_date, reservation_date_end, start_time, end_time)
                                    VALUES ($reservation_id, '$equipment_full_name', '$size', $qty, '$details', '$eq_date', '$reservation_date_end', '$eq_start_time', '$eq_end_time')";
            $conn->query($sql_insert_equipment);
        }
    }
}

// ตรวจสอบการจองซ้อนทับ
$sql_check = "SELECT * FROM reservations 
              WHERE meeting_room = '$meeting_room' 
              AND (
                  (reservation_date <= '$reservation_date_end' AND reservation_date_end >= '$reservation_date') 
                  AND ((start_time <= '$end_time' AND end_time >= '$start_time'))
              )";

$result = $conn->query($sql_check);
//echo "row".$result->num_rows;
if ($result->num_rows > 0) {
    echo "<script>
            window.onload = function() {
                alert('ไม่สามารถจองได้เนื่องจากเวลาที่คุณเลือกทับซ้อนกับการจองอื่นแล้ว.');
                window.location.href = 'booking.php';
            };
          </script>";
} else {
    // ถ้าไม่มีการจองซ้อนทับ ให้บันทึกการจองใหม่ในตาราง reservations
    $sql_insert = "INSERT INTO reservations (
                                            government_sector,
                                            document_number,
                                            meeting_room,
                                            meeting_name,
                                            meeting_type,
                                            participant_count,
                                            organizer_name,
                                            contact_number,
                                            reservation_date,
                                            reservation_date_end,
                                            start_time,
                                            end_time,
                                            notes,
                                            user_id
                                        ) VALUES (
                                            '$government_sector',
                                            '$document_number',
                                            '$meeting_room',
                                            '$meeting_name',
                                            '$meeting_type',
                                            $participant_count,
                                            '$organizer_name',
                                            '$contact_number',
                                            '$reservation_date',
                                            '$reservation_date_end',
                                            '$start_time',
                                            '$end_time',
                                            '$notes',
                                            '$user_id'
                                        )";


    if ($conn->query($sql_insert) === TRUE) {
        $success = true; // การจองสำเร็จ

        // รับค่า reservation_id ของการจองที่เพิ่งบันทึก
        $reservation_id = $conn->insert_id;


        // Ensure that all arrays have the same count
        $equipmentCount = count($equipment);

        InsertEquipment('equipment_reservations', $equipment);

        // Retrieve data from POST request
        $result = [];
        // Loop through the parameters
        foreach ($equipment_sod as $index => $equipment_name) {
            // Check if index is 10 or 13
            //if ($index == 10 || $index == 13) {
                if($equipment_name == 'on'){
                    continue;
                }

                $quantity = isset($equipment_sod_qty[$index]) ? $equipment_sod_qty[$index] : 0;
                $details = isset($equipment_sod_details[$index]) && !is_array($equipment_sod_details[$index]) ? $equipment_sod_details[$index] : null;

                $operate_date = isset($equipment_sod_details[14]['date']) ? $equipment_sod_details[14]['date'] : null;
                $operate_time = isset($equipment_sod_details[14]['time']) ? $equipment_sod_details[14]['time'] : null;
                $operate_date_2 = isset($equipment_sod_details[15]['date']) ? $equipment_sod_details[15]['date'] : null;
                $operate_time_2 = isset($equipment_sod_details[15]['time']) ? $equipment_sod_details[15]['time'] : null;

                $result[] = $conn->query("INSERT INTO equipment_sod_reservations (
                    reservation_id,
                    equipment_sod_name,
                    equipment_sod_quantity,
                    additional_sod_details,
                    operate_date,
                    operate_time,
                    operate_date_2,
                    operate_time_2
                ) VALUES (
                    '$reservation_id',
                    '$equipment_name',
                    '$quantity',
                    '$details',
                    '$operate_date',
                    '$operate_time',
                    '$operate_date_2',
                    '$operate_time_2'
                )");

           // }
        }

        // Set parameters and execute
        //$reservation_id = NULL; // Set this to the actual reservation_id if available

        ///ส่วนที่ 1 line แจ้งเตือน จัดเรียงข้อความที่จะส่งเข้า line ไว้ในตัวแปร $message
        $header = 'มีผู้ใช้ขอจองห้องประชุม';
        $message =
            $header .
            "\n" .
            'ชื่อผู้จอง: ' .
            $organizer_name .
            "\n" .
            'จองห้อง: ' .
            $meeting_room .
            "\n" .
            'ชื่อการประชุม: ' .
            $meeting_name .
            "\n" .
            'วันที่จอง: ' .
            $reservation_date . 'ถึง' . $reservation_date_end .
            "\n" .
            'เวลาที่จอง: ' .
            $start_time . 'ถึง' . $end_time .
            "\n" .
            'เบอร์: ' .
            $contact_number .
            "\n" .
            'หมายเหตุ: ' .
            $notes .
            "\n" . 
            'ไปที่เว็บไซต์: ' .
            'https://7aro.xdark-protocol.com/' ;
            

        ///ส่วนที่ 2 line แจ้งเตือน  ส่วนนี้จะทำการเรียกใช้ function sendlinemesg() เพื่อทำการส่งข้อมูลไปที่ line
        $line_r = sendlinemesg($message);
        $js = "var data = " . json_encode([
            'result' => $result,
            'post' => $_POST,
        ]) . "; console.log(data);";
        echo "<script>
            $js
            window.onload = function() {
                alert('การจองห้องประชุมสำเร็จ!');
                //window.location.href = 'index.php';
            };
        </script>";
        
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

//     $user_id = $_SESSION['user_id'];
// $government_sector = $_POST['government_sector'];
// $document_number = $_POST['document_number'];
// $meeting_room = $_POST['meeting_room'];
// $meeting_name = $_POST['meeting_name'];
// $meeting_type = $_POST['meeting_type'];
// $participant_count = $_POST['participant_count'];
// $organizer_name = $_POST['organizer_name'];
// $contact_number = $_POST['contact_number'];
// $r_date = explode(" ถึง ", $_POST['reservation_date']);
// $reservation_date = $r_date[0];
// /**
//  * เอาไปใส่ database วันที่สิ้นสุด
//  * @var string $reservation_date_end
//  */
// $messages = $_POST['message'];
// $reservation_date_end = isset($r_date[1]) ? $r_date[1] : $reservation_date;
// $start_time = $_POST['start_time'];
// $end_time = $_POST['end_time'];








/* function notify_message($message)
{
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData, '', '&');
    $headerOptions = array(
        'http' => array(
            'method' => 'POST',
            'header' => [
                "Content-Type: application/x-www-form-urlencoded"
                "Authorization: Bearer " . LINE_TOKEN,
            ],
            'content' => $queryData
        )
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API, FALSE, $context);
    $res = json_decode($result);
    return $res;
} */

    //echo json_encode($_POST);
}

$conn->close();
