<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/brand.php';
$brand = new brand();
if (isset($_GET['brandId']) && is_numeric($_GET['brandId'])) {
  $id = $_GET['brandId'];
  $brandEdit = $brand->getBrandById($id);
} else {
  echo "<script>window.location='brandlist.php'</script>";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $brandName = $_POST['brandName'];
  $update_brand = $brand->update_brand($brandName, $id);
}
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Sửa thương hiệu sản phẩm</h2>
    <div class="block copyblock">
      <?php if (isset($update_brand)) {
        echo $update_brand;
      } ?>
      <form action="" method="POST">
        <table class="form">
          <tr>
            <td>
              <input readonly type="text" class="medium" value="<?php if ($brandEdit != false) echo $brandEdit['brandName'] ?>" />
            </td>
          </tr>
          <tr>
            <td>
              <input name="brandName" type="text" placeholder="Nhập tên thương hiệu sản phẩm mới" class="medium" required />
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="submit" Value="UPDATE" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php include 'inc/footer.php'; ?>