<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


class cart
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function add_to_cart($id, $quantity)
  {
    if (isset($_SESSION['cart'][$id])) {
      $_SESSION['cart'][$id] += $quantity;
    } else {
      $_SESSION['cart'][$id] = $quantity;
    }
    echo "<script>window.location='cart.php'</script>";
  }

  public function delete_item_in_cart($id)
  {
    unset($_SESSION['cart'][$id]);
    echo "<script>window.location='cart.php'</script>";
  }

  public function update_cart($id, $quantity)
  {
    $_SESSION['cart'][$id] = $quantity;
  }

  public function insert_order($data)
  {
    $name = mysqli_real_escape_string($this->db->link, $data['name']);
    $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
    $address = mysqli_real_escape_string($this->db->link, $data['address']);
    $total = $_SESSION['total'] * 0.9;
    $customer_id = $_SESSION['customer'];
    $query = "INSERT INTO tbl_order(name,zipcode,email,phone,address,total,customer_id)
     VALUES ('$name','$zipcode','$email','$phone','$address','$total','$customer_id')";
    $result = $this->db->insert($query);
    if ($result) {
      $query1 = "SELECT MAX(id) as id FROM tbl_order";
      $result1 = $this->db->select($query1)->fetch_assoc();
      $id = $result1['id'];
      foreach ($_SESSION['cart'] as $k => $v) {
        $query2 = "INSERT INTO tbl_orderdetails(order_id,product_id,quantity)
                  VALUES ('$id','$k','$v')";
        $result2 = $this->db->insert($query2);
      }
      unset($_SESSION['total']);
      unset($_SESSION['cart']);
      echo "<script>window.location='order.php'</script>";
    } else {
      $alert = "<span class='error'>Order not successfully </span>";
      return $alert;
    }
  }

  public function show_order($customer_id)
  {
    $query = "SELECT * FROM tbl_order WHERE customer_id='$customer_id' order by id desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function showPendingOrder()
  {
    $query = "SELECT * FROM tbl_order WHERE status='0' OR status='1'";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_orderdetail($orderid)
  {
    $query = "SELECT * FROM tbl_orderdetails WHERE order_id='$orderid'";
    $result = $this->db->select($query);
    return $result;
  }

  public function handle_order($id)
  {
    $query = "UPDATE tbl_order SET status='1' WHERE id='$id'";
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Đơn hàng đang được vận chuyển </span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Đơn hàng không thể vận chuyển</span>";
      return $alert;
    }
  }

  public function receive_order($id)
  {
    $query = "UPDATE tbl_order SET status='2' WHERE id='$id'";
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Bạn đã hàng thành công </span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Hệ thống thông báo bạn chưa nhận hàng</span>";
      return $alert;
    }
  }
}
