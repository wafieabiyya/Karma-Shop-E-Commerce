<?php
include 'server/connection.php';
session_start();

if (!empty($_SESSION['cart'])) {
    // Let user in
} else {
    // Send user to hompe page
    // Kalau mau dihilangkan tinggal diberi comment
    //header('location: index.php');
}
?>

<?php include 'layouts/header.php' ?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Checkout</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html">Checkout</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <form class="row contact_form" action="server/place_order.php" method="POST">
                    <div class="col-lg-8">
                        <div class="alert alert-danger" role="alert">
                            <?php if (isset($_GET['message'])) {
                                echo $_GET['message'];
                            } ?>
                            <?php if (isset($_GET['message'])) { ?>
                                <a href="login.php" class="btn btn-primary btn-sm px-3 float-right ">Login</a>
                            <?php } ?>
                        </div>
                        <h3>Billing Details</h3>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="first" name="user_name" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="number" name="user_phone" placeholder="Phone" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="email" name="user_email" placeholder="Email" required>

                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="user_address" placeholder="Address" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="user_city" placeholder="City" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <h3>Shipping Details</h3>
                                <input type="checkbox" id="f-option3" name="selector">
                                <label for="f-option3">Ship to a different address?</label>
                            </div>
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product<span>Total</span></a></li>
                                <?php foreach ($_SESSION['cart'] as  $key => $value) { ?>
                                    <li><a href="#"><?php echo $value['product_name'] ?> <span class="middle">X<?php echo $value['product_quantity'] ?></span> <span class="last"><?php echo setRupiah(($value['special_offer'] * $kurs_dollar)) ?></span></a></li>
                                <?php } ?>
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Subtotal <span><?php echo setRupiah(($_SESSION['total'] * $kurs_dollar)) ?></span></a></li>
                                <li><a href="#">Total <span><?php echo setRupiah(($_SESSION['total'] * $kurs_dollar)) ?></span></a></li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selector">
                                    <label for="f-option5">Check payments</label>
                                    <div class="check"></div>
                                </div>
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                    Store Postcode.</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selector">
                                    <label for="f-option6">Paypal </label>
                                    <img src="img/product/card.jpg" alt="">
                                    <div class="check"></div>
                                </div>
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                    account.</p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="f-option4" name="selector">
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms & conditions*</a>
                            </div>
                            <button type="submit" class="primary-btn px-4 py-1.5 btn-block" name="place_order">Proceed To Paypal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
<?php include 'layouts/footer.php' ?>