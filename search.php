<?php
include_once 'inc/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$keyword=$_POST['keyword'];
	$searchProduct = $product->search_product($keyword);
}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản phẩm bạn tìm kiếm</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			if ($searchProduct) {
				while ($result = $searchProduct->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?proId=<?php echo $result['productId'] ?>"><img height="250" src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
						<h2><?php echo $result['productName'] ?></h2>
						<p><span class="price"><?php echo number_format($result['price'],0,',','.').' VND' ?></span></p>
						<div class="button"><span><a href="details.php?proId=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>



	</div>
</div>

<?php
include_once 'inc/footer.php';
?>