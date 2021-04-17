<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/brand.php';
$brand = new brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $brandName = $_POST['brandName'];
  $insert_brand = $brand->insert_brand($brandName);
}
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Thêm thương hiệu sản phẩm</h2>
    <div class="block copyblock">
      <?php if (isset($insert_brand)) {
        echo $insert_brand;
      } ?>
      <form action="" method="POST">
        <table class="form">
          <tr>
            <td>
              <input name="brandName" type="text" placeholder="Thêm thương hiệu sản phẩm..." class="medium" />
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="submit" Value="Save" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php include 'inc/footer.php'; ?>