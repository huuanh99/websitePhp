<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');


class product
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function insert_product($data, $file)
  {
    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
    $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
    $category = mysqli_real_escape_string($this->db->link, $data['category']);
    $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    $type = mysqli_real_escape_string($this->db->link, $data['type']);

    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;
    move_uploaded_file($file_temp, $uploaded_image);
    if ($productName == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '' || $file_name == '') {
      $alert = "<span class='error'>Fields must be not empty </span>";
      return $alert;
    } else {
      $query = "INSERT INTO tbl_product(productName,brandId,catId,product_desc,price,type,image) VALUES ('$productName',
          '$brand','$category','$product_desc','$price','$type','$unique_image')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Product successfully </span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Product not successfully </span>";
        return $alert;
      }
    }
  }

  public function show_product()
  {
    $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
              FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId=tbl_category.catId
              INNER JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandId
              order by tbl_product.productId desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function get_details($id){
    $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
              FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId=tbl_category.catId
              INNER JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandId
              WHERE tbl_product.productId='$id'";
    $result = $this->db->select($query);
    return $result;
  }

  public function getProductById($productId)
  {
    $query = "SELECT * FROM tbl_product WHERE productId='$productId' LIMIT 1";
    $result = $this->db->select($query);
    if ($result != false) {
      $value = $result->fetch_assoc();
      return $value;
    } else {
      return false;
    }
  }

  public function getLastApple(){
    $query = "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }

  public function getLastSamsung(){
    $query = "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }

  public function getLastAcer(){
    $query = "SELECT * FROM tbl_product WHERE brandId='9' ORDER BY productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }

  public function getLastCanon(){
    $query = "SELECT * FROM tbl_product WHERE brandId='10' ORDER BY productId desc LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }

  public function getProductFeatured()
  {
    $query = "SELECT * FROM tbl_product WHERE type='1' ";
    $result = $this->db->select($query);
    return $result;
  }

  public function getproduct_new()
  {
    $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT 4 ";
    $result = $this->db->select($query);
    return $result;
  }

  public function update_product($data, $file, $id)
  {
    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
    $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
    $category = mysqli_real_escape_string($this->db->link, $data['category']);
    $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    $type = mysqli_real_escape_string($this->db->link, $data['type']);

    $permited = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;
    if ($productName == '' || $brand == '' || $category == '' || $product_desc == '' || $price == '' || $type == '') {
      $alert = "<span class='error'>Fields must be not empty </span>";
      return $alert;
    } else {
      if (!empty($file_name)) {
        if ($file_size > 999999) {
          $alert = "<span class='error'>Images size must be less than 2MB</span>";
          return $alert;
        } elseif (in_array($file_ext, $permited) == false) {
          $alert = "<span class='error'>You can upload only:" . implode(',', $permited) . "</span>";
          return $alert;
        }
        $product = $this->getProductById($id);
        if ($product != false) {
          unlink("uploads/" . $product['image']);
          move_uploaded_file($file_temp, $uploaded_image);
        }
        $query = "UPDATE tbl_product SET productName='$productName',brandId='$brand',
                 catId='$category',product_desc='$product_desc',type='$type',
                 price='$price',image='$unique_image'  WHERE productId='$id'";
      } else {
        $query = "UPDATE tbl_product SET productName='$productName',brandId='$brand',
        catId='$category',product_desc='$product_desc',type='$type',
        price='$price'  WHERE productId='$id'";
      }
      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Update Product successfully </span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Update Product not successfully </span>";
        return $alert;
      }
    }
  }

  public function del_product($id)
  {
    $query = "DELETE FROM tbl_product WHERE productId = '$id'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Delete Product successfully </span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Delete Product not successfully </span>";
      return $alert;
    }
  }

  public function search_product($keyword){
    $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$keyword%' ";
    $result = $this->db->select($query);
    return $result;
  }
}
