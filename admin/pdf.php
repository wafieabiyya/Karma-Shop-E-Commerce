<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
}
?>

<!-- <style>
    .buttons-print {
        /* Ganti dengan gaya tampilan yang Anda inginkan */
        background-color: blue;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .buttons-print:hover {
        /* Ganti dengan gaya tampilan hover yang Anda inginkan */
        background-color: darkblue;
    }
</style> -->
<?php include('layouts/header.php'); ?>

<?php
$query_orders = "SELECT o.order_id, o.order_cost, o.order_status, u.user_name, o.user_address, o.order_date FROM `orders` o, `users` u WHERE o.user_id = u.user_id ORDER BY o.order_date DESC";

$stmt_orders = $conn->prepare($query_orders);
$stmt_orders->execute();
$orders = $stmt_orders->get_result();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Orders</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
        </div>
        <div class="card-body">
            <?php if (isset($_GET['success_status'])) { ?>
                <div class="alert alert-info" role="alert">
                    <?php if (isset($_GET['success_status'])) {
                        echo $_GET['success_status'];
                    } ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['fail_status'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (isset($_GET['fail_status'])) {
                        echo $_GET['fail_status'];
                    } ?>
                </div>
            <?php } ?>
            <div class="table-responsive data-tables datatable-dark">
                <table class="table table-bordered" id="exportpdf" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Transaction Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr>
                                <td><?php echo $order['order_id']; ?></td>
                                <td><?php echo setRupiah(($order['order_cost'] * $kurs_dollar)); ?></td>
                                <td><?php echo $order['order_status']; ?></td>
                                <td><?php echo $order['user_name']; ?></td>
                                <td><?php echo $order['user_address']; ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td class="text-center">
                                    <a href="edit_order.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-info btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#exportpdf').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'print',
                        className:'btn btn-sm btn-primary shadow-sm px-4 pr-3',
                        exportOptions: {
                            stripHtml: false,
                            columns: [0, 1, 2, 3, 4, 5]
                            //specify which column you want to print
                        },
                        text: '<i class="fas fa-print px-1" ></i>Print'
                    }]
                });
            });
        </script>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include('layouts/footer.php'); ?>