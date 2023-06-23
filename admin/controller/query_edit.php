<?php 
    //Query Edit Order 
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $query_edit_order = "SELECT * FROM orders WHERE order_id = ?";
        $stmt_edit_order = $conn->prepare($query_edit_order);
        $stmt_edit_order->bind_param('i', $order_id);
        $stmt_edit_order->execute();
        $orders = $stmt_edit_order->get_result();

    } else if (isset($_POST['edit_btn'])) {
        $o_id = $_POST['order_id'];
        $o_status = $_POST['order_status'];

        $query_update_status = "UPDATE orders SET order_status = ? WHERE order_id = ?";

        $stmt_update_status = $conn->prepare($query_update_status);
        $stmt_update_status->bind_param('si', $o_status, $o_id);

        if ($stmt_update_status->execute()) {
            header('location: orders.php?success_status=Status has been updated successfully');
        } else {
            header('location: orders.php?fail_status=Could not update order status!');
        }
    } else {
        header('location: orders.php');
        exit;
    }

    // Query Edit Product
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $query_edit_product = "SELECT * FROM products WHERE product_id = ?";
        $stmt_edit_product = $conn->prepare($query_edit_product);
        $stmt_edit_product->bind_param('i', $product_id);
        $stmt_edit_product->execute();
        $products = $stmt_edit_product->get_result();

    } else if (isset($_POST['edit_btn'])) {
        $id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $brand = $_POST['product_brand'];
        $category = $_POST['product_category'];
        $criteria = $_POST['product_criteria'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];
        $special_offer = $_POST['special_offer'];

        $query_update_product = "UPDATE products SET product_name = ?, product_brand = ?, product_category = ?, 
            product_criteria = ?, product_description = ?, product_price = ?, special_offer = ? 
            WHERE product_id = ?";

        $stmt_update_product = $conn->prepare($query_update_product);
        $stmt_update_product->bind_param('sssssiii', $name, $brand, $category, $criteria, $description, $price, $special_offer, $id);

        if ($stmt_update_product->execute()) {
            header('location: products.php?success_update_message=Product has been updated successfully');
        } else {
            header('location: products.php?fail_update_message=Error occured, try again!');
        }
    } else {
        header('location: products.php');
        exit;
    }

    // Query Edit Profile

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