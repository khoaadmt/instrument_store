<?php
include_once 'lib/session.php';
Session::checkSession('client');
include_once 'classes/cart.php';
include_once 'classes/user.php';

$cart = new cart();
$list = $cart->get();
$totalPrice = $cart->getTotalPriceByUserId();
$totalQty = $cart->getTotalQtyByUserId();

$user = new user();
$userInfo = $user->get();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://use.fontawesome.com/2145adbb48.js"></script>
    <script src="https://kit.fontawesome.com/a42aeb5b72.js" crossorigin="anonymous"></script>
    <title>Checkout</title>
</head>

<body>
    <div class="head">
        <i class="fa fa-guitar" style="font-size: 60px; color: white; margin-left: 110px; margin-top: 30px;"></i>
        <form action="search.php" method="GET">
                    <input type="text" name="search" id="search" placeholder="Bạn cần tìm gì...">
        </form>
        <ul class="inf">
            <li>
                <i class="fa fa-phone"></i>
                <p>Hotline: 0383456123 HN
                        0383456789 HCM</p>
            </li>
            <li>
                <i class="fa fa-map"></i>
                <p>Showroom gần nhất</p>
            </li>
        </ul>
    </div>
    <nav>
        <label class="logo">MelodyMart</label>
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="productList.php">Sản phẩm</a></li>
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                <li><a href="logout.php" id="signin">Đăng xuất</a></li>
            <?php } else { ?>
                <li><a href="register.php" id="signup">Đăng ký</a></li>
                <li><a href="login.php" id="signin">Đăng nhập</a></li>
            <?php } ?>
            <li><a href="order.php" id="order">Đơn hàng</a></li>
            <li>
                <a href="checkout.php" class="active">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="sumItem" id="totalQtyHeader">
                        <?= $totalQty['total'] ?>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="featuredProducts">
        <h1>Giỏ hàng</h1>
    </div>
    <div class="container-single">
        <?php
        if ($list) { ?>
            <table class="order">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thao tác</th>
                </tr>
                <?php
                $count = 1;
                foreach ($list as $key => $value) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= $value['productName'] ?></td>
                        <td><img class="image-cart" src="admin/uploads/<?= $value['productImage'] ?>"></td>
                        <td><?= number_format($value['productPrice'], 0, '', ',') ?>VND </td>
                        <td>
                            <input id="<?= $value['productId'] ?>" type="number" name="qty" class="qty" value="<?= $value['qty'] ?>" onchange="update(this)" min="1">
                        </td>
                        <td>
                            <a href="delete_cart.php?id=<?= $value['id'] ?>">Xóa</a>
                        </td>
                    </tr>
                <?php }
                ?>
            </table>
            <div class="orderinfo">
                <div class="buy">
                    <h3>Thông tin đơn đặt hàng</h3>
                    <div>
                        Người đặt hàng: <b><?= $userInfo['fullname'] ?></b>
                    </div>
                    <div>
                        Số lượng: <b id="qtycart"><?= $totalQty['total'] ?></b>
                    </div>
                    <div>
                        Tổng tiền: <b id="totalcart"><?= number_format($totalPrice['total'], 0, '', ',') ?>VND</b>
                    </div>
                    <div>
                    <form action="add_order.php" method="POST">
                        <label for="">Địa chỉ nhận hàng: </label>
                        <input type="text" name="recieveAddress" require> <br>
                        <label for="">Tên người nhận: </label>
                        <input type="text" name="recieveName" require> <br>
                        <label for="">SĐT: </label>
                        <input type="text" name="SDT" require> <br>
                        <button type="submit" class="buy-btn">Tiến hành đặt hàng</button>
                    </form>
                    </div>
                    
                </div>
            </div>
        <?php } else { ?>
            <h3>Giỏ hàng hiện đang rỗng</h3>
        <?php }
        ?>
    </div>
    </div>
    <footer>
      <div class="footer-item">
        <h3>HỖ TRỢ KHÁCH HÀNG</h3>
        <ul>
          <li><a href="#">Sản phẩm & Đơn hàng: 0245622342</a></li>
          <li><a href="#">Kỹ thuật & Bảo hành: 0245622342</a> </li>
          <li><a href="#">Câu hỏi thường gặp</a></li>
          <li><a href="#">Hướng dẫn sử dụng</a></li>
          <li><a href="#">Địa chỉ: số 298 Đ.Cầu Diễn, Minh Khai, Bắc Từ Liêm, Hà Nội</a></li>
        </ul>
      </div>
      <div class="footer-item">
        <h3>LIÊN HỆ</h3>
        <ul>
            <li><a href="#"><i class="fa fa-facebook" style="font-size: 30px"></i>   Melody Mart</a></li>
            <li><a href="#"><i class="fa fa-envelope" style="font-size: 30px"></i>    melodymart@gmail.com</a></li>
            <li><a href="#"><i class="fa fa-instagram" style="font-size: 30px"></i>   melodymart</a></li>
        </ul>
      </div>
      <div class="footer-item">
        <h3>TÀI KHOẢN CỦA BẠN</h3>
        <ul>
          <li><a href="#">Quản lý thông tin cá nhân</a></li>
          <li><a href="#">Đổi mật khẩu</a></li>
          <li><a href="#">Giỏ hàng</a></li>
          <li><a href="#">Lịch sử giao dịch</a></li>
        </ul>
      </div>
      <div class="footer-item">
        <h3>TRỢ GIÚP</h3>
        <ul>
          <li><a href="#">Hướng dẫn mua hàng</a></li>
          <li><a href="#">Phương thức thanh toán</a></li>
          <li><a href="#">Chính sách đổi trả</a></li>
          <li><a href="#">Phương thức vận chuyển</a></li>
        </ul>
      </div>
    </footer>
    <div class="ft">
        @ Bản quyền thuộc về Melody Mart 
    </div>
</body>
<script type="text/javascript">
    function update(e) {
        var http = new XMLHttpRequest();
        var url = 'update_cart.php';
        var params = "productId=" + e.id + "&qty=" + e.value;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if (http.readyState === XMLHttpRequest.DONE) {
                var status = http.status;
                if (status === 200) {
                    var arr = http.responseText;
                    var b = false;
                    var result = "";
                    for (let index = 0; index < arr.length; index++) {
                        if (arr[index] == "[") {
                            b = true;
                        }
                        if (b) {
                            result += arr[index];
                        }
                    }
                    var arrResult = JSON.parse(result.replace("undefined", ""));
                    console.log(arrResult);
                    document.getElementById("totalQtyHeader").innerHTML = arrResult[1]['total'];
                    document.getElementById("qtycart").innerHTML = arrResult[1]['total'];
                    document.getElementById("totalcart").innerHTML = arrResult[0]['total'].replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + "VND";

                    //alert('Đã cập nhật giỏ hàng!');
                } else if (status === 501) {
                    alert('Số lượng sản phẩm không đủ để thêm vào giỏ hàng!');
                    e.value = parseInt(e.value) - 1;
                } else {
                    alert('Cập nhật giỏ hàng thất bại!');
                    window.location.reload();
                }
            }

        }
        http.send(params);
    }

    var list = document.getElementsByClassName("qty");
    for (let item of list) {
        item.addEventListener("keypress", function(evt) {
            evt.preventDefault();
        });
    }
</script>

</html>