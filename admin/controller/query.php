<?php 
  $query_total_orders = "SELECT COUNT(*) AS total_orders FROM orders";
  $stmt_total_orders = $conn->prepare($query_total_orders);
  $stmt_total_orders->execute();
  $stmt_total_orders->bind_result($total_orders);
  $stmt_total_orders->store_result();
  $stmt_total_orders->fetch();

  $query_total_payments = "SELECT SUM(o.order_cost) AS total_payments FROM payments p, orders o WHERE p.order_id = o.order_id";
  $stmt_total_payments = $conn->prepare($query_total_payments);
  $stmt_total_payments->execute();
  $stmt_total_payments->bind_result($total_payments);
  $stmt_total_payments->store_result();
  $stmt_total_payments->fetch();

  $query_total_paid = "SELECT COUNT(*) AS total_paid FROM orders WHERE order_status = 'delivered' OR order_status = 'shipped' OR order_status = 'paid'";
  $stmt_total_paid = $conn->prepare($query_total_paid);
  $stmt_total_paid->execute();
  $stmt_total_paid->bind_result($total_paid);
  $stmt_total_paid->store_result();
  $stmt_total_paid->fetch();

  $query_total_not_paid = "SELECT COUNT(*) AS total__not_paid FROM orders WHERE order_status = 'not paid'";
  $stmt_total_not_paid = $conn->prepare($query_total_not_paid);
  $stmt_total_not_paid->execute();
  $stmt_total_not_paid->bind_result($total_not_paid);
  $stmt_total_not_paid->store_result();
  $stmt_total_not_paid->fetch();
?>