<?php
session_start();
include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Get user role from the session or database
$user_id = $_SESSION['user_id'];

// Fetch the role of the logged-in user
$result = mysqli_query($conn, "SELECT role_id FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($result);

// Check if the user is an admin (role_id = 1)
if ($user['role_id'] != 1) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'ไม่สามารถเข้าได้',
                text: 'คุณไม่มีสิทธิ์เข้าถึง',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        };
    </script>";
    exit(); // Stop script execution if the user is not an admin
}

// Handle user addition
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role_id = $_POST['role_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    mysqli_query($conn, "INSERT INTO users (username, password, role_id, first_name, last_name, phone_number) VALUES ('$username', '$password', $role_id, '$first_name', '$last_name', '$phone_number')");
    header("Location: manage_users.php");
}

// Handle user role update
if (isset($_POST['edit_user'])) {
    $user_id = $_POST['user_id'];
    $new_role_id = $_POST['role_id'];
    mysqli_query($conn, "UPDATE users SET role_id = $new_role_id WHERE user_id = $user_id");
    header("Location: manage_users.php");
}


// Handle user deletion
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    mysqli_query($conn, "DELETE FROM users WHERE user_id = $user_id");
    header("Location: manage_users.php");
}

// Fetch users and roles
$users = mysqli_query($conn, "SELECT u.user_id, u.first_name, u.last_name, u.phone_number, u.username, r.role_name, u.role_id FROM users u LEFT JOIN roles r ON u.role_id = r.id");
$roles = mysqli_query($conn, "SELECT * FROM roles");

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

    <!-- For Full page -->
    <style>
        #main-full {
            margin: 80px 25px 10px 25px;
        }
    </style>

    <main id="main-full" class="main">

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">

                        <h3>เพิ่มผู้ใช้งาน</h3>
                        <span>(เพิ่มผู้ใช้งานเข้าระบบ)</span>

                    </div>
                    <!-- User Form -->
                    <form method="POST" action="" class="mb-4">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="first_name">ชื่อจริง</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="last_name">นามสกุล</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone_number">เบอร์โทรศัพท์</label>
                                <input type="text" name="phone_number" class="form-control" pattern="0[0-9]{9}" type="tel" spellcheck="false" maxlength="10" required>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group col-md-4 mt-3">
                                <label for="role_id">ตำแหน่ง</label>
                                <select name="role_id" class="form-control">
                                    <?php while ($role = mysqli_fetch_assoc($roles)) { ?>
                                        <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" name="add_user" class="btn btn-primary mt-3">เพิ่มผู้ใช้</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Users List -->
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>ข้อมูลผู้ใช้งาน</h3>
                        <span>(แก้ไขตำแหน่งผู้ใช้งาน/ลบผู้ใช้งาน)</span>
                    </div>
                    <table class="table table-striped" id="datatable2">
                        <thead class="thead-dark">
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>อัปเดตข้อมูล</th>
                                <th>ลบข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user = mysqli_fetch_assoc($users)) { ?>
                                <tr>
                                    <td><?php echo $user['user_id']; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['first_name']; ?></td>
                                    <td><?php echo $user['last_name']; ?></td>
                                    <td><?php echo $user['phone_number']; ?></td>
                                    <td>
                                        <!-- Inline Role Change Form -->
                                        <form method="POST" action="" class="d-flex align-items-center">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <select name="role_id" class="form-control">
                                                <?php
                                                mysqli_data_seek($roles, 0); // Reset the result pointer to the first row
                                                while ($role = mysqli_fetch_assoc($roles)) { ?>
                                                    <option value="<?php echo $role['id']; ?>" <?php echo $user['role_id'] == $role['id'] ? 'selected' : ''; ?>>
                                                        <?php echo $role['role_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                    </td>
                                    <td>
                                        <!-- Update Button -->
                                        <button type="submit" name="edit_user" class="btn btn-success btn-sm ml-2">อัปเดต</button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- Delete Form -->
                                        <form method="POST" action="" class="d-inline">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <button type="submit" name="delete_user" class="btn btn-danger btn-sm">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <?php
        /* include 'footer.php'; */
        ?>

        <!-- ======= Footer ======= -->
        <footer id="footer-full" class="footer">
            <div class="credits">
                ออกแบบและพัฒนาโดย ทีมนักศึกษาสหกิจ 2567 สาขาวิชาระบบสารสนเทศ <a href="https://bus.rmutp.ac.th/" target="_blank">คณะบริหารธุรกิจ</a>
                <a href="https://www.rmutp.ac.th/" target="_blank">
                    <p class="text-center">มหาวิทยาลัยเทคโนโลยีราชมงคลพระนคร (RMUTP)</p>
                </a>
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
                $('#datatable2').DataTable();
            });
        </script>

</body>

</html>