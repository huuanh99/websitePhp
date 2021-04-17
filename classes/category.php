<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');


class category
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function insert_category($catName)
  {
    $catName = $this->fm->validation($catName);
    $catName = mysqli_real_escape_string($this->db->link, $catName);
    if (empty($catName)) {
      $alert = "<span class='error'>Category must be not empty </span>";
      return $alert;
    } else {
      $query = "INSERT INTO tbl_category(catName) VALUES ('$catName')";
      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Category successfully </span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Category not successfully </span>";
        return $alert;
      }
    }
  }

  public function show_category()
  {
    $query = "SELECT * FROM tbl_category order by catId desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function getCatById($catId)
  {
    $query = "SELECT * FROM tbl_category WHERE catId='$catId' LIMIT 1";
    $result = $this->db->select($query);
    if ($result != false) {
      $value = $result->fetch_assoc();
      return $value;
    } else {
      return false;
    }
  }

  public function getProductByCat($catId)
  {
    $query = "SELECT * FROM tbl_product WHERE catId='$catId' ORDER BY productId desc";
    $result = $this->db->select($query);
    return $result;
  }

  public function update_category($catName, $catId)
  {
    $catName = $this->fm->validation($catName);
    $catName = mysqli_real_escape_string($this->db->link, $catName);
    $catId = mysqli_real_escape_string($this->db->link, $catId);
    if (empty($catName)) {
      $alert = "<span class='error'>Category must be not empty </span>";
      return $alert;
    } else {
      $query = "UPDATE tbl_category SET catName='$catName' WHERE catId='$catId'";
      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Update Category successfully </span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Update Category not successfully </span>";
        return $alert;
      }
    }
  }

  public function del_category($id)
  {
    $query = "DELETE FROM tbl_category WHERE catId = '$id'";
    $result = $this->db->delete($query);
    if ($result) {
      $alert = "<span class='success'>Delete Category successfully </span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Delete Category not successfully </span>";
      return $alert;
    }
  }
}
