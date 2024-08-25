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

//ชือ - นามสกุุล
AddText(300, 250, ' ชื่อ - นามสกุล 1 ');
AddText(100, 325, ' ชื่อ - นามสกุล 2');

AddCheckBox(200, 800);
AddCheckBox(200, 1000);
AddCheckBox(200, 1200);


$result = imagejpeg($img, __DIR__ . '/assets/img/report_page_0002.jpg', 100);

// Free up memory
imagedestroy($img);

return $result;

?>