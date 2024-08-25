<?php
session_start();
// JCW5eXFX78s93RsNaLfH
// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';
$userlevel = $is_logged_in ? $_SESSION['userlevel'] : 'guest';
?> 
  
  <!-- Header -->
  <?php
    include 'head.php';
    include 'header.php';
    include 'sidebar.php';
  ?>

 

<?php 
  require_once  "connection.php";

  $query = $conn->query("SELECT 
    CONCAT(meeting_name, ' - ', meeting_room) as title,
    CONCAT(reservation_date, ' ', start_time) as `start`,
    CONCAT(reservation_date_end, ' ', end_time) as `end`,
    reservation_date,
    start_time,
    reservation_date_end,
    end_time,
    government_sector,
    meeting_room,
    meeting_name,
    meeting_type,
    participant_count,
    organizer_name,
    contact_number,
    notes,
    is_approve,
    reservation_id,
    CASE
      WHEN meeting_room = 'ห้องประชุมชั้น 4' THEN 'bg-success'
      WHEN meeting_room = 'ห้องประชุมชั้น 5' THEN 'bg-primary'
          ELSE 'bg-danger'
    END as color_1
    FROM `reservations`
  
    WHERE is_approve = 1");
  $data = $query->fetch_all(MYSQLI_ASSOC);

  foreach ($data as $key => $value) {
    $sql2 = "SELECT * FROM `equipment_reservations` WHERE reservation_id = ".$value['reservation_id'];
    $query = $conn->query($sql2);
    $data[$key]['equipment_reservations'] = $query->fetch_all(MYSQLI_ASSOC);
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
  <title>Pakkret Municipality Booking Meeting Room</title>
  
  <style>
    .hide-calendar .ui-datepicker-calendar{
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
      color: #fff !important ;
    }
    #calendar {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
    }

    .card-link{
      background-image: linear-gradient(#00079C,#00079C);
      background-size: 0 100%;
      background-repeat: no-repeat;
      transition: .4s;
    }

   .card-link:hover{
    background-size: 100% 100%;
    }

  
  </style>

<script src='fullcalendar/dist/index.global.js'></script>

  <script>

      function Render_equipment_reservations(data = {}){
        const body = document.getElementById('myModal2_body');
        const title = document.getElementById('myModal2_header');
        //console.log('data', data);
        const arr = data?.equipment_reservations;
        const meeting_name = data?.meeting_name;
        body.innerHTML = '';
        title.innerHTML = `จองห้อง: ${meeting_name}`;
        const start_d = (new Date(data?.start)).toLocaleDateString('th-TH', {
          dateStyle: 'full',
          timeStyle: 'short'
        });
        const end_d = (new Date(data?.end)).toLocaleDateString('th-TH', {
          dateStyle: 'full',
          timeStyle: 'short'
        });
        let html = `
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">ห้องประชุม: ${data?.meeting_room}</h5>
                  <p class="card-text">หัวข้อ: ${data?.meeting_name}</p>
                  <p class="card-text">ใช้สำหรับ: ${data?.meeting_type}</p>
                  <p class="card-text">จำนวนคน: ${data?.participant_count}</p>
                  <p class="card-text">เวลา: ${start_d} ถึง ${end_d}</p>
                </div>
            </div>
          </div>
        </div>`;


        // ข้อมูลจาก equipment_reservations loop
        html += `
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ชื่ออุปกรณ์</th>
                <th scope="col">จำนวน</th>
                <th scope="col">ขนาด</th>
                <th scope="col">รายละเอียด</th>
              </tr>
            </thead>
            <tbody>
        `;

        arr?.forEach((item, index) => {
          html += `
            <tr>
              <th scope="row">${index + 1}</th>
              <td>${item?.equipment_name}</td>
              <td>${item?.equipment_quantity}</td>
              <td>${item?.equipment_size}</td>
              <td>${item?.additional_details}</td>
            </tr>
          `;
        });

        html += `
            </tbody>
          </table>
        `;
        body.innerHTML = html;
      }

      var myModal2;
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        const myModal = new bootstrap.Modal('#myModal', {
          keyboard: false
        })
        myModal2 = new bootstrap.Modal('#myModal2', {
          keyboard: false
        })
        
        $('#time').daterangepicker({
          timePicker: true,
          locale: {
            format: 'hh:mm:ss'
          },
          beforeShow: function(input) {
      $(input).datepicker("widget").addClass('hide-calendar');
    },
        timePicker24Hour: true
      }).focusin(function(){
      $('.ui-datepicker-calendar').css("display","none");
    });;
      var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'th',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          // right : ''
          right: 'dayGridMonth,dayGridWeek,dayGridDay,listMonth'
        },
        buttonText: {
            today:    'วันนี้',         // Today
            month:    'เดือน',           // Month
            week:     'สัปดาห์',          // Week
            day:      'วัน',            // Day
            list:     'รายการ'           // List (if using the list view)
        },
        // initialDate: '2023-01-12',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        select: function(arg) {
          console.log(123)
          console.log('arg', arg)
          //var title = prompt('Event Title:');

         let date = arg.startStr
         document.getElementById('date_select').value = date;
          
          myModal.show()
          //calendar.unselect()
        },
        eventClick: function(arg) {
          /* if (confirm('ต้องการจะจบกิจกรรม ?')) {
            arg.event.remove()
          } */
          var event = arg.event;
          var eventTitle = event.title;
          var reservations_id = event.extendedProps?.reservation_id; // Custom property
          Render_equipment_reservations(event?.extendedProps);
          myModal2.show();
          //console.log('arg', arg)
          console.log('reservations_id', reservations_id)
        },
        eventColor: 'green',
        editable: false,
        dayMaxEvents: true,
        events: <?php echo json_encode($data); ?>,
        eventContent: function(arg) {
          // Extract the event details
          const event = arg.event;
          /* console.log('startStr', event.startStr)
          console.log('endStr', event.endStr) */
          const startTime = new Date(event.startStr).toLocaleTimeString('th-TH', { hour: '2-digit', minute: '2-digit' });
          const endTime = new Date(event.endStr).toLocaleTimeString('th-TH', { hour: '2-digit', minute: '2-digit' });
          console.log('event.extendedProps?.', event.extendedProps);
          const color_1 = event.extendedProps?.color_1
          console.log(color_1);
          // Create a custom element to display the event details
          const html = `
            <div class="${color_1} text-light w-100">
              <div class="fc-event-title">${event.title}</div>
              <div class="fc-event-time">${startTime} - ${endTime}</div>
            </div>
          `;
          
          return { html };
        }
    });
  
      calendar.render();
    });
  
  </script>


