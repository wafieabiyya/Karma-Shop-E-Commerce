<?php 
    include ('../server/connection.php');

    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];

        $query_delete_product = "DELETE FROM products WHERE product_id =$product_id";
        $statement_delete_product= $conn ->prepare($query_delete_product);
        $statement_delete_product->bind_param('i',$product_id);

        if($statement_delete_product->execute()){
            header('Location: products.php?success_delete_message=product has been deleted successfully');
        }else{
            header('location: products.php?fail_delete_message=could not delete product');
        }
    }
?>