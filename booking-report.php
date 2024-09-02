<?php

session_start();

require_once __DIR__ . '/connection.php';

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

// โค้ดสำหรับผู้ที่เข้าสู่ระบบแล้ว
$username = $_SESSION['username'];
$userlevel = $_SESSION['userlevel'];

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query ข้อมูลจากตาราง reservations
$sql = "SELECT * FROM `reservations` ";

if ($userlevel == 'user') {
  $sql .= " WHERE `user_id` = '" . $_SESSION['user_id'] . "' ";
}

$sql .= " ORDER BY `reservation_id` DESC ";

$result = $conn->query($sql);

// ดึงข้อมูลทั้งหมดเป็นอาเรย์
$data = $result->fetch_all(MYSQLI_ASSOC);

foreach ($data as $key => $value) {
  $sql2 = "SELECT * FROM `equipment_reservations` WHERE reservation_id = " . $value['reservation_id'];
  $query = $conn->query($sql2);
  $data[$key]['equipment_reservations'] = $query->fetch_all(MYSQLI_ASSOC);

  $query = $conn->query("SELECT * FROM `equipment_sod_reservations` WHERE reservation_id = " . $value['reservation_id']);
  $data[$key]['equipment_sod_reservations'] = $query->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'head.php';
  ?>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<body>


  <?php
  include 'header.php';
  include 'sidebar.php';
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>รายงานการจองห้องประชุม</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">รายงาน</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <!-- รายงานการจอง -->
          <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <!-- <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div> -->

              <div class="card-body">
                <h5 class="card-title">รายงาน <span>| การจอง</span></h5>

                <div class="table-responsive w-100">
                  <table class="table table-striped datatable">
                    <thead>
                      <tr>
                        <th scope="col" class="text-truncate">ID</th>
                        <!-- <th scope="col" class="text-truncate">ส่วนราชการ</th> -->
                        <th scope="col" class="text-truncate">เรื่อง</th>
                        <th scope="col" class="text-truncate">ห้องที่จอง</th>
                        <th scope="col" class="text-truncate">ชื่อผู้จอง</th>
                        <th scope="col" class="text-truncate">วันที่ (ว/ด/ป)</th>
                        <th scope="col" class="text-truncate">เวลาที่จอง</th>
                        <th scope="col" class="text-truncate">สถานะ</th>
                        <!-- <th scope="col" class="text-truncate">หมายเหตุ</th> -->
                        <th scope="col" class="text-truncate">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($data as $row):
                        $date = new DateTime($row["reservation_date"]);

                        // แปลงวันที่ให้เป็นรูปแบบ dd:mm:yyyy
                        $formatted_date = $date->format('d/m/');

                        // แปลงปีเป็น พ.ศ.
                        $thai_year = $date->format('Y') + 543;

                        // แปลงวันที่ reservation_date_end
                        $end_date = new DateTime($row["reservation_date_end"]);
                        $formatted_end_date = $end_date->format('d/m/');
                        $thai_year_end = $end_date->format('Y') + 543;

                        // ตรวจสอบว่าเวลาเป็น 00:00:00 หรือไม่
                        $is_midnight = $end_date->format('H:i:s') === '00:00:00';
                      ?>


                        <tr>
                          <td scope="row">
                            <a href="#">
                              <?= htmlspecialchars($row["reservation_id"]) ?>
                            </a>
                          </td>
                          <!-- <td class="text-truncate">
                            <?= htmlspecialchars($row["government_sector"]) ?>
                          </td> -->
                          <td class="text-truncate">
                            <?= htmlspecialchars($row["meeting_name"]) ?>
                          </td>
                          <td class="text-truncate">
                              <span class="<?php 
                              if ($row["meeting_room"] == "ห้องประชุมชั้น 4") {
                                  echo 'badge rounded-pill bg-success fs-6 text-white';  // สีเขียว
                              } elseif ($row["meeting_room"] == "ห้องประชุมชั้น 5") {
                                  echo 'badge rounded-pill bg-primary fs-6 text-white';  // สีฟ้า
                              } elseif ($row["meeting_room"] == "ห้องประชุมชั้น 9") {
                                  echo 'badge rounded-pill bg-danger fs-6 text-white';  // สีแดง
                              }
                          ?>"><?= htmlspecialchars($row["meeting_room"]) ?></span>
                          </td>
                          <td class="text-truncate">
                            <?= htmlspecialchars($row["organizer_name"]) ?>
                          </td>

                          <td class="text-truncate">
                              <?= htmlspecialchars($formatted_date . $thai_year) ?>
                              <?php if ($formatted_end_date !== $formatted_date): ?>
                                  ถึง <?= htmlspecialchars($formatted_end_date . $thai_year_end) ?>
                              <?php endif; ?>
                          </td>
                          <td class="text-truncate">
                            <?php
                            $start_time = new DateTime($row["start_time"]);
                            $end_time = new DateTime($row["end_time"]);
                            ?>
                            <?= htmlspecialchars($start_time->format('H:i')) ?> น. ถึง <?= htmlspecialchars($end_time->format('H:i')) ?> น.</td>
                          <td class="text-truncate">
                            <?php
                            $is_disabled = false;
                            if ($row["is_approve"] == -1) :
                            ?>
                              <span class="badge rounded-pill bg-warning fs-6">รออนุมัติ</span>
                            <?php
                            elseif ($row["is_approve"] == 0) :
                              $is_disabled = true;
                            ?>
                              <span class="badge rounded-pill bg-danger fs-6">ไม่อนุมัติ</span>
                            <?php
                            elseif ($row["is_approve"] == 1) :
                              $is_disabled = true;
                            ?>
                              <span class="badge rounded-pill bg-success fs-6">อนุมัติ</span>
                            <?php
                            endif;
                            ?>
                          </td>
                          <!-- <td class="text-truncate"><?= htmlspecialchars($row["notes"]) ?></td> -->
                          <td class="text-truncate">
                            <div class="btn-group-sm" role="group">
                              <?php
                              if ($_SESSION['userlevel'] == 'admin') :
                              ?>
                                <button type="button" class="btn btn-success" <?php echo $is_disabled ? ' disabled ' : ''; ?> onclick="handlerApprove(`<?= $row['reservation_id'] ?>`)">
                                  ✔
                                </button>
                                <button type="button" class="btn btn-danger" <?php echo $is_disabled ? ' disabled ' : ''; ?> onclick="handlerReject(`<?= $row['reservation_id'] ?>`)">
                                  ✖
                                </button>
                                <button type="button" class="btn btn-warning" <?php echo $is_disabled ? ' disabled ' : ''; ?> onclick="handlerDelete(`<?= $row['reservation_id'] ?>`)">
                                  <i class="bi bi-trash"></i>
            </button>
                              <?php
                              endif;
                              ?>
                              <button type="button" class="btn btn-primary" <?php echo $is_disabled ?: ''; ?>
                                data-bs-toggle="modal"
                                data-bs-target="#reportModal"
                                data-reservation-id="<?= $row['reservation_id'] ?>">
                                <i class="bi bi-eye"></i>
                              </button>

                            </div>
                          </td>

                          <!-- <td>
                              <div class="btn-group btn-group" role="group" aria-label="">
                              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reportModal"">✔</button>
                              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reportModal"">✖</button>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal""><i class="fw-bold bi bi-eye"></i></button>
                            </div>
                            </td> -->

                          <!-- <td><button type="button" class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#reportModal">✔</button></td>
                            <td><button type="button" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal" data-bs-target="#reportModal"><i class="fw-bold bi bi-x"></i></button></td>
                            <td><button type="button" class="btn btn-primary btn-sm text-white" data-bs-toggle="modal" data-bs-target="#reportModal"><i class="fw-bold bi bi-eye"></i></button></td> -->
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

              </div>

            </div>
          </div>
          <!-- รายงานการจอง -->

        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Modal HTML -->
  <div class="modal" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModal2_header">รายละเอียดการจอง</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <form class="row" id="viewForm" action="" method="post">
                <input type="hidden" id="reservation_id" name="reservation_id">
                <div class="col-md-6 mb-3">
                  <label for="government_sector" class="form-label">ส่วนราชการ</label>
                  <textarea class="form-control" name="government_sector" id="government_sector" disabled></textarea>
                  <!-- <input type="text" class="form-control" id="government_sector" name="government_sector" disabled> -->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="document_number" class="form-label">เลขที่หนังสือ</label>
                  <input type="text" class="form-control" id="document_number" name="document_number" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="meeting_name" class="form-label">เรื่อง</label>
                  <textarea class="form-control" name="meeting_name" id="meeting_name" disabled></textarea>
                  <!-- <input type="text" class="form-control" id="meeting_name" name="meeting_name" disabled> -->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="meeting_room" class="form-label">ห้องที่จอง</label>
                  <input type="text" class="form-control" id="meeting_room" name="meeting_room" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="meeting_type" class="form-label">ประเภท</label>
                  <input type="text" class="form-control" id="meeting_type" name="meeting_type" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="participant_count" class="form-label">จำนวนผู้เข้าร่วม</label>
                  <input type="text" class="form-control" id="participant_count" name="participant_count" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="organizer_name" class="form-label">ชื่อผู้จอง</label>
                  <input type="text" class="form-control" id="organizer_name" name="organizer_name" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="contact_number" class="form-label">เบอร์ติดต่อ</label>
                  <input type="text" class="form-control" id="contact_number" name="contact_number" disabled>
                </div>
                <!-- <div class="col-md-6 mb-3">
            <label for="reservation_date" class="form-label">วันที่</label>
            <input type="date" class="form-control" id="reservation_date" name="reservation_date" disabled>
          </div> -->
                <div class="col-md-6 mb-3">
                  <label for="reservation_date" class="form-label">วันที่เริ่มต้น</label>
                  <input type="date" class="form-control" id="reservation_date" name="reservation_date" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="reservation_date_end" class="form-label">วันที่สิ้นสุด</label>
                  <input type="date" class="form-control" id="reservation_date_end" name="reservation_date_end" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="start_time" class="form-label">เวลาที่จองเริ่มต้น</label>
                  <input type="time" class="form-control" id="start_time" name="start_time" disabled>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="end_time" class="form-label">เวลาที่จองสิ้นสุด</label>
                  <input type="time" class="form-control" id="end_time" name="end_time" disabled>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="notes" class="form-label">หมายเหตุ</label>
                  <textarea class="form-control" id="notes" name="notes" disabled></textarea>
                </div>

                <!-- เพิ่มส่วนแสดงผลข้อมูล equipment_reservations -->
                <div class="col-md-12 mb-3">
                  
                  <div class="equipment-section" id="myModal2_body">


                  </div>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">ปิด</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  include 'footer.php';
  ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var reportModal = document.getElementById('reportModal');
      reportModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // ปุ่มที่ถูกคลิก
        var reservationId = button.getAttribute('data-reservation-id'); // ดึง reservation_id จากปุ่ม

        // ส่ง request ไปยัง PHP เพื่อนำข้อมูล reservation มาแสดงใน Modal
        var formData = new FormData();
        formData.append('reservation_id', reservationId);

        // ค้นหาข้อมูลที่ต้องเติมในฟอร์ม
        var data = JSON.parse(data_json).find(row => row.reservation_id == reservationId);
        console.log('data a a', data);
        if (data) {
          // เติมข้อมูลในฟอร์ม
          document.getElementById('reservation_id').value = data.reservation_id;
          document.getElementById('government_sector').value = data.government_sector;
          document.getElementById('document_number').value = data.document_number;
          document.getElementById('meeting_room').value = data.meeting_room;
          document.getElementById('meeting_name').value = data.meeting_name;
          document.getElementById('meeting_type').value = data.meeting_type;
          document.getElementById('participant_count').value = data.participant_count;
          document.getElementById('organizer_name').value = data.organizer_name;
          document.getElementById('contact_number').value = data.contact_number;
          document.getElementById('reservation_date').value = data.reservation_date;
          document.getElementById('reservation_date_end').value = data.reservation_date_end;
          document.getElementById('start_time').value = data.start_time;
          document.getElementById('end_time').value = data.end_time;
          document.getElementById('notes').value = data.notes;
          Render_equipment_reservations(data);
        }

      });
    });

    function Render_equipment_reservations(data = {}) {
      const body = document.getElementById('myModal2_body');
      const title = document.getElementById('myModal2_header');
      console.log('data Render_equipment_reservations', data);
      const arr = data?.equipment_reservations;
      const equipment_sod_reservations = data?.equipment_sod_reservations;
      const meeting_name = data?.meeting_name;
      const reservation_id = data?.reservation_id;
      body.innerHTML = '';
      title.innerHTML = `รายละเอียดการจอง: ${data?.meeting_room}`;
      const start_d = (new Date(data?.start_d)).toLocaleString('th-TH', {
        dateStyle: 'full',
      });
      const end_d = (new Date(data?.end_d)).toLocaleString('th-TH', {
        dateStyle: 'full',
      });
      const start_t = (new Date(data?.start_d)).toLocaleString('th-TH', {
        timeStyle: 'short'
      });
      const end_t = (new Date(data?.end_d)).toLocaleString('th-TH', {
        timeStyle: 'short'
      });

      // set ข้อมูลจาก reservations
      let html = `
      <div class="row">
            <div class="col-12">
              <div class="card">
                  <a class="btn btn-primary fs-5" href="generate-pdf.php?reservation_id=${reservation_id}" target="_blank">
                    ดาวน์โหลดเอกสาร
                  </a>
              </div>
            </div>
          </div>
          <h5>รายการอุปกรณ์ที่จอง</h5>
          `;

      // หัวตาราง
      html += `
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" >#</th>
                  <th scope="col" >ชื่ออุปกรณ์</th>
                  <th scope="col" >จำนวน</th>

                  <th scope="col" >รายละเอียด</th>
                </tr>
              </thead>
              <tbody>
          `;

      // ข้อมูลจาก equipment_reservations loop
      arr?.forEach((item, index) => {
        html += `
              <tr>
                <td scope="row">
                  ${index + 1}
                </td>
                <td>${item?.equipment_name}</td>
                <td>${item?.equipment_quantity}</td>

                <td>${item?.equipment_size}${item?.additional_details}</td>
              </tr>
            `;
      });

      html += `
              </tbody>
            </table>
                <div class="col-md-12 mt-5 mb-3">
                  <h5>รายการอุปกรณ์ที่ขอใช้โสตทัศนูปกรณ์</h5>
                </div>
          `;

          // หัวตาราง
      html += `
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" >#</th>
                  <th scope="col" >ชื่ออุปกรณ์</th>
                  <th scope="col" >จำนวน</th>
                  <th scope="col" >รายละเอียด</th>
                </tr>
              </thead>
              <tbody>
          `;

      // ข้อมูลจาก equipment_reservations loop
      equipment_sod_reservations?.forEach((item, index) => {

        let detail = item?.additional_sod_details;
        let is_operate_date;

        console.log('item sod', item);

        switch (item?.equipment_sod_name) {
          case 'พิธีกรดำเนินงาน (วัน/เวลา) ในวันที่':
            is_operate_date = formatThaiDateTime(`${item?.operate_date} ${item?.operate_time}`);
            break;
          case 'ช่างภาพ (วัน/เวลา) ในวันที่':
            is_operate_date = formatThaiDateTime(`${item?.operate_date_2} ${item?.operate_time_2}`);
            break;
          default:
            is_operate_date = detail;
            break;
        }
        
        html += `
              <tr>
                <td scope="row">
                  ${index + 1}
                </td>
                <td>${item?.equipment_sod_name}</td>
                <td>${item?.equipment_sod_quantity == 0 ? '' : item?.equipment_sod_quantity}</td>
                <td>${is_operate_date}</td>
              </tr>
            `;
      });

      html += `
              </tbody>
            </table>
          `;




      body.innerHTML = html;
    }
  </script>

  <script>
    var data_json = `<?php echo json_encode($data, JSON_UNESCAPED_UNICODE); ?>`
    document.addEventListener("DOMContentLoaded", function() {
      /* Swal.fire({
          title: "กรุณาเข้าสู่ระบบ",
          icon: "warning",
          confirmButtonText: "ตกลง"
      }) */
      console.table(JSON.parse(data_json))
    })

    function handlerApprove(reservation_id) {
      console.log('handlerApprove id', reservation_id)
      Swal.fire({
        icon: 'question',
        title: 'ยืนยันการการจอง',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ย้อนกลับ',
      }).then((result) => {
        if (!result.isConfirmed) {
          return;
        }
        SendApprove(reservation_id, 'approve')
          .then((result) => {
            console.log('result', result);
            if (result.status == 200) {
              Swal.fire({
                icon: 'success',
                title: 'อนุมัติการจองเรียบร้อยแล้ว'
              }).then(() => {
                location.reload();
              });
              return;
            }
            throw new Error(result?.message ? result?.message : 'มีบางอย่างผิดพลาด')
          }).catch((err) => {
            console.log('err', err);
            Swal.fire({
              title: 'เกิดข้อผิดพลาด',
              text: 'โปรดลองใหม่อีกครั้ง ' + error,
              icon: 'error',
              confirmButtonText: 'ตกลง'
            })
          });
      });
    }

    function handlerReject(reservation_id) {
      console.log('handlerReject id', reservation_id)
      Swal.fire({
        icon: 'question',
        title: 'ไม่อนุมัติการจอง',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ย้อนกลับ',
      }).then((result) => {
        if (!result.isConfirmed) {
          return;
        }
        SendApprove(reservation_id, 'reject')
          .then((result) => {
            console.log('result', result);
            if (result.status == 200) {
              Swal.fire({
                icon: 'success',
                title: 'ไม่อนุมัติการจองเรียบร้อยแล้ว'
              }).then(() => {
                location.reload();
              });
              return;
            }
            throw new Error(result?.message ? result?.message : 'มีบางอย่างผิดพลาด')
          }).catch((err) => {
            console.log('err', err);
            Swal.fire({
              title: 'เกิดข้อผิดพลาด',
              text: 'โปรดลองใหม่อีกครั้ง ' + error,
              icon: 'error',
              confirmButtonText: 'ตกลง'
            })
          });
      });
    }

