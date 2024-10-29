<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
$is_logged_in = isset($_SESSION['username']);
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';
$role_id = $is_logged_in ? $_SESSION['role_id'] : 'guest';
?> 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- Font Awesome for Stars -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <title>Pakkret Municipality Booking Meeting Room</title>
  <?php
    include 'head.php';
  ?>
  
</head>

<body>

 <?php
  include 'headertop.php';
  include 'sidebar.php';
 ?>

     <!-- For Full page -->
<style>   
#main-full{
  margin: 80px 25px 10px 25px ;
}

.star-rating .fa-star {
            color: #FFD700;
            cursor: pointer;
        }

</style>

  <main id="main-full" class="main">

    <div class="pagetitle">
      <h1>ติดต่อเรา</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
          <li class="breadcrumb-item active">ติดต่อเรา</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">

      <div class="row gy-4">

        <div class="col-xl-6">

          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-geo-alt"></i>
                <h3>ที่อยู่</h3>
                <p>เลขที่ 1 ถนนแจ้งวัฒนะ ตำบลปากเกร็ด <br>อำเภอปากเกร็ด จังหวัดนนทบุรี 11120</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-telephone"></i>
                <h3>เบอร์ติดต่อ</h3>
                <p>โทร. 0 2960 9704 - 14 <br>สำนักปลัดเทศบาล ต่อ  413</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-envelope"></i>
                <h3>อีเมล</h3>
                <p>saraban@pakkretcity.go.th<br>-</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <i class="bi bi-clock"></i>
                <h3>ระยะเวลาให้บริการ</h3>
                <p>วันจันทร์ - วันศุกร์<br>8:30 น. - 16:30 น. (มีพักเที่ยง)</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-6">
          <div class="card p-4">
            <form action="forms/contact.php" method="post" class="form-group">
              <div class="card-body">
                <h4 class="d-flex justify-content-center m-4">แสดงความคิดเห็นและความพึงพอใจ</h4>
              <div class="row gy-4">

                <div class="col-md-12">
                  <input type="text" name="comment_name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="comment_text" rows="3" placeholder="Message" required></textarea>
                </div>

                <div class="star-rating text-center">
                        <!-- Stars -->
                        <i class="far fa-star" data-value="1" style="font-size: 25px;"></i>
                        <i class="far fa-star" data-value="2" style="font-size: 25px;"></i>
                        <i class="far fa-star" data-value="3" style="font-size: 25px;"></i>
                        <i class="far fa-star" data-value="4" style="font-size: 25px;"></i>
                        <i class="far fa-star" data-value="5" style="font-size: 25px;"></i>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="">

                <div class="col-md-12 text-center">
                  <!-- <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div> -->

                  <button class="btn btn-primary" type="submit">ส่งความคิดเห็น</button>
                </div>

              </div>
            </form>
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

  <script>
// Star rating logic
const stars = document.querySelectorAll('.fa-star');
let selectedRating = 0;

stars.forEach(star => {
    star.addEventListener('mouseover', function () {
        resetStars();
        highlightStars(this.dataset.value);
    });

    star.addEventListener('click', function () {
        selectedRating = this.dataset.value;
        document.getElementById('rating').value = selectedRating;
    });

    star.addEventListener('mouseout', function () {
        if (selectedRating === 0) {
            resetStars();
        } else {
            highlightStars(selectedRating);
        }
    });
});

function resetStars() {
    stars.forEach(star => star.classList.replace('fas', 'far'));  // Set back to empty stars
}

function highlightStars(rating) {
    for (let i = 0; i < rating; i++) {
        stars[i].classList.replace('far', 'fas');  // Fill the stars up to the selected rating
    }
}

// Submit form via AJAX (example)
document.getElementById('ratingForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const rating = document.getElementById('rating').value;

    if (rating === "") {
        alert("Please select a rating.");
        return;
    }

    // Example AJAX request to submit the rating to the database
    const formData = new FormData(this);

    fetch('forms/contact.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('Rating submitted successfully!');
        // Close modal and reset rating
        document.querySelector('.btn-close').click();
        resetStars();
        document.getElementById('rating').value = '';
    })
    .catch(error => console.error('Error:', error));
});
</script>

</body>

</html>