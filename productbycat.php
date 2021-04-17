<?php
include_once 'inc/header.php';
if (isset($_GET['catid']) && is_numeric($_GET['catid'])) {
	$id = $_GET['catid'];
	$category = $cat->getCatById($id);
} else {
	echo "<script>window.location='index.php'</script>";
}

?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Category: <?php echo $category['catName'] ?></h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getProductByCat = $cat->getProductByCat($id);
			if ($getProductByCat) {
				while ($result = $getProductByCat->fetch_assoc()) {
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