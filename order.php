<?php
include_once 'lib/session.php';
Session::checkSession('client');
include 'classes/order.php';
include_once 'classes/cart.php';

$cart = new cart();
$totalQty = $cart->getTotalQtyByUserId();

$order = new order();
$result = $order->getOrderByUser();

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
    <title>Order</title>
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
            <li><a href="order.php" id="order" class="active">Đơn hàng</a></li>
            <li>
                <a href="checkout.php">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="sumItem">
                        <?= $totalQty['total'] ?>
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <div class="featuredProducts">
        <h1>Đơn hàng</h1>
    </div>
    <div class="container-single">
        <?php if ($result) { ?>
            <table class="order">
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Địa chỉ nhận hàng</th>
                    <th>Tên người nhận</th>
                    <th>Số điện thoại</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng</th>
                    <th>Thao tác</th>
                    <th>Hủy đơn </th>
                </tr>
                <?php $count = 1;
                foreach ($result as $key => $value) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= $value['id'] ?></td>
                        <td><?= $value['createdDate'] ?></td>
                        <td><?= ($value['status'] != "Processing") ? $value['receivedDate'] : "Dự kiến 3 ngày sau khi đơn hàng đã được xử lý" ?> <?=  ($value['status'] != "Complete" && $value['status'] != "Processing") ? "(Dự kiến)" : "" ?> </td>
                        
                        <td><?= $value['receiveAddress']?></td>
                        <td><?= $value['receiveName']?></td>
                        <td><?= $value['SDT']?></td>
                        <td><?= $value['totalPrice']?></td>
                        <?php
                        if ($value['status'] == 'Delivering') { ?>
                            <td>
                                <a href="complete_order.php?orderId=<?= $value['id'] ?>">Đang giao (Click vào để xác nhận đã nhận)</a>
                            </td>
                            <td>
                                <a href="orderdetail.php?orderId=<?= $value['id'] ?>">Chi tiết</a>
                            </td>
                        <?php } else { ?>
                            <td>
                                <?= $value['status'] ?>
                            </td>
                            <td>
                                <a href="orderdetail.php?orderId=<?= $value['id'] ?>">Chi tiết</a>
                            </td>
                        <?php }
                        ?>
                        <td><a href="deleteOrder.php?orderId=<?=$value['id']?>&status=<?=$value['status']?>" onclick="isCheckDelete(event)">
                        <?php //delete order 
                            if($value['status']=="Complete" || $value['status']=="Delivering")
                            {
                                echo "Đóng";
                            }
                            else
                                echo "Hủy";
                        ?>
                        </a></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <h3>Đơn hàng hiện đang rỗng</h3>
        <?php } ?>


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
<script>
    function isCheckDelete(event){
        let text_notyfi="Bạn có chắc chắn muốn hủy đơn?";
        if(confirm(text_notyfi) !=true){
            //alert("Xóa thành công!");
            event.preventDefault(); 
        }
        
    }
</script>
</html>