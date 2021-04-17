<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/category.php';
$cat = new category();
if (isset($_GET['catId']) && is_numeric($_GET['catId'])) {
  $id = $_GET['catId'];
  $category = $cat->getCatById($id);
} else {
  echo "<script>window.location='catlist.php'</script>";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $catName = $_POST['catName'];
  $update_cat = $cat->update_category($catName, $id);
}
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Sửa danh mục sản phẩm</h2>
    <div class="block copyblock">
      <?php if (isset($update_cat)) {
        echo $update_cat;
      } ?>
      <form action="" method="POST">
        <table class="form">
          <tr>
            <td>
              <input readonly type="text" class="medium" value="<?php if ($category != false) echo $category['catName'] ?>" />
            </td>
          </tr>
          <tr>
            <td>
              <input name="catName" type="text" placeholder="Nhập tên danh mục sản phẩm mới" class="medium" required />
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