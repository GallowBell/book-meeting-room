<?php

// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();

$html = "<h1>Meeting Room Booking Confirmation</h1>
<p><strong>Meeting Room:</strong> Conference Room A</p>
<p><strong>Date:</strong> 2023-10-15</p>
<p><strong>Time:</strong> 10:00 AM - 11:00 AM</p>
<p><strong>Attendees:</strong></p>
<ul>
    <li>John Doe</li>
    <li>Jane Smith</li>
    <li>Michael Brown</li>
</ul>";

// Write some HTML code:
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();

?>