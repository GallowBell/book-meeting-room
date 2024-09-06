<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';
$userlevel = $is_logged_in ? $_SESSION['userlevel'] : 'guest';
?> 

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include 'head.php';
  ?>
  
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  

<body>

  <?php
    include 'headertop.php';
    include 'sidebar.php';
  ?>

<style>
  .carousel{
    border-radius: 20px 20px 20px 20px;
    overflow: hidden;
  }
  h5.card-title{
    font-size: 25px;
    font-weight: bold;
  }
  span.topic1{
    font-size: 18px;
    font-weight: bold;
  }
</style>

    <!-- For Full page -->
    <style>   
#main-full{
  margin: 80px 25px 10px 25px ;
}

</style>

<main id="main-full" class="main">

  <div class="pagetitle">
    <h1>ห้องประชุมชั้น 5</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
        <li class="breadcrumb-item">ห้องประชุม</li>
        <li class="breadcrumb-item active">ห้องประชุมชั้น 5</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- <style>
  .carousel {
   width:auto;
   height:460px;
 }
 .carousel-inner > .item > img {
   width:640px;
   height:460px;
 }
  </style> -->

  <section class="section">
    <div class="row">
          <!-- Card with an image on left -->
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-6 p-3">
              <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <a href="assets/img/5/room-5-5.jpg">
                    <img src="assets/img/5/room-5-5.jpg" class="d-block w-100" alt="...">
                    </a>
                  </div>
                  <div class="carousel-item">
                    <a href="assets/img/5/room-5-6.jpg">
                    <img src="assets/img/5/room-5-6.jpg" class="d-block w-100" alt="...">
                    </a>
                  </div>
                  <div class="carousel-item">
                    <a href="assets/img/5/room-5-1.jpg">
                    <img src="assets/img/5/room-5-1.jpg" class="d-block w-100" alt="...">
                    </a>
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

                </div>
              </div>
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title">ห้องประชุมชั้น 5</h5>
                  <p class="card-text"><span class="topic1">รายละเอียด :</span> ห้องประชุมพร้อมระบบ Video conference ที่นั่งผู้เข้าร่วมประชุม รูปตัว U 2 แถว</p>
                  <p class="card-text"><span class="topic1">จำนวนที่นั่ง :</span> 50 ที่นั่ง รูปตัว U</p>
                </div>
              </div>
            </div>
          </div>
          <!-- End Card with an image on left -->

    <!-- <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ภาพห้องประชุมชั้น 4</h5>
            </div>
          </div>
    </div> -->

      </div>
  </section>

</main><!-- End #main -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



</body>


<!-- Modal Form -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php
  include 'footer.php';
  ?>

</body>

</html>