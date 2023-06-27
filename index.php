<?php
include_once 'lib/session.php';
include_once 'classes/product.php';
include_once 'classes/cart.php';

$cart = new cart();
$totalQty = $cart->getTotalQtyByUserId();

$product = new product();
$list = mysqli_fetch_all($product->getFeaturedProducts(), MYSQLI_ASSOC);
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
    <title>Trang chủ</title>
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
            <li><a href="index.php" >Trang chủ</a></li>
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
                <a href="checkout.php">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="sumItem">
                        <?= ($totalQty['total']) ? $totalQty['total'] : "0" ?>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <section class="banner">
    <div class="slider-container">
        <div class="slider">
        <img src="images/sl3.jpg" alt="Image 1">
        <img src="images/sl1.jpg" alt="Image 2">
        <img src="images/sl2.jpg" alt="Image 3">
        <img src="images/slide2.png" alt="Image 4">
        <img src="images/sl4.jpg" alt="Image 5">
        </div>
        <div class="slider-dots"></div>
        </div>
  </div>
    </section>
    <div class="featuredProducts">
        <h1>Sản phẩm nổi bật</h1>
    </div>
    <div class="container">
        <?php
        foreach ($list as $key => $value) { ?>
            <div class="card">
                <div class="imgBx">
                    <a href="detail.php?id=<?= $value['id'] ?>"><img src="admin/uploads/<?= $value['image'] ?>" alt=""></a>
                </div>
                <div class="content">
                    <div class="productName">
                        <a href="detail.php?id=<?= $value['id'] ?>">
                            <h3><?= $value['name'] ?></h3>
                        </a>
                    </div>
                    <div>
                        Đã bán: <?= $value['soldCount'] ?>
                    </div>
                    <div class="original-price">
                        <?php
                        if ($value['promotionPrice'] < $value['originalPrice']) { ?>
                            Giá gốc: <del><?= number_format($value['originalPrice'], 0, '', ',') ?>VND</del>
                        <?php } else { ?>
                            <p>.</p>
                        <?php } ?>
                    </div>
                    <div class="price">
                        Giá bán: <?= number_format($value['promotionPrice'], 0, '', ',') ?>VND
                    </div>
                    <!-- <div class="rating">
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div> -->
                    <div class="action">
                        <a class="add-cart" href="add_cart.php?id=<?= $value['id'] ?>">Thêm vào giỏ</a>
                        <a class="detail" href="detail.php?id=<?= $value['id'] ?>">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        <?php }
        ?>
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
    <script>
       var slider = document.querySelector('.slider');
var sliderDots = document.querySelector('.slider-dots');
var slideIndex = 0;
var interval;

function createDots() {
  for (var i = 0; i < slider.children.length; i++) {
    var dot = document.createElement('span');
    dot.classList.add('slider-dot');
    dot.dataset.index = i;
    dot.addEventListener('click', function() {
      slideIndex = parseInt(this.dataset.index);
      updateSlider();
      resetInterval();
    });
    sliderDots.appendChild(dot);
  }
}

function updateDots() {
  var dots = document.querySelectorAll('.slider-dot');
  dots.forEach(function(dot) {
    dot.classList.remove('active');
  });
  dots[slideIndex].classList.add('active');
}

function startAutoSlide() {
  interval = setInterval(function() {
    slideIndex++;
    if (slideIndex >= slider.children.length) {
      slideIndex = 0;
    }
    updateSlider();
  }, 3000);
}

function resetInterval() {
  clearInterval(interval);
  startAutoSlide();
}

function updateSlider() {
  slider.style.transform = `translateX(-${slideIndex * 20}%)`;
  updateDots();
}

createDots();
startAutoSlide();
    </script>
</body>

</html>