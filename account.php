<?php
session_start();
include('server/connection.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_photo']);
        header('location: login.php');
        exit;
    }
}

if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['user_email'];

    if ($password !== $confirm_password) {
        header('location: account.php?error=Password did not match');
    } else if (strlen($password) < 6) {
        header('location: account.php?error=Password must be at least 6 characters');

        // Inf no error
    } else {
        $query_change_password = "UPDATE users SET user_password = ? WHERE user_email = ?";

        $stmt_change_password = $conn->prepare($query_change_password);
        $stmt_change_password->bind_param('ss', md5($password), $email);

        if ($stmt_change_password->execute()) {
            header('location: account.php?success=Password has been updated successfully');
        } else {
            header('location: account.php?error=Could not update password');
        }
    }
}

// Get Orders by User Login
if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];

    $query_orders = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";

    $stmt_orders = $conn->prepare($query_orders);
    $stmt_orders->bind_param('i', $user_id);
    $stmt_orders->execute();

    $user_orders = $stmt_orders->get_result();
}

// Cara memperbaiki bug pada $total_bayar saat mengakses halaman account
if (isset($_SESSION['total'])) {
    $total_bayar = $_SESSION['total'];
}

?>
<?php include 'layouts/header.php' ?>
<!-- Start Banner Area -->
<link rel="stylesheet" href="css/style.css" type="text/css">
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Account</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="login.php">Account</a>
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
                <div class="col-lg-6 col-md-6">
                    <form id="account-form" method="POST" action="account.php">
                        <?php if (isset($_GET['success'])) { ?>
                            <div class="alert alert-info" role="alert">
                                <?php if (isset($_GET['success'])) {
                                    echo $_GET['success'];
                                } ?>
                            </div>
                        <?php } ?>
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php if (isset($_GET['error'])) {
                                    echo $_GET['error'];
                                } ?>
                            </div>
                        <?php } ?>
                        <h6 class="checkout__title">Change Password</h6>
                        <div class="checkout__input">
                            <p>Password</p>
                            <input type="password" id="account-password" name="password">
                        </div>
                        <div class="checkout__input">
                            <p>Confirm Password</p>
                            <input type="password" id="account-confirm-password" name="confirm_password">
                        </div>
                        <div class="checkout__input">
                            <input type="submit" class="genric-btn primary radius" id="change-password-btn" name="change_password" value="CHANGE PASSWORD"  />
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <?php if (isset($_GET['message'])) { ?>
                        <div class="alert alert-info" role="alert">
                            <?php if (isset($_GET['message'])) {
                                echo $_GET['message'];
                            } ?>
                        </div>
                    <?php } ?>
                    <div class="checkout__order">
                        <h4 class="order__title">Account Info</h4>
                        <div class="row">
                            <div class="col-sm-2 col-md-4 pb-4">
                                <img src="<?php echo '../img/profile/' . $_SESSION['user_photo']; ?>" alt="" class="rounded-circle img-responsive" />
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <h4><?php if (isset($_SESSION['user_name'])) {
                                        echo $_SESSION['user_name'];
                                    } ?></h4>
                                <small><i class="fa fa-map"></i> <cite title="Address"><?php if (isset($_SESSION['user_address'])) {
                                                                                            echo $_SESSION['user_address'];
                                                                                        } ?>, <?php if (isset($_SESSION['user_city'])) {
                                                                                                        echo $_SESSION['user_city'];
                                                                                                    } ?> </cite></small>
                                <p>
                                    <i class="fa fa-envelope"></i> <?php if (isset($_SESSION['user_email'])) {
                                                                        echo $_SESSION['user_email'];
                                                                    } ?>
                                    <br />
                                    <i class="fa fa-phone"></i> <?php if (isset($_SESSION['user_phone'])) {
                                                                    echo $_SESSION['user_phone'];
                                                                } ?>
                                </p>
                            </div>
                        </div>
                        <h4 class="">
                            <a href="#orders" class="genric-btn info radius">YOUR ORDERS</a>
                            <a href="account.php?logout=1" id="logout-btn" class="genric-btn danger radius px-4">LOG OUT</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<!-- Order History Begin -->
<section id="orders" class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <div class="alert alert-info" role="alert">
                        <?php if (isset($_GET['payment_message'])) {
                            echo $_GET['payment_message'];
                        } ?>
                    </div>
                    <h2>Your Orders History</h2>
                    <span>***</span>
                </div>
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_orders as $order) { ?>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h6><?php echo $order['order_id']; ?></h6>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <?php echo setRupiah($order['order_cost'] * $kurs_dollar); ?>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h6><?php echo $order['order_status']; ?></h6>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h5><?php echo $order['order_date']; ?></h5>
                                        </div>
                                    </td>
                                    <form method="POST" action="order-details.php">
                                        <td class="bottom_button">
                                            <input type="hidden" value="<?php echo $order['order_status']; ?>" name="order_status" />
                                            <input type="hidden" value="<?php echo $order['order_id']; ?>" name="order_id" />
                                            <input class="genric-btn success radius" name="order_details_btn" type="submit" value="Details" />
                                        </td>
                                    </form>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Order History End -->
<?php include 'layouts/footer.php' ?>