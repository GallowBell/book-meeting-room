
     <!-- ======= Footer ======= -->
  <footer id="footer-full" class="footer">
    <div class="credits">
      ออกแบบและพัฒนาโดย ทีมนักศึกษาสหกิจ 2567 สาขาวิชาระบบสารสนเทศ <a href="https://bus.rmutp.ac.th/" target="_blank">คณะบริหารธุรกิจ</a>
      <a href="https://www.rmutp.ac.th/" target="_blank"><p class="text-center">มหาวิทยาลัยเทคโนโลยีราชมงคลพระนคร (RMUTP)</p></a>
    </div>
  </footer><!-- End Footer -->
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


  <!-- DataTables -->
  <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.6/datatables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.6/datatables.min.js"></script>

  <script>
      $(document).ready(function() {
          $('#datatable2')?.DataTable();
          $('.datatable')?.DataTable({
            order: [
              [0, 'desc']
            ]
          });
      });
  </script>
