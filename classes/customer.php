<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


class customer
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function insert_customer($data)
  {
    $name = mysqli_real_escape_string($this->db->link, $data['name']);
    $city = mysqli_real_escape_string($this->db->link, $data['city']);
    $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
    $address = mysqli_real_escape_string($this->db->link, $data['address']);
    $country = mysqli_real_escape_string($this->db->link, $data['country']);
    $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
    $query = "INSERT INTO tbl_customer(name,city,zipcode,email,phone,address,country,password)
     VALUES ('$name','$city','$zipcode','$email','$phone','$address','$country','$password')";
    $result = $this->db->insert($query);
    if ($result) {
      $alert = "<span class='success'>Register successfully </span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Register not successfully </span>";
      return $alert;
    }
  }

  public function show_customer($id)
  {
    $query = "SELECT * FROM tbl_customer WHERE id='$id'";
    $result = $this->db->select($query);
    return $result;
  }

  public function login_customer($data)
  {
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
    $query = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password' LIMIT 1";
    $result = $this->db->select($query);
    if ($result) {
      $result=$result->fetch_assoc();
      $_SESSION['customer']=$result['id'];
      echo "<script>window.location='offlinepayment.php'</script>";
    } else {
      $alert = "<span class='error'>SAI EMAIL HOẶC MẬT KHẨU</span>";
      return $alert;
    }
  }

  public function update_customer($data,$id){
    $name = mysqli_real_escape_string($this->db->link, $data['name']);
    $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
    $address = mysqli_real_escape_string($this->db->link, $data['address']);
    $query = "UPDATE tbl_customer SET name='$name', zipcode='$zipcode', email='$email', 
              phone='$phone', address='$address' WHERE id='$id' ";
    $result = $this->db->insert($query);
    if ($result) {
      $alert = "<span class='success'>Update successfully </span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Update not successfully </span>";
      return $alert;
    }
  }
}
