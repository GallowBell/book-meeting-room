<?php
include 'connection.php';

// Fetch permissions
$permissions = mysqli_query($conn, "SELECT * FROM permissions");

// Add permission
if (isset($_POST['add_permission'])) {
    $permission_name = $_POST['permission_name'];
    mysqli_query($conn, "INSERT INTO permissions (permission_name) VALUES ('$permission_name')");
    header("Location: manage_permissions.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Permissions</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manage Permissions</h2>
    <!-- Permission Form -->
    <form method="POST" action="" class="mb-4">
        <div class="form-group">
            <label for="permission_name">Permission Name</label>
            <input type="text" name="permission_name" class="form-control" required>
        </div>
        <button type="submit" name="add_permission" class="btn btn-primary">Add Permission</button>
    </form>

    <!-- Permissions List -->
    <h3>Permissions List</h3>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Permission Name</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($permission = mysqli_fetch_assoc($permissions)) { ?>
            <tr>
                <td><?php echo $permission['id']; ?></td>
                <td><?php echo $permission['permission_name']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
