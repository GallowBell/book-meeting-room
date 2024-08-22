<?php

require_once __DIR__ . '/connection.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query ข้อมูลจากตาราง reservations
$sql = "SELECT * FROM reservations ORDER BY reservation_id DESC";

$result = $conn->query($sql);

// ดึงข้อมูลทั้งหมดเป็นอาเรย์
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

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

// โค้ดสำหรับผู้ที่เข้าสู่ระบบแล้ว
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
                          <th scope="col" class="text-truncate">#</th>
                          <th scope="col" class="text-truncate">เรื่อง</th>
                          <th scope="col" class="text-truncate">ห้องที่จอง</th>
                          <th scope="col" class="text-truncate">ชื่อผู้จอง</th>
                          <th scope="col" class="text-truncate">วันที่</th>
                          <th scope="col" class="text-truncate">เวลาที่จอง</th>
                          <th scope="col" class="text-truncate">สถานะ</th>
                          <th scope="col" class="text-truncate">หมายเหตุ</th>
                          <th scope="col" class="text-truncate">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data as $row): 
                                $date = new DateTime($row["reservation_date"]);

                                // แปลงวันที่ให้เป็นรูปแบบ dd:mm:yyyy
                                $formatted_date = $date->format('d-m-');

                                // แปลงปีเป็น พ.ศ.
                                $thai_year = $date->format('Y') + 543;?>
                          <tr>
                            <th scope="row"><a href="#"><?= htmlspecialchars($row["reservation_id"]) ?></a></th>
                            <td class="text-truncate"><?= htmlspecialchars($row["meeting_name"]) ?></td>
                            <td class="text-truncate"><a href="#" class="text-primary"><?= htmlspecialchars($row["meeting_room"]) ?></a></td>
                            <td class="text-truncate"><?= htmlspecialchars($row["organizer_name"]) ?></td>
                            <td class="text-truncate"><?= htmlspecialchars($formatted_date . $thai_year) ?></td>
                            <td class="text-truncate"><?= htmlspecialchars($row["start_time"]) ?> น. - <?= htmlspecialchars($row["end_time"]) ?> น.</td>
                            <td class="text-truncate">
                              <?php 
                              $is_disabled = false;
                              if($row["is_approve"] == -1) :
                              ?>
                                <span class="badge rounded-pill bg-warning fs-6">รออนุมัติ</span>
                              <?php
                              elseif($row["is_approve"] == 0) :
                                $is_disabled = true;
                              ?>
                                <span class="badge rounded-pill bg-danger fs-6">ไม่อนุมัติ</span>
                              <?php
                              elseif($row["is_approve"] == 1) :
                                $is_disabled = true;
                              ?>
                                <span class="badge rounded-pill bg-success fs-6">อนุมัติ</span>
                              <?php
                              endif;
                              ?>
                            </td>
                            <td class="text-truncate"><?= htmlspecialchars($row["notes"]) ?></td>
                            <td class="text-truncate">
                              <div class="btn-group-sm" role="group">
                                <?php 
                                  if($_SESSION['userlevel'] == 'admin') :
                                ?>
                                    <button type="button" class="btn btn-success" <?php echo $is_disabled ? ' disabled ' : ''; ?> onclick="handlerApprove(`<?= $row['reservation_id'] ?>`)" >
                                      ✔
                                    </button>
                                    <button type="button" class="btn btn-danger" <?php echo $is_disabled ? ' disabled ' : ''; ?> onclick="handlerReject(`<?= $row['reservation_id'] ?>`)" >
                                      ✖
                                    </button>
                                <?php 
                                  endif;
                                ?>
                                    <button type="button" class="btn btn-primary" <?php echo $is_disabled ? ' disabled ' : ''; ?> data-bs-toggle="modal" data-bs-target="#reportModal"><i class="bi bi-eye"></i></button>
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
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">แก้ไขข้อมูลการจอง</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm" action="report-update.php" method="post">
          <input type="hidden" id="reservation_id" name="reservation_id">
          <div class="mb-3">
            <label for="meeting_name" class="form-label">เรื่อง</label>
            <input type="text" class="form-control" id="meeting_name" name="meeting_name">
          </div>
          <div class="mb-3">
            <label for="meeting_room" class="form-label">ห้องที่จอง</label>
            <input type="text" class="form-control" id="meeting_room" name="meeting_room">
          </div>
          <div class="mb-3">
            <label for="organizer_name" class="form-label">ชื่อผู้จอง</label>
            <input type="text" class="form-control" id="organizer_name" name="organizer_name">
          </div>
          <div class="mb-3">
            <label for="reservation_date" class="form-label">วันที่</label>
            <input type="date" class="form-control" id="reservation_date" name="reservation_date">
          </div>
          <div class="mb-3">
            <label for="start_time" class="form-label">เวลาที่จองเริ่มต้น</label>
            <input type="time" class="form-control" id="start_time" name="start_time">
          </div>
          <div class="mb-3">
            <label for="end_time" class="form-label">เวลาที่จองสิ้นสุด</label>
            <input type="time" class="form-control" id="end_time" name="end_time">
          </div>
          <div class="mb-3">
            <label for="notes" class="form-label">หมายเหตุ</label>
            <textarea class="form-control" id="notes" name="notes"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
  include 'footer.php';
  ?>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      /* Swal.fire({
          title: "กรุณาเข้าสู่ระบบ",
          icon: "warning",
          confirmButtonText: "ตกลง"
      }) */
    });

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
          if(result.status == 200){
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
            text: 'โปรดลองใหม่อีกครั้ง '+error,
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
          if(result.status == 200){
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
            text: 'โปรดลองใหม่อีกครั้ง '+error,
            icon: 'error',
            confirmButtonText: 'ตกลง'
          })
        });
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
          text: 'โปรดลองใหม่อีกครั้ง '+error,
          icon: 'error',
          confirmButtonText: 'ตกลง'
        })
      }
    }
  </script>

</body>

</body>
</html>