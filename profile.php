<?php
include_once 'inc/header.php';
if (!isset($_SESSION['customer'])) {
  echo "<script>window.location='login.php'</script>";
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
	$updateCustomer=$cs->update_customer($_POST,$_SESSION['customer']);
}
?>

<div class="main">
  <div class="content">
    <div class="section group">
      <div class="content_top">
        <div class="heading">
          <h3>Profile Customer</h3>
        </div>
        <div class="clear"></div>
      </div>
      <form action="" method="post">
      <table class="tblone">
        <tr>
        <?php
            if(isset($updateCustomer)){
              echo '<td colspan="3">'.$updateCustomer.'</td>';
            }
          ?>
        </tr>
        <?php
        $get_customer = $cs->show_customer($_SESSION['customer']);
        if ($get_customer) {
          while ($result = $get_customer->fetch_assoc()) {
        ?>
            <tr>
              <td>NAME</td>
              <td>:</td>
              <td><input required type="text" name="name" id="" value="<?php echo $result['name'] ?>"></td>
            </tr>
            <tr>
              <td>ADDRESS</td>
              <td>:</td>
              <td><input required type="text" name="address" id="" value="<?php echo $result['address'] ?>"></td>
            </tr>
            <tr>
              <td>ZIPCODE</td>
              <td>:</td>
              <td><input required type="text" name="zipcode" id="" value="<?php echo $result['zipcode'] ?>"></td>
            </tr>
            <tr>
              <td>PHONE</td>
              <td>:</td>
              <td><input required type="text" name="phone" id="" value="<?php echo $result['phone'] ?>"></td>
            </tr>
            <tr>
              <td>EMAIL</td>
              <td>:</td>
              <td><input required type="text" name="email" id="" value="<?php echo $result['email'] ?>"></td>
            </tr>
            <tr>
            <td colspan="3"><input type="submit" name="update" value="UPDATE"> </td>
            </tr>
        <?php
          }
        }
        ?>
      </table>
      </form>
     
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>