<body>
  


  <main id="main" class="main">

    <div class="pagetitle">
          <h1>หน้าแรก</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">หน้าแรก</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-16">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-12">
              <div class="card-link mb-4 rounded-3 bg-dark">

                <div class="card-body p-0">
                  <a href="booking.php">
                  <h5 class="card-title"></h5>

                  <div class="d-flex align-items-center justify-content-center">
                    <!-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-feather"></i>
                    </div> -->
                    <div class="p-3">
                      <h1 class="text-white">จองห้องประชุม</h1>
                    </div>
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-feather text-white"></i>
                    </div>
                  </div>
                  <h5 class="card-title"></h5>
                </div>
                </a>

              </div>
            </div>
            <!-- End Sales Card -->

            <!-- Revenue Card -->
            <!-- <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card bg-dark">
                <div class="card-body">
                  <h5 class="card-title text-white fw-bold">ห้องประชุม <span class="text-white">| ที่ว่าง</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-door-open-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="text-white">3</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div> -->
            <!-- End Revenue Card -->

            <!-- Customers Card -->
            <!-- <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card bg-dark">
                <div class="card-body">
                  <h5 class="card-title text-white fw-bold">จำนวน <span class="text-light">| ผู้ที่จอง</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="text-white">10</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div> -->
            <!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                <div class="row">
                  <div class="col-12 mt-1 d-flex justify-content-center">
                  <h2 class="mt-3 fw-bold">ปฏิทินการจองห้องประชุม</h2>
                </div>
                <!-- <div class="col-6 mt-4 d-flex justify-content-end">
                  <a href="booking.php"><button class="btn btn-primary btn-lg">จองห้อง</button></a>
                </div> -->

                <div class="row m-4">
                <div class="col-xxl-4 col-md-4 col-sm-12 d-flex align-items-center justify-content-center">
                <i class="fs-5 bi bi-square-fill text-success"></i>
                <span class="fs-5 ms-2">ห้องประชุมชั้น 4</span>
                  </div>
                <div class="col-xxl-4 col-md-4 col-sm-12 d-flex align-items-center justify-content-center">
                  <i class="fs-5 bi bi-square-fill text-primary"></i>
                  <span class="fs-5 ms-2">ห้องประชุมชั้น 5</span>
                </div>
                <div class="col-xxl-4 col-md-4 col-sm-12 d-flex align-items-center justify-content-center">
                  <i class="fs-5 bi bi-square-fill text-danger"></i>
                  <span class="fs-5 ms-2">ห้องประชุมชั้น 9</span>
                </div>
                </div>
                </div>


                <div id='calendar'></div>


                </div>
                </div>
              </div>
            </div><!-- End Reports -->
          </div>
        </div><!-- End Left side columns -->
        </div><!-- End Right side columns -->

    </section>

  </main><!-- End #main -->


  <style>
        .checkbox-group {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            /* margin: 8px; */
        }
        .checkbox-group-title {
            /* font-size: 20px; */
            font-weight: bold;
            /* margin-bottom: 0.5rem; */
            /* margin-right: 1rem; */
        }
        .form-check-input{
          outline: 1px solid #CCC;
        }

        input[type='number'].inputint{
          width: 60px;
        } 
        
        .inputint{
          /* border: none; */
          border: 1px solid #DCDCDC;
          box-shadow: 0 0 2px black;
          margin: 0px 5px 0px 5px;
          display: inline-block;
          width: auto;
        }
        .inputtext{
          /* border: none; */
          border: 1px solid #DCDCDC;
          box-shadow: 0 0 2px black;
          margin: 0px 5px 0px 5px;
          width: 20rem;
          display: inline-block;
        }
        .btn-close{
          width:32px;
          height:32px;
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



 <!-- Modal -->
 <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="myModal2_header">จองห้อง</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="myModal2_body"><!-- ห้ามลบ -->
        <
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
        <!-- <button type="submit" class="btn btn-success">บันทึก</button> -->
      </div>
    </div>
  </div>
</div>


<!-- Modal Form -->
      <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">จองห้อง</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="row g-3 needs-validation" novalidate>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">ชื่อห้อง</label>
                  <select class="form-select" id="validationDefault04" required>
                    <option selected disabled value="">เลือกห้อง...</option>
                    <option>ห้องประชุมชั้น 4</option>
                    <option>ห้องประชุมชั้น 5</option>
                    <option>ห้องประชุมชั้น 9</option>
                  </select>
                  <div class="invalid-feedback">
                    โปรดเลือกห้อง
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="Topic" class="form-label">หัวข้อ</label>
                  <input type="text" class="form-control" id="Topic" required>
                  <div class="invalid-feedback">
                    โปรดกรอกหัวข้อ
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">ใช้สำหรับ</label>
                  <select class="form-select" id="validationDefault04" required>
                    <option selected disabled value="">ใช้สำหรับการ...</option>
                    <option>ฝึกอาชีพ</option>
                    <option>อบรม</option>
                    <option>ประชุม</option>
                  </select>
                  <div class="invalid-feedback">
                    โปรดเลือกห้อง
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="Topic" class="form-label">จำนวนผู้เข้าร่วม</label>
                  <input type="number" class="form-control" id="Topic" required>
                  <div class="invalid-feedback">
                    โปรดกรอกจำนวนผู้เข้าร่วม
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="book_name" class="form-label">ชื่อผู้จอง</label>
                  <input type="text" class="form-control" id="book_name" required>
                  <div class="invalid-feedback">
                    โปรดกรอกชื่อผู้จอง
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="tel_phone" class="form-label">เบอร์ติดต่อ</label>
                  <input type="tel" class="form-control" id="tel_phone" maxlength="10" required>
                  <div class="invalid-feedback">
                    โปรดกรอกเบอร์โทรศัพท์
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="book_date" class="form-label">วันที่จอง</label>
                  <input type="date" class="form-control" name="date" id="date_select" maxlength="10" required disabled>
                  <div class="invalid-feedback">
                    โปรดกรอกวันที่จอง
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="startDate" class="form-label">เวลาเริ่มต้น</label>
                  <input type="time" class="form-control" id="" name="time">
                  <div class="invalid-feedback">
                    โปรดกรอกเวลาจอง
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="endDate" class="form-label">เวลาสิ้นสุด</label>
                  <input type="time" class="form-control" id="" name="time">
                  <div class="invalid-feedback">
                    โปรดกรอกเวลาจอง
                  </div>
                </div>


                <!-- <div class="col-md-6">
                  <label for="startDate" class="form-label">อุปกรณ์</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                      Checked checkbox
                    </label>
                  </div>
                </div> -->

                <!-- CheckBox1 -->
                <div class="container mt-2">
                <div class="col-md-12">
                <label for="checkbox-group" class="form-label mt-2">อุปกรณ์</label>
                <div class="checkbox-group">
                <!-- <div class="row"> -->

                  <div class="row">
                    <!-- <div class="checkbox-group-title">อุปกรณ์</div> -->
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check1">
                        <label class="form-check-label" for="group1Check1">
                            ชุดโต๊ะหมู่บูชา จำนวน 1 ชุด
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check2">
                        <label class="form-check-label" for="group1Check2">
                        จาน + ช้อนส้อม จำนวน
                        <input class="inputint" type="number" value="" id="group1Check2" size="1" height="20"> ใบ
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check3">
                        <label class="form-check-label" for="group1Check3">
                            ถาดเสิร์ฟ จำนวน
                            <input class="inputint" type="number" value="" id="group1Check3" size="1"> ใบ
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check4">
                        <label class="form-check-label" for="group1Check4">จานแก้วใส ขนาด</label>
                          <select class="inputint" id="group1Check4">
                            <option selected>เลือก</option>
                            <option value="1">ใหญ่</option>
                            <option value="2">กลาง</option>
                            <option value="3">เล็ก</option>
                          </select>
                          <label class="form-check-label" for="group1Check4">จำนวน</label>
                        <input class="inputint" type="number" value="" id="group1Check4" size="1" height="20"> ใบ
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check5">
                        <label class="form-check-label" for="group1Check5">
                            ช้อนเล็กจำนวน
                            <input class="inputint" type="number" value="" id="group1Check5" size="1" height="20"> ชุด
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check6">
                        <label class="form-check-label" for="group1Check6">
                            ส้อมเล็กจำนวน
                            <input class="inputint" type="number" value="" id="group1Check6" size="1" height="20"> ชุด
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check7">
                          <label class="form-check-label" for="group1Check7">ชุดกาเเฟ (เเก้วกาเเฟ+จานรอง)</label>
                          <label class="form-check-label" for="group1Check7">จำนวน</label>
                        <input class="inputint" type="number" value="" id="group1Check7" size="1" height="20"> ชุด/วัน
                        
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check8">
                        <label class="form-check-label" for="group1Check8">ถ้วย ขนาด </label>
                        <select class="inputint" id="group1Check8">
                            <option selected>เลือก</option>
                            <option value="1">ใหญ่</option>
                            <option value="2">กลาง</option>
                            <option value="3">เล็ก</option>
                          </select>
                          <label class="form-check-label" for="group1Check8">จำนวน</label>
                            <input class="inputint" type="number" value="" id="group1Check8" size="1" height="20"> ใบ
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check9">
                        <label class="form-check-label" for="group1Check9">
                            เเก้วน้ำดื่ม จำนวน
                            <input class="inputint" type="number" value="" id="group1Check9" size="1" height="20"> ใบ/วัน
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check10">
                        <label class="form-check-label" for="group1Check10">
                            เหยือกน้ำ จำนวน
                            <input class="inputint" type="number" value="" id="group1Check10" size="1" height="20"> ใบ
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check11">
                        <label class="form-check-label" for="group1Check11">
                            คูลเลอร์ใส่น้ำดื่ม จำนวน
                            <input class="inputint" type="number" value="" id="group1Check11" size="1" height="20"> ใบ
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check12">
                        <label class="form-check-label" for="group1Check12">
                            คูลเลอร์ใส่น้ำร้อน จำนวน
                            <input class="inputint" type="number" value="" id="group1Check12" size="1" height="20"> ใบ
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check13">
                        <label class="form-check-label" for="group1Check13">
                            กระติกน้ำเเข็ง จำนวน
                            <input class="inputint" type="number" value="" id="group1Check13" size="1" height="20"> ใบ
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check14">
                        <label class="form-check-label" for="group1Check14">
                            ผ้าปูโต๊ะ จำนวน
                            <input class="inputint" type="number" value="" id="group1Check14" size="1" height="20"> ผืน
                        </label>
                    </div>
                    <div class="col-md-6 col-xs-12 mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="group1Check15">
                        <label class="form-check-label" for="group1Check15">
                            ผ้าคลุมเก้าอี้ จำนวน
                            <input class="inputint" type="number" value="" id="group1Check15" size="1" height="20"> ผืน
                        </label>
                    </div>
                    <div class="col-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check16">
                      <label class="form-check-label" for="group1Check16">ที่จอดรถ ชั้น
                        <input class="inputint d-inline-block" type="number" value="" id="group1Check16" size="1" height="20"> จำนวน
                        <input class="inputint d-inline-block" type="number" value="" id="group1Check16" size="1" height="20"> คัน
                        เลขทะเบียน
                        <input class="inputtext d-inline-block" type="text" value="" id="group1Check16" size="1" height="20">
                      </label>
                    </div>
                    <div class="col-12 mt-2">
                      <input class="form-check-input" type="checkbox" value="" id="group1Check17">
                        <label class="form-check-label" for="group1Check17">อื่นๆ ระบุ </label>
                      <input class="inputtext" type="text" value="" id="group1Check17" size="1" height="20">
                        
                    </div>
                    <!-- End CheckBox1 -->
                    </div>
                    <!-- </div> -->
                    </div>
                </div>
                </div>
                

          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">หมายเหตุ</span>
            <input type="text" class="form-control" id="" name="">
          </div>


        <!-- ห้ามเปลี่ยน date_select -->
        <!-- <input type="hidden" name="date" id="date_select"  > -->
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
        <button type="submit" class="btn btn-success">บันทึก</button>
        </form>
      </div>
    </div>
  </div>
</div>


  <!-- ======= Footer ======= -->
  <footer>
    <?php
      include 'footer.php';
    ?>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script>

    // add the responsive classes after page initialization
    function addResponsiveClasses() {
        if (window.innerWidth <= 465) {
            $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12 text-center');
        } else {
            $('.fc-toolbar.fc-header-toolbar').removeClass('row col-lg-12 text-center');
        }
    }
    window.onresize = addResponsiveClasses;
    let data_json = `<?php echo json_encode($data); ?>`;
    document.addEventListener('DOMContentLoaded', () => {
      console.log(JSON.parse(data_json));
      addResponsiveClasses();
    })

  </script>


</body>


</html>
