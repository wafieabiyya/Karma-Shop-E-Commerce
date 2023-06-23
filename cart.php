<?php
include 'server/connection.php';
session_start();

if (isset($_POST['add_to_cart'])) {
    // If user has already add product to the cart
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        // If product has already added to cart or not
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'special_offer' => $_POST['special_offer'],
                'product_image1' => $_POST['product_image1'],
                'product_quantity' => $_POST['product_quantity']
            );

            $_SESSION['cart'][$product_id] = $product_array;

            // Product has already been added
        } else {
            echo '<script>alert("Product was already added to the cart")</script>';
        }

        // If user the first add product to the cart
    } else {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['special_offer'];
        $product_image = $_POST['product_image1'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'special_offer' => $product_price,
            'product_image' => $product_image,
            'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
    }

    // Calculate total
    calculateTotalCart();

    // Remove product from the cart
} else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];

    unset($_SESSION['cart'][$product_id]);

    // Calculate total
    calculateTotalCart();

    // Codingan baru
} else if (isset($_POST['edit_quantity'])) {
    // We get the id from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // We get product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    // Update the product quantity
    $product_array['product_quantity'] = $product_quantity;

    // Return array back its place
    $_SESSION['cart'][$product_id] = $product_array;

    // Calculate total
    calculateTotalCart();
} else {
    //header('location: index.php');
}

function calculateTotalCart()
{
    $total_price = 0;
    $total_quantity = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $price = $product['special_offer'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}

?>
<?php include 'layouts/header.php' ?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Shopping Cart</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                    <a href="cart.pp">Cart</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION['cart'])) { ?>
                            <form action="cart.php" method="POST">
                                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="img/product/<?php echo $value['product_image1'] ?>" alt="" style="width: 50%;">
                                                </div>
                                                <div class="media-body">
                                                    <p><?php echo $value['product_name'] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5><?php echo setRupiah(($value['special_offer'] * $kurs_dollar)) ?></h5>
                                        </td>
                                        <td>
                                            <div class="product_count">
                                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>" />
                                                <input type="text" name="product_quantity" id="sst" maxlength="12" value="<?php echo $value['product_quantity'] ?>" title="product_quantity:" class="input-text qty">
                                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if (!isNaN(sst) && sst > 0) result.value--; return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <h5><?php echo setRupiah(($value['special_offer'] * $value['product_quantity']) * $kurs_dollar) ?></h5>
                                        </td>
                                        <tr class="bottom_button">
                                            <td>
                                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                                <button type="submit" class="genric-btn danger px-5 py-1.5" name="remove_product">DELETE</button>
                                                <button type="submit" class="genric-btn info " name="edit_quantity">UPDATE CART</button>
                                                <!-- <a class="navbar-link btn btn-outline-light" href="cart.php?unset=1">RESET</a> -->
                                                <!-- <a class="gray_btn" href="#">Update Cart</a> -->
                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                <div class="cupon_text d-flex align-items-center">
                                                    <input type="text" placeholder="Coupon Code">
                                                    <a class="primary-btn" href="#">Apply</a>
                                                    <a class="gray_btn" href="#">Close Coupon</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <h5>Subtotal</h5>
                                    </td>
                                    <td>
                                        <h5><?php if (isset($_SESSION['cart'])) {
                                                echo setRupiah($_SESSION['total'] * $kurs_dollar);
                                            }
                                            ?></h5>
                                    </td>
                                </tr>
                                <tr class="out_button_area">
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <div class="checkout_btn_inner d-flex align-items-center">
                                            <a class="gray_btn" href="index.php">Continue Shopping</a>
                                            <a class="primary-btn" href="checkout.php?">Proceed to checkout</a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- <a class="navbar-link btn btn-outline-dark" href="cart.php?unset=1">RESET</a> -->
                            </form>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->
<?php include 'layouts/footer.php' ?>