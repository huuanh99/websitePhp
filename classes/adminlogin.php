<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../lib/session.php');

class adminlogin
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function login_admin($adminUser, $adminPass)
  {
    $adminUser = $this->fm->validation($adminUser);
    $adminPass = $this->fm->validation($adminPass);
    $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
    $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
    if (empty($adminUser) || empty($adminPass)) {
      $alert = 'User and Pass must be not empty';
      return $alert;
    } else {
      $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass' LIMIT 1";
      $result = $this->db->select($query);
      if ($result != false) {
        $value = $result->fetch_assoc();
        Session::set('adminlogin', true);
        Session::set('adminId', $value['adminId']);
        Session::set('adminUser', $value['adminUser']);
        Session::set('adminName', $value['adminName']);
        Session::set('admin', $value);
        header('Location:index.php');
      } else {
        $alert = "User and Pass not match";
        return $alert;
      }
    }
  }

  public function change_password($data)
  {
    $admin = Session::get('admin');
    $newpass = md5($data['newpass']);
    $id = Session::get('adminId');
    if ($admin['adminPass'] == md5($data['oldpass'])) {
      $query = "UPDATE tbl_admin SET adminPass='$newpass' WHERE adminId='$id'";
      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='success'>Update Password successfully </span>";
        return $alert;
      }else{
        $alert = "<span class='error'>Update Password not successfully </span>";
        return $alert;
      }
    }else{
      $alert = "<span class='error'>Mật khẩu bạn nhập không chính xác vui lòng nhập lại </span>";
      return $alert;
    }
  }
}
