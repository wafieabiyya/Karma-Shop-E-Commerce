<?php 
    $query_products_latest = "SELECT *FROM products WHERE product_criteria = 'Latest Product'";
    $result_prducts_latest = mysqli_query($conn, $query_products_latest);
    
    $query_products_coming = "SELECT *FROM products WHERE product_criteria = 'Coming Soon'";
    $result_products_coming = mysqli_query($conn, $query_products_coming);

    $query_all_products = "SELECT *FROM products ";
    $result_all_products = mysqli_query($conn, $query_all_products);
?>