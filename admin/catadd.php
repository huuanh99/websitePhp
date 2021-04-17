<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/category.php';
$cat = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];
    $insert_cat = $cat->insert_category($catName);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm danh mục sản phẩm</h2>
        <div class="block copyblock">
            <?php if (isset($insert_cat)) {
                echo $insert_cat;
            } ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input name="catName" type="text" placeholder="Nhập tên danh mục sản phẩm..." class="medium" />
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