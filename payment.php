<?php
session_start();
include 'server/connection.php';

if (isset($_POST['order_pay_btn'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $order_total_price = ($_POST['order_total_price'] / 15502);
}

?>
<?php include('layouts/header.php') ?>
<link rel="stylesheet" href="css/style.css" type="text/css">

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Payment</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="payment.php">Payment</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="checkout__input">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span>
                            <?php if (isset($_POST['order_status'])) {
                                echo $_POST['order_status'];
                            } ?>
                        </h6>

                        <?php if (isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>
                            <?php $amount = strval($order_total_price); ?>
                            <?php $order_id = $_POST['order_id']; ?>
                            <h6 class="checkout__title">TOTAL PAYMENT: $<?php echo setRupiah(($_POST['order_total_price'] * $kurs_dollar)); ?></h6>
                            <!--<input type="submit" class="btn btn-primary" value="PAY NOW" />-->
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>

                        <?php } else if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
                            <?php $amount = strval($_SESSION['total']); ?>
                            <?php $order_id = $_SESSION['order_id']; ?>
                            <h6 class="checkout__title">TOTAL PAYMENT: <?php echo setRupiah(($_SESSION['total'] * $kurs_dollar)); ?></h6>
                            <!--<input type="submit" class="btn btn-primary" value="PAY NOW" /> -->
                            <!-- Set up a container element for the button -->
                            <div id="paypal-button-container"></div>

                        <?php } else { ?>
                            <p>You don't have an order</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<!-- Replace "test" with your own sandbox Business account app client ID -->
<!-- <script src="https://www.paypal.com/sdk/js?client-id=AVZ_GLLhC7eFDNZo2_bOR1SolBrCHKw-a8IacL8Cqw8s2qBTzbe8RX3E_15NtdXUfkymkEgT5JWSyx_h&currency=USD"></script>
 -->
 <script src="https://www.paypal.com/sdk/js?client-id=AVZ_GLLhC7eFDNZo2_bOR1SolBrCHKw-a8IacL8Cqw8s2qBTzbe8RX3E_15NtdXUfkymkEgT5JWSyx_h&locale=en_US"></script>
<!-- AVZ_GLLhC7eFDNZo2_bOR1SolBrCHKw-a8IacL8Cqw8s2qBTzbe8RX3E_15NtdXUfkymkEgT5JWSyx_h -->

<script>
    paypal.Buttons({
        // set payment
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $amount; ?>'
                    }
                }]
            });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                window.location.href = "server/complete_payment.php?transaction_id=" + transaction.id + "&order_id=" + <?php echo $order_id; ?>;
            });
        }
    }).render('#paypal-button-container');
</script>

<?php include('layouts/footer.php');?>