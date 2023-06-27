<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../classes/cart.php');
?>


 
<?php
/**
 * 
 */
class orderDetails
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getOrderDetails($orderId)
    {
        $query = "SELECT order_details.orderId, order_details.productId, order_details.qty, products.name, products.promotionPrice, products.image
         FROM order_details JOIN products ON order_details.productId = products.Id 
         WHERE order_details.orderId = '$orderId' ";
        $mysqli_result = $this->db->select($query);
        if ($mysqli_result) {
            $result = mysqli_fetch_all($this->db->select($query), MYSQLI_ASSOC);
            return $result;
        }
        return false;
    }
    //delete order detail follow orderID
    public function deleteOrderDetails($orderId)
    {
        $query = "DELETE FROM order_details WHERE orderId = $orderId ";
        $mysqli_result = $this->db->delete($query);
        if ($mysqli_result) {
            return true;
        }
        return false;
    }

}
?>