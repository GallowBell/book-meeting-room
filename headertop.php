<?php

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';
$role_id = $is_logged_in ? $_SESSION['role_id'] : 'guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>Pakkret Municipality Booking Meeting Room</title>
    <?php
      include 'head.php';
      $current_page = basename($_SERVER['SCRIPT_NAME']);
      $active_pages = ['page-room-1.php', 'page-room-2.php','page-room-3.php'];
      $is_active = in_array($current_page, $active_pages) ? 'btn btn-light' : 'text-light';
      $show_collapse = in_array($current_page, $active_pages) ? 'show' : '';
    ?>

    <meta content="" name="description">
    <meta content="" name="keywords">
    
</head>


<body>

  <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center justify-content-between px-3" style="background-color:#00079C;">

  <!-- Logo Section -->
  <a href="index.php" class="logo d-flex align-items-center me-2">
    <img src="assets/img/logopakk_up.png" alt="">
    <span class="d-none d-lg-block text-light">จองห้องประชุม</span>
  </a>

  <!-- Toggle Sidebar Button for Mobile -->
  <button class="navbar-toggler d-xxl-none">
    <i class="bi bi-list toggle-sidebar-btn text-white"></i>
  </button>

  <div class="vr d-none d-xxl-block m-2" style="border: 2px solid #ffffff ;"></div>

  <!-- New Button Next to Logo -->

  <!-- <style>
    .dropdown-item.active{
    background-color: #dc3545 !important;
    }

  </style> -->

  <a href="index.php" class="menu d-none d-xxl-block <?php echo ($current_page == 'index.php') ? 'btn btn-light' : 'light'; ?> mx-3 fs-5">
    <span class="d-none d-xxl-block text-<?php echo ($current_page == 'index.php') ? 'dark' : 'light'; ?>">หน้าแรก</span>
  </a>
  
  <div class="dropdown d-none d-xxl-block">
      <a class="dropdown-toggle <?php echo $is_active; ?> d-none d-xxl-block me-3 fs-5" 
          role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        ห้องประชุม
      </a>
      
      <!-- Dropdown Menu -->
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item <?php echo ($current_page == 'page-room-1.php') ? 'active' : ''; ?> fs-6" href="page-room-1.php">ห้องประชุมชั้น 4</a></li>
        <li><a class="dropdown-item <?php echo ($current_page == 'page-room-2.php') ? 'active' : ''; ?> fs-6" href="page-room-2.php">ห้องประชุมชั้น 5</a></li>
        <li><a class="dropdown-item <?php echo ($current_page == 'page-room-3.php') ? 'active' : ''; ?> fs-6" href="page-room-3.php">ห้องประชุมชั้น 9</a></li>
      </ul>
    </div>
  </a>

  <a href="booking.php" class="menu <?php echo ($current_page == 'booking.php') ? 'btn btn-light' : 'light'; ?> d-none d-xxl-block me-3 fs-5">
    <span class="d-none d-xxl-block text-<?php echo ($current_page == 'booking.php') ? 'dark' : 'light'; ?>">จองห้อง</span>
  </a>
  <a href="booking-report.php" class="menu <?php echo ($current_page == 'booking-report.php') ? 'btn btn-light' : 'light'; ?> d-none d-xxl-block me-3 fs-5">
    <span class="d-none d-xxl-block text-<?php echo ($current_page == 'booking-report.php') ? 'dark' : 'light'; ?>">รายงาน</span>
  </a>
  <a href="pages-contact.php" class="menu <?php echo ($current_page == 'pages-contact.php') ? 'btn btn-light' : 'light'; ?> d-none d-xxl-block me-3 fs-5">
    <span class="d-none d-xxl-block text-<?php echo ($current_page == 'pages-contact.php') ? 'dark' : 'light'; ?>">ติดต่อ</span>
  </a>
  <?php
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == '1') :
    ?>
  <a href="manage_users.php" class="menu <?php echo ($current_page == 'manage_users.php') ? 'btn btn-light' : 'light'; ?> d-none d-xxl-block me-3 fs-5">
    <span class="d-none d-xxl-block text-<?php echo ($current_page == 'manage_users.php') ? 'dark' : 'light'; ?>">จัดการผู้ใช้</span>
  </a>
  <?php
    endif;
  ?>

<!--  
  <a href="index.php" class="btn btn-<?php echo ($current_page == 'index.php') ? 'danger' : 'light'; ?> d-none d-lg-block ms-3">หน้าแรก</a>
  
  

  <div class="dropdown ms-3">
    <button class="btn btn-<?php echo $is_active; ?> dropdown-toggle d-none d-lg-block" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
      ห้องประชุม
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <li><a class="dropdown-item <?php echo ($current_page == 'page-room-1.php') ? 'active' : ''; ?>" href="page-room-1.php">ห้องประชุมชั้น 4</a></li>
      <li><a class="dropdown-item <?php echo ($current_page == 'page-room-2.php') ? 'active' : ''; ?>" href="page-room-2.php">ห้องประชุมชั้น 5</a></li>
      <li><a class="dropdown-item <?php echo ($current_page == 'page-room-3.php') ? 'active' : ''; ?>" href="page-room-3.php">ห้องประชุมชั้น 9</a></li>
    </ul>
  </div>
  
  <a href="booking.php" class="btn btn-<?php echo ($current_page == 'booking.php') ? 'danger' : 'light'; ?> d-none d-lg-block ms-3">จองห้อง</a>

  <a href="booking-report.php" class="btn btn-<?php echo ($current_page == 'booking-report.php') ? 'danger' : 'light'; ?> d-none d-lg-block ms-3">รายงาน</a>

  <a href="pages-contact.php" class="btn btn-<?php echo ($current_page == 'pages-contact.php') ? 'danger' : 'light'; ?> d-none d-lg-block ms-3">ติดต่อ</a> -->


  <!-- Navigation -->
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

    <?php if ($is_logged_in): ?>
    <li class="nav-item dropdown pe-3">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/userdf.png" alt="Profile" class="rounded-circle d-none d-sm-block">
        <span class="ps-2 text-light">
          <?php echo $username; ?> | 
          <?php 
            if ($role_id == 1) {
                echo "ผู้จัดการระบบ";
            } elseif ($role_id == 2) {
                echo "ผู้ใช้งาน";
            } 
          ?>
        </span>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a href="pages-logout.php" class="btn btn-danger">ออกจากระบบ <i class="bi bi-box-arrow-right"></i></a>
    </li>
<?php else: ?>
    <li class="nav-item dropdown">
      <a href="pages-login.html" class="btn btn-primary text-white">เข้าสู่ระบบ <i class="bi bi-box-arrow-right"></i></a>
    </li>
<?php endif; ?>


    </ul>
  </nav>
</header>

  <!-- End Header -->
  
 <!-- Vendor JS Files -->
 <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <!-- <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> -->
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
    
</body>
</html>