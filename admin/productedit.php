<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/brand.php';
include_once '../classes/category.php';
include_once '../classes/product.php';
$pd = new product();
if (isset($_GET['productId']) && is_numeric($_GET['productId'])) {
  $id = $_GET['productId'];
  $product = $pd->getProductById($id);
} else {
  echo "<script>window.location='productlist.php'</script>";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $updateProduct = $pd->update_product($_POST, $_FILES,$id);
  echo "<script>window.location='productlist.php'</script>";
}
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Sửa sản phẩm</h2>
    <?php
    if (isset($updateProduct)) {
      echo $updateProduct;
    }
    ?>
    <div class="block">
      <form action="" method="post" enctype="multipart/form-data">
        <table class="form">
          <tr>
            <td>
              <label>Name</label>
            </td>
            <td>
              <input value="<?php echo $product['productName'] ?>" required name="productName" type="text" class="medium" />
            </td>
          </tr>
          <tr>
            <td>
              <label>Category</label>
            </td>
            <td>
              <select required id="select" name="category">
                <option>Select Category</option>
                <?php
                $cat = new category();
                $catlist = $cat->show_category();
                if ($catlist) {
                  while ($result = $catlist->fetch_assoc()) {
                ?>
                    <option <?php if ($result['catId'] == $product['catId']) echo 'selected' ?> value="<?php echo $result['catId'] ?>">
                      <?php echo $result['catName'] ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label>Brand</label>
            </td>
            <td>
              <select required id="select" name="brand">
                <option>Select Brand</option>
                <?php
                $brand = new brand();
                $brandlist = $brand->show_brand();
                if ($brandlist) {
                  while ($result = $brandlist->fetch_assoc()) {
                ?>
                    <option <?php if ($result['brandId'] == $product['brandId']) echo 'selected' ?> value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                <?php
                  }
                }
                ?>

              </select>
            </td>
          </tr>

          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Description</label>
            </td>
            <td>
              <textarea required name=" product_desc" class="tynymce"><?php echo $product['product_desc'] ?></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label>Price</label>
            </td>
            <td>
              <input value="<?php echo $product['price'] ?>" required name=" price" type="number" placeholder="Enter Price..." class="medium" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Upload Image</label>
            </td>
            <td>
              <img width="100" src="<?php echo 'uploads/'.$product['image'] ?>" alt=""><br/>
              <input type="file" name="image" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Product Type</label>
            </td>
            <td>
              <select required id="select" name="type">
                <option>Select Type</option>
                <option <?php if ($product['type'] == 1) echo 'selected' ?> value="1">Featured</option>
                <option <?php if ($product['type'] == 0) echo 'selected' ?> value="0">Non-Featured</option>
              </select>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <input type="submit" name="submit" Value="UPDATE" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
  });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>