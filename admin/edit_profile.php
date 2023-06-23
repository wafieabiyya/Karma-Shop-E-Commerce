<?php
ob_start();
session_start();
include('layouts/header.php');


if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
}
?>

<?php
if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
    $query_edit_admin = "SELECT * FROM admins WHERE admin_id = ?";
    $stmt_edit_admin = $conn->prepare($query_edit_admin);
    $stmt_edit_admin->bind_param('i', $admin_id);
    $stmt_edit_admin->execute();
    $admins = $stmt_edit_admin->get_result();
} else if (isset($_POST['edit_btn'])) {
    $id = $_POST['admin_id'];
    $name = $_POST['admin_name'];
    $email = $_POST['admin_email'];
    $phone = $_POST['admin_phone'];
    $pw = $_POST['admin_password'];

    $query_edit_profile = "UPDATE admins SET admin_name = ?, admin_email = ?, admin_phone = ?, 
            admin_password = ? WHERE admin_id = ?";

    $stmt_edit_profile = $conn->prepare($query_edit_profile);
    $stmt_edit_profile->bind_param('ssssi', $name, $email, $phone, $pw, $id);

    if ($stmt_edit_profile->execute()) {
        header('location: index.php?success_update_message=Product has been updated successfully');
    } else {
        header('location: edit_profile.php?fail_update_message=Error occured, try again!');
    }
} else {
    header('location: edit_profile.php');
    exit;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#admin.php">Admin</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form id="edit-form" method="POST" action="edit_profile.php">
                        <div class="row">
                            <?php foreach ($admins as $admin) { ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>" />
                                        <label>Name</label>
                                        <input class="form-control" type="text" name="admin_name" value="<?php echo $admin['admin_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="text" name="admin_email" value="<?php echo $admin['admin_email']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" type="text" name="admin_phone" value="<?php echo $admin['admin_phone']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="text" name="admin_password" value="<?php echo $admin['admin_password']; ?>">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="m-t-20 text-right">
                            <a href="products.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary submit-btn px-4" name="edit_btn">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include('layouts/footer.php'); ?>