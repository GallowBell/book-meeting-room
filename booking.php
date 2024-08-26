<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
  // Output SweetAlert2 JavaScript code
  echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redirecting</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "กรุณาเข้าสู่ระบบ",
                    icon: "warning",
                    confirmButtonText: "ตกลง"
                }).then(function() {
                    window.location.href = "pages-login.html";
                });
            });
        </script>
    </head>
    <body>
        <!-- Empty body, JavaScript will handle redirection -->
    </body>
    </html>';
  exit();
}

$username = $_SESSION['username'];
$userlevel = $_SESSION['userlevel'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'head.php';
  ?>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


  <style>
    .hide-calendar .ui-datepicker-calendar {
      display: none;
    }

    .fc-day-today {
      background: #F6FF97 !important;
    }

    .fc-day:hover {
      background: #72ACE7 !important;
      cursor: pointer;
    }

    .pagetitle button {
      font-size: 24px;
      margin-bottom: 0;
      font-weight: 600;
      color: #fff !important;
    }
  </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>

  <?php
  include 'header.php';
  include 'sidebar.php';
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>จองห้องประชุม</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
          <li class="breadcrumb-item"><a href="booking.php">จองห้อง</a></li>
          <li class="breadcrumb-item active">แบบฟอร์มการจองห้องประชุม</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">แบบฟอร์มการจองห้องประชุม</h5>


              <!-- General Form Elements -->
              <form action="process_reservation.php" method="post" class="row g-3 needs-validation" novalidate>
              <div class="col-md-6">
                  <label for="government_sector" class="form-label fw-bold fw-bold">ส่วนราชการ</label>
                  <input type="text" id="government_sector" name="government_sector" class="form-control" required>
                  <div class="invalid-feedback">
                    โปรดกรอกส่วนราชการ
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="document_number" class="form-label fw-bold fw-bold">เลขที่หนังสือ</label>
                  <input type="number" id="document_number" name="document_number" class="form-control">
                </div>
                <div class="col-md-6">
                  <label for="meeting_room" class="form-label fw-bold">ชื่อห้อง</label>
                  <select class="form-select" id="meeting_room" name="meeting_room" required>
                    <option selected disabled hidden value="" >เลือกห้อง...</option>
                    <option value="ห้องประชุมชั้น 4">ห้องประชุมชั้น 4</option>
                    <option value="ห้องประชุมชั้น 5">ห้องประชุมชั้น 5</option>
                    <option value="ห้องประชุมชั้น 9">ห้องประชุมชั้น 9</option>
                  </select>
                  <div class="invalid-feedback">
                    โปรดเลือกห้อง
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="meeting_name" class="form-label fw-bold">หัวข้อ</label>
                  <input type="text" id="meeting_name" name="meeting_name" class="form-control" required>
                  <div class="invalid-feedback">
                    โปรดกรอกหัวข้อ
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="meeting_type" class="form-label fw-bold">ใช้สำหรับ</label>
                  <select id="meeting_type" name="meeting_type" class="form-select" required>
                    <option selected disabled hidden value="">ใช้สำหรับการ...</option>
                    <option value="ฝึกอาชีพ">ฝึกอาชีพ</option>
                    <option value="อบรม">อบรม</option>
                    <option value="ประชุม">ประชุม</option>
                  </select>
                  <div class="invalid-feedback">
                    โปรดเลือกห้อง
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="participant_count" class="form-label fw-bold">จำนวนผู้เข้าร่วม</label>
                  <input type="number" id="participant_count" name="participant_count" class="form-control" required>
                  <div class="invalid-feedback">
                    โปรดกรอกจำนวนผู้เข้าร่วม
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="organizer_name" class="form-label fw-bold">ชื่อผู้จอง</label>
                  <input type="text" id="organizer_name" name="organizer_name" class="form-control" required>
                  <div class="invalid-feedback">
                    โปรดกรอกชื่อผู้จอง
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="contact_number" class="form-label fw-bold">เบอร์ติดต่อ</label>
                  <input type="text" id="contact_number" name="contact_number" maxlength="10" class="form-control" required>
                  <div class="invalid-feedback">
                    โปรดกรอกเบอร์โทรศัพท์
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="reservation_date" class="form-label fw-bold">วันที่จอง</label>
                  <input type="text" id="reservation_date" name="reservation_date" class="form-control bg-white" required>
                  <div class="invalid-feedback">
                    โปรดกรอกวันที่จอง
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="start_time" class="form-label fw-bold">เวลาเริ่มต้น</label>
                  <input type="time" id="start_time" name="start_time" class="form-control bg-white" required>
                  <div class="invalid-feedback">
                    โปรดกรอกเวลาจอง
                  </div>
                </div>

                <div class="col-md-3">
                  <label for="end_time" class="form-label fw-bold">เวลาสิ้นสุด</label>
                  <input type="time" id="end_time" name="end_time" class="form-control bg-white" required>
                  <div class="invalid-feedback">
                    โปรดกรอกเวลาจอง
                  </div>
                </div>

                <!-- CheckBox1 -->
                <div class="container mt-2">
                  <div class="col-md-12">
                    <label for="equipment" class="form-label fw-bold mt-2">อุปกรณ์</label>
                    <div>
                      <div class="border p-3 row">
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment1" name="equipment[0]" value="ชุดโต๊ะหมู่บูชา">
                          <label class="form-check-label" for="equipment1">
                            ชุดโต๊ะหมู่บูชา
                            <input class="inputint" type="number" name="equipment_qty[0]" size="1" height="20"> ชุด
                          </label>
                        </div>

                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment2" name="equipment[1]" value="จาน + ช้อนส้อม">
                          <label class="form-check-label" for="equipment2">
                            จาน + ช้อนส้อม จำนวน
                            <input class="inputint" type="number" name="equipment_qty[1]" size="1" height="20"> ใบ
                          </label>
                        </div>

                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment3" name="equipment[2]" value="ถาดเสิร์ฟ">
                          <label class="form-check-label" for="equipment3">
                            ถาดเสิร์ฟ จำนวน
                            <input class="inputint" type="number" name="equipment_qty[2]" size="1"> ใบ
                          </label>
                        </div>

                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment4" name="equipment[3]" value="จานแก้วใส">
                          <label class="form-check-label" for="equipment4">จานแก้วใส ขนาด</label>
                          <select class="inputint" id="equipment4" name="equipment_size_1">
                            <option value="" selected>เลือก</option>
                            <option value="ใหญ่">ใหญ่</option>
                            <option value="กลาง">กลาง</option>
                            <option value="เล็ก">เล็ก</option>
                          </select>
                          <label class="form-check-label" for="equipment4">จำนวน</label>
                          <input class="inputint" type="number" name="equipment_qty[3]" size="1" height="20"> ใบ
                        </div>

                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment5" name="equipment[4]" value="ช้อนเล็ก">
                          <label class="form-check-label" for="equipment5">
                            ช้อนเล็กจำนวน
                            <input class="inputint" type="number" name="equipment_qty[4]" size="1" height="20"> ชุด
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment6" name="equipment[5]" value="ส้อมเล็ก">
                          <label class="form-check-label" for="equipment6">
                            ส้อมเล็กจำนวน
                            <input class="inputint" type="number" name="equipment_qty[5]" size="1" height="20"> ชุด
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment7" name="equipment[6]" value="ชุดกาเเฟ">
                          <label class="form-check-label" for="equipment7">ชุดกาเเฟ (เเก้วกาเเฟ+จานรอง)</label>
                          <label class="form-check-label" for="equipment7">จำนวน</label>
                          <input class="inputint" type="number" name="equipment_qty[6]" size="1" height="20"> ชุด/วัน

                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment8" name="equipment[7]" value="ถ้วย">
                          <label class="form-check-label" for="equipment8">ถ้วย ขนาด </label>
                          <select class="inputint" id="equipment8" name="equipment_size_2">
                            <option value="" selected>เลือก</option>
                            <option value="ใหญ่">ใหญ่</option>
                            <option value="กลาง">กลาง</option>
                            <option value="เล็ก">เล็ก</option>
                          </select>
                          <label class="form-check-label" for="equipment8">จำนวน</label>
                          <input class="inputint" type="number" name="equipment_qty[7]" size="1" height="20"> ใบ
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment9" name="equipment[8]" value="เเก้วน้ำดื่ม">
                          <label class="form-check-label" for="equipment9">
                            เเก้วน้ำดื่ม จำนวน
                            <input class="inputint" type="number" name="equipment_qty[8]" size="1" height="20"> ใบ/วัน
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment10" name="equipment[9]" value="เหยือกน้ำ">
                          <label class="form-check-label" for="equipment10">
                            เหยือกน้ำ จำนวน
                            <input class="inputint" type="number" name="equipment_qty[9]" size="1" height="20"> ใบ
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment11" name="equipment[10]" value="คูลเลอร์ใส่น้ำดื่ม">
                          <label class="form-check-label" for="equipment11">
                            คูลเลอร์ใส่น้ำดื่ม จำนวน
                            <input class="inputint" type="number" name="equipment_qty[10]" size="1" height="20"> ใบ
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment12" name="equipment[11]" value="คูลเลอร์ใส่น้ำร้อน">
                          <label class="form-check-label" for="equipment12">
                            คูลเลอร์ใส่น้ำร้อน จำนวน
                            <input class="inputint" type="number" name="equipment_qty[11]" size="1" height="20"> ใบ
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment13" name="equipment[12]" value="กระติกน้ำเเข็ง">
                          <label class="form-check-label" for="equipment13">
                            กระติกน้ำเเข็ง จำนวน
                            <input class="inputint" type="number" name="equipment_qty[12]" size="1" height="20"> ใบ
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment14" name="equipment[13]" value="ผ้าปูโต๊ะ">
                          <label class="form-check-label" for="equipment14">
                            ผ้าปูโต๊ะ จำนวน
                            <input class="inputint" type="number" name="equipment_qty[13]" size="1" height="20"> ผืน
                          </label>
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment15" name="equipment[14]" value="ผ้าคลุมเก้าอี้">
                          <label class="form-check-label" for="equipment15">
                            ผ้าคลุมเก้าอี้ จำนวน
                            <input class="inputint" type="number" name="equipment_qty[14]" size="1" height="20"> ผืน
                          </label>
                        </div>
                        <div class="col-12 mb-2">
                          <input class="form-check-input" type="checkbox" id="equipment16" name="equipment[15]" value="ที่จอดรถชั้น">
                          <label class="form-check-label" for="equipment16">
                            ที่จอดรถ ชั้น
                            <input class="inputint d-inline-block" type="number" name="equipment_qty[15][floor]" size="1" height="20">
                            จำนวน
                            <input class="inputint d-inline-block" type="number" name="equipment_qty[15][qty]" size="1" height="20">
                            คัน
                            เลขทะเบียน
                            <input class="inputtext d-inline-block" type="text" name="equipment_qty[15][car_no]" size="1" height="20">
                          </label>
                        </div>
                        <div class="col-12 mt-2">
                          <input class="form-check-input" type="checkbox" id="equipment17" name="equipment[16]" value="อื่นๆ">
                          <label class="form-check-label" for="equipment17">อื่นๆ ระบุ </label>
                          <input class="inputtext" type="text" id="equipment17" name="equipment_details[16]" size="1" height="20">
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End CheckBox1 -->
                <div class="col-12">
                          <div class="input-group mt-3 mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default" for="notes">หมายเหตุ</span>
                            <input type="text" class="form-control" id="notes" name="notes">
                          </div>
                        </div>
                <div class="col-6 mt-3">
                  <a href="index.php" class="btn btn-danger">ย้อนกลับ</a>
                </div>
                <div class="col-6 mt-3 d-flex justify-content-end">
                  <button type="submit" class="btn btn-success">บันทึก</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer>
    <?php
    include 'footer.php';
    ?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>




  <style>
    .checkbox-group {
      border: 1px solid #ccc;
      padding: 15px;
      border-radius: 5px;
      margin: 8px;
    }

    .checkbox-group-title {
      /* font-size: 20px; */
      font-weight: bold;
      /* margin-bottom: 0.5rem; */
      /* margin-right: 1rem; */
    }

    .form-check-input {
      outline: 1px solid #CCC;
    }

    input[type='number'].inputint {
      width: 40px;
    }

    .inputint {
      /* border: none; */
      border: 1px solid #DCDCDC;
      box-shadow: 0 0 2px black;
      margin: 0px 5px 0px 5px;
    }

    .inputtext {
      /* border: none; */
      border: 1px solid #DCDCDC;
      box-shadow: 0 0 2px black;
      margin: 0px 5px 0px 5px;
      width: 20rem;
    }

    .inputtext:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* .form-check.form-check-inline {
            border-radius: 0.25rem;
        }
        .form-check.form-check-inline:hover {
          background: #007bff;
          color: white;
          transition: background-color 0.3s, color 0.3s;
        } */
  </style>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/th.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      flatpickr('#reservation_date', {
        altInput: true,
        //enableTime: true,
        altFormat: "j F Y",
        mode: "range",
        dateFormat: "Y-m-d",
        locale: "th",
        minDate: "today"
      });
      flatpickr('#start_time', {
        enableTime: true,
        noCalendar: true,
        altFormat: "H:i",
        dateFormat: "H:i:ss",
        time_24hr: true
      });
      flatpickr('#end_time', {
        enableTime: true,
        noCalendar: true,
        altFormat: "H:i",
        dateFormat: "H:i:ss",
        time_24hr: true
      });
    });
  </script>
</body>


</html>