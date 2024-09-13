<?php

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';
$role_id = $is_logged_in ? $_SESSION['role_id'] : 'guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
      include  'head.php';
      $current_page = basename($_SERVER['SCRIPT_NAME']);
      $active_pages = ['page-room-1.php', 'page-room-2.php','page-room-3.php'];
      $is_active = in_array($current_page, $active_pages) ? 'active' : 'collapsed';
      $show_collapse = in_array($current_page, $active_pages) ? 'show' : '';
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakkret Municipality Booking Meeting Room</title>

    <style>
      .nav-link.sb {
        font-size: 20px !important;
      }

      .nav-link:hover.sb {
        background: #3261FF !important;
        color: white !important;
      }

      .nav-link:hover .bxs-home 
      ,.nav-link:hover .bi-calendar-week-fill 
      ,.nav-link:hover .bi-file-earmark-bar-graph-fill 
      ,.nav-link:hover .bi-envelope-fill 
      ,.nav-link:hover .bi-door-open-fill
      ,.nav-link:hover .bi-chevron-down
      ,.nav-link:hover .bi-circle-fill
      ,.nav-link:hover .bi-person-fill-gear {
        color: white !important;
      }

      .nav-link.active{
        background: #3261FF !important;
        color: white !important;
      }

      .nav-link.active .bxs-home 
      ,.nav-link.active .bi-calendar-week-fill 
      ,.nav-link.active .bi-file-earmark-bar-graph-fill
      ,.nav-link.active .bi-envelope-fill 
      ,.nav-link.active .bi-door-open-fill
      ,.nav-link.active .bi-chevron-down
      ,.nav-link.active .bi-circle-fill
      ,.nav-link.active .bi-person-fill-gear {
        color: white !important;
      }
    
    </style>

</head>
<body>
   <!-- ======= Sidebar ======= -->
   <aside id="sidebar" class="sidebar d-xxl-none">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : 'collapsed'; ?> sb" href="index.php">
      <i class="bx bxs-home"></i>
      <span>หน้าแรก</span>
    </a>
  </li>
  <li class="nav-item">
        <a class="nav-link <?php echo $is_active; ?> sb" data-bs-target="#room-nav" data-bs-toggle="collapse" href="index.php">
          <i class="bi bi-door-open-fill"></i><span>ห้องประชุม</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="room-nav" class="nav-content collapse <?php echo $show_collapse; ?>">
          <li>
            <a class="nav-link <?php echo ($current_page == 'page-room-1.php') ? 'active' : 'collapsed'; ?> sb" href="page-room-1.php">
              <i class="bi bi-circle-fill"></i><span>ห้องประชุมชั้น 4</span>
            </a>
          </li>
          <li>
            <a class="nav-link <?php echo ($current_page == 'page-room-2.php') ? 'active' : 'collapsed'; ?> sb" href="page-room-2.php">
              <i class="bi bi-circle-fill"></i><span>ห้องประชุมชั้น 5</span>
            </a>
          </li>
          <li>
          <a class="nav-link <?php echo ($current_page == 'page-room-3.php') ? 'active' : 'collapsed'; ?> sb" href="page-room-3.php">
              <i class="bi bi-circle-fill"></i><span>ห้องประชุมชั้น 9</span>
            </a>
          </li>
        </ul>
      </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($current_page == 'booking.php') ? 'active' : 'collapsed'; ?> sb" href="booking.php">
        <i class="bi bi-calendar-week-fill iconnav"></i>
        <span>จองห้อง</span>
      </a>
  </li>
  <li class="nav-item">
      <a class="nav-link <?php echo ($current_page == 'booking-report.php') ? 'active' : 'collapsed'; ?> sb" href="booking-report.php">
        <i class="bi bi-file-earmark-bar-graph-fill"></i>
        <span>รายงาน</span>
      </a>
  </li>

  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li>End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'pages-contact.php') ? 'active' : 'collapsed'; ?> sb" href="pages-contact.php">
      <i class="bi bi-envelope-fill"></i>
      <span>ติดต่อเรา</span>
    </a>
  </li>

  <?php
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == '1') :
    ?>
  <li class="nav-item">
    <a class="nav-link <?php echo ($current_page == 'manage_users.php') ? 'active' : 'collapsed'; ?> sb" href="manage_users.php">
      <i class="bi bi-person-fill-gear"></i>
      <span>จัดการผู้ใช้</span>
    </a>
  </li>
  <?php
    endif;
  ?>
<!-- End Contact Page Nav -->

</ul>
</aside><!-- End Sidebar-->
</body>
</html>