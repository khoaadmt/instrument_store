<?php
    include '../lib/session.php';
    include '../classes/product.php';
    Session::checkSession('admin');
    $role_id = Session::get('role_id');
    if ($role_id == 1) {
            $product = new product();
            $result = $product->delete($_GET['id']);
            header("Location:productlist.php");
    } else {
        header("Location:../index.php");
    }
?>