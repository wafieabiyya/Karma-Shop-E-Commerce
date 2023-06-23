<?php
ob_start();
session_start();
include('layouts/header.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Telegram</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="products.php">Telegram</a></li>
            <li class="breadcrumb-item active">Send Report</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Send Report</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form id="create-form" enctype="multipart/form-data" method="POST" action="tele_action.php">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Telegram Id</label>
                                    <input class="form-control" type="text" name="chatId">
                                </div>   
                            </div>
                            <div class="col-sm-6">
                                <label>Chose File</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="addImage1" name="file" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="addImage1">Choose file...</label>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <div class="m-t-20 text-right">
                            <a href="products.php" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-primary submit-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include('layouts/footer.php'); ?>