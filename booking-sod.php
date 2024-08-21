<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'head.php';
  ?>
  
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  

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
  
  </style>

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
        <li class="breadcrumb-item active">แบบฟอร์มการขอใช้โสตทัศนูปกรณ์และเจ้าหน้าที่</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">แบบฟอร์มการขอใช้โสตทัศนูปกรณ์และเจ้าหน้าที่</h5>

            <!-- General Form Elements -->
            <form class="row g-3 needs-validation" novalidate>
              <div class="col-md-6">
                <label for="validationCustom01" class="form-label">ห้อง</label>
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
                <label for="Topic" class="form-label">หัวข้อเรื่อง</label>
                <input type="text" class="form-control" id="Topic" required>
                <div class="invalid-feedback">
                  โปรดกรอกหัวข้อ
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
                <input type="date" class="form-control" name="date" id="date_select" maxlength="10" required>
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
              <div class="row">
            <!-- <div class="checkbox-group-title">อุปกรณ์</div> -->
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check1">
                    <label class="form-check-label" for="group1Check1">
                        ชุดเครื่องเสียงห้องประชุม
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check2">
                    <label class="form-check-label" for="group1Check2">
                    ชุดเครื่องเสียงนอกสถานที่
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check3">
                    <label class="form-check-label" for="group1Check3">
                        เครื่องโปรเจคเตอร์ พร้อมจอภาพ
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check4">
                    <label class="form-check-label" for="group1Check4">
                    เครื่องเสียงลำโพงกระเป๋าหิ้ว
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check5">
                    <label class="form-check-label" for="group1Check5">
                        เจ้าหน้าที่ควบคุม
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check6">
                    <label class="form-check-label" for="group1Check6">
                        เครื่องเสียงพกพาพร้อมไมโครโฟน
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check7">
                    <label class="form-check-label" for="group1Check7">
                      การบันทึกเทปภาพบรรยาย (VDO)
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check8">
                    <label class="form-check-label" for="group1Check8">
                    การบันทึกเทปเสียงบรรยาย (Voice)
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check9">
                    <label class="form-check-label" for="group1Check9">
                        การบันทึกภาพนิ่ง
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check10">
                    <label class="form-check-label" for="group1Check10">
                      การส่งข่าวประชาสัมพันธ์
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check11">
                    <label class="form-check-label" for="group1Check11">
                        แฟ้มเอกสาร จำนวน
                        <input class="inputint" type="number" value="" id="group1Check11" size="1" height="20"> ฉบับ
                    </label>
                </div>
                <div class="col-md-6 col-xs-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check12">
                    <label class="form-check-label" for="group1Check12">
                        เอกสารของที่ระลึก จำนวน
                        <input class="inputint" type="number" value="" id="group1Check12" size="1" height="20"> ชุด
                    </label>
                </div>
                <div class="col-12 mb-2">
                  <input class="form-check-input" type="checkbox" value="" id="group1Check13">
                  <label class="form-check-label" for="group1Check13">
                      การประชุมออนไลน์ (Video Conference) โปรแกรม
                      <div style="display: inline-flex; align-items: center;">
                          <input class="inputtext" type="text" value="" id="group1Check13" size="" height="20" style='width:100%'>
                          <span> (ระบุ)</span>
                      </div>
                  </label>
                </div>
                <div class="col-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check14">
                    <label class="form-check-label" for="group1Check14">
                        เอกสารแจก 
                        <div style="display: inline-flex; align-items: center;">
                            <input class="inputtext" type="text" value="" id="group1Check14" size="" height="20" style='width:100%'>
                            <span> (ระบุ)</span>
                        </div>
                        จำนวน 
                        <input class="inputint" type="number" value="" id="group1Check14" size="1" height="20"> เล่ม
                    </label>
                </div>

                <div class="col-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check15">
                    <label class="form-check-label" for="group1Check15">
                        พิธีกรดำเนินงาน (วัน/เวลา) ในวันที่
                    </label>
                    <input class="inputint" type="date" value="" id="group1Check15" size="1" height="20">
                    <label class="form-check-label" for="group1Check12">
                      เวลา <input class="inputint" type="time" value="" id="group1Check15" size="1" height="20"> 
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check16">
                    <label class="form-check-label" for="group1Check16">
                        ช่างภาพ (วัน/เวลา) ในวันที่
                    </label>
                    <input class="inputint" type="date" value="" id="group1Check16" size="1" height="20">
                    <label class="form-check-label" for="group1Check16">
                      เวลา <input class="inputint" type="time" value="" id="group1Check16" size="1" height="20"> 
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check17">
                    <label class="form-check-label" for="group1Check17">
                        รถประชาสัมพันธ์เคลื่อนที่
                        <div style="display: inline-flex; align-items: center;">
                          <input class="inputtext" type="text" value="" id="group1Check17" size="" height="20" style='width:100%'>
                        </div>
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="group1Check18">
                    <label class="form-check-label" for="group1Check18">
                        อื่นๆ ระบุ
                        <div style="display: inline-flex; align-items: center;">
                          <input class="inputtext" type="text" value="" id="group1Check18" size="" height="20" style='width:100%'>
                        </div>
                    </label>
                </div>
              </div>
            </div>
          </div>
        </div>
            <!-- End CheckBox1 -->

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
        }
        .inputtext{
          /* border: none; */
          border: 1px solid #DCDCDC;
          box-shadow: 0 0 2px black;
          margin: 0px 5px 0px 5px;
          width: 20rem;
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

</body>

</html>