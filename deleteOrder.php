<?php
$filepath = realpath(dirname(__FILE__));
include_once('lib/database.php');
include_once 'lib/session.php';
include_once('classes/product.php');
include 'classes/order.php';
include_once 'classes/orderDetails.php';

$orderId =  $_GET['orderId'];
$status =$_GET['status'];
if(isset($orderId) && $status=="Processing"){
    $orderDetails = new orderDetails();
    $order= new order();
    $result1 = $orderDetails->deleteOrderDetails($orderId);
    $result2 = $order->deleteOrder($orderId);
}
else
{
    echo '<script type="text/javascript">alert("Đơn hàng đang giao! không thể hủy!"); history.back();</script>';   
}
if (isset($result1) && isset($result2)) {
    echo '<script type="text/javascript">alert("Hủy đơn hàng thành công!"); history.back();</script>';
} else {
    echo '<script type="text/javascript">alert("Xóa sản phẩm khỏi giỏ hàng thất bại!"); history.back();</script>';
}
?>