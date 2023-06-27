<?php
include 'classes/user.php';
$user = new user();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $login_check = $user->login($email, $password);
}
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
    <title>Đăng nhập</title>
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
            <li><a href="register.php" id="signup">Đăng ký</a></li>
            <li><a href="login.php" id="signin" class="active">Đăng nhập</a></li>
            <li><a href="order.php" id="order">Đơn hàng</a></li>
            <li>
                <a href="checkout.php">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="sumItem">
                        0
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="featuredProducts">
        <h1>Đăng nhập</h1>
    </div>
    <div class="container-single">
        <div class="login">
            <form action="login.php" method="post" class="form-login">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email..." required>

                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Mật khẩu..." required>
                <p style="color: red;"><?= !empty($login_check) ? $login_check : '' ?></p>

                <input type="submit" value="Đăng nhập">
            </form>
        </div>
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

</html>