function handlerDelete(reservationId) {
    Swal.fire({
        title: 'แน่ใจหรือไม่ ?',
        text: "การกระทำนี้จะลบข้อมูลนี้อย่างถาวร!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบมัน!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            // สร้างคำขอลบด้วย AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_reservation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    Swal.fire(
                        'ลบเรียบร้อย!',
                        'ข้อมูลของคุณถูกลบแล้ว.',
                        'success'
                    ).then(() => {
                        location.reload();  // โหลดหน้าเว็บใหม่เพื่ออัปเดตข้อมูล
                    });
                } else if (xhr.readyState === 4) {
                    Swal.fire(
                        'เกิดข้อผิดพลาด!',
                        'ไม่สามารถลบข้อมูลได้.',
                        'error'
                    );
                }
            };
            xhr.send("reservation_id=" + reservationId);
        }
    });
}

    async function SendApprove(reservation_id, status) {
      try {
        const form = new FormData()
        form.append('reservation_id', reservation_id)
        form.append('status', status)
        const response = await fetch('approve.php', {
          method: 'POST',
          body: form
        })
        if (!response.ok) {
          throw new Error('Network response was not ok')
        }
        const data = await response.json()
        return data;
        console.log('SendApprove data', data)
      } catch (error) {
        console.error('SendApprove error', error)
        Swal.fire({
          title: 'เกิดข้อผิดพลาด',
          text: 'โปรดลองใหม่อีกครั้ง ' + error,
          icon: 'error',
          confirmButtonText: 'ตกลง'
        })
      }
    }

// Function to format date and time to Thai locale with full date and time styles
function formatThaiDateTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString('th-TH', {
        dateStyle: 'medium',
        timeStyle: 'short',
        timeZone: 'Asia/Bangkok'
    });
}

  </script>

</body>

</body>

</html>