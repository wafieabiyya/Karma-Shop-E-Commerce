<?php
/*
    Status:
    Not Paid
    Paid
    Shipped
    Delivered
    */
session_start();
include('server/connection.php');

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $query_order_details = "SELECT * FROM order_items WHERE order_id = ?";

    $stmt_order_details = $conn->prepare($query_order_details);
    $stmt_order_details->bind_param('i', $order_id);
    $stmt_order_details->execute();
    $order_details = $stmt_order_details->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);
} else {
    header('location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details)
{
    $total = 0;

    foreach ($order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);
    }

    return $total;
}
?>

<?php include 'layouts/header.php' ?>

<link rel="stylesheet" href="css/style.css" type="text/css">
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Order Details</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="payment.php">Order Detail</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<!-- Order Details Section Begin -->
<section id="orders" class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Order Details</h2>
                    <span>***</span>
                </div>
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $row) { ?>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="img/product/<?php echo $row['product_image']; ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h6><?php echo $row['product_name']; ?></h6>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h5><?php echo setRupiah(($row['product_price'] * $kurs_dollar)); ?></h5>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h5><?php echo $row['product_quantity']; ?></h5>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h5><?php echo $row['order_date']; ?></h5>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php if ($order_status == 'not paid') { ?>
                        <form method="POST" action="payment.php">
                            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                            <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" />
                            <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
                            <input type="submit" name="order_pay_btn" class="btn btn-primary" style="float: right;" value="Pay Now" />
                            <input type="button" onclick="location.href='http://localhost:8080/account.php';" class="btn btn-secondary" style="float: right; margin-right: 15px;" value="Back" />
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order Details Section End -->
<?php include 'layouts/footer.php' ?>