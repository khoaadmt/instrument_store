<?php
    include '../lib/session.php';
    include '../classes/categories.php';
    Session::checkSession('admin');
    $role_id = Session::get('role_id');
    if ($role_id == 1) {
            $category = new categories();
            $result = $category->delete($_GET['id']);
            header("Location:categoriesList.php");
    } else {
        header("Location:../index.php");
    }
?>