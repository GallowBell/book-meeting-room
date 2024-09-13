<?php
include 'connection.php';

// Fetch roles
$roles = mysqli_query($conn, "SELECT * FROM roles");

// Add role
if (isset($_POST['add_role'])) {
    $role_name = $_POST['role_name'];
    mysqli_query($conn, "INSERT INTO roles (role_name) VALUES ('$role_name')");
    header("Location: manage_roles.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Roles</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manage Roles</h2>
    <!-- Role Form -->
    <form method="POST" action="" class="mb-4">
        <div class="form-group">
            <label for="role_name">Role Name</label>
            <input type="text" name="role_name" class="form-control" required>
        </div>
        <button type="submit" name="add_role" class="btn btn-primary">Add Role</button>
    </form>

    <!-- Roles List -->
    <h3>Roles List</h3>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Role Name</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($role = mysqli_fetch_assoc($roles)) { ?>
            <tr>
                <td><?php echo $role['id']; ?></td>
                <td><?php echo $role['role_name']; ?></td>
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
