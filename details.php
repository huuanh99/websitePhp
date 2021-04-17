<?php
include_once 'inc/header.php';
if (isset($_GET['proId']) && is_numeric($_GET['proId'])) {
	$id = $_GET['proId'];
} else {
	echo "<script>window.location='404/404.php'</script>";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity=$_POST['quantity'];
	$addToCart = $ct->add_to_cart($id,$quantity);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_details = $product->get_details($id);
			if ($get_product_details) {
				while ($result = $get_product_details->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result['productName'] ?> </h2>
							<p><?php echo $fm->textShorten($result['product_desc'],50) ?></p>
							<div class="price">
								<p>Price: <span><?php echo number_format($result['price'],0,',','.').' VND' ?></span></p>
								<p>Category: <span><?php echo $result['catName'] ?></span></p>
								<p>Brand:<span><?php echo $result['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
							</div>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $result['product_desc']?></p>
						</div>

					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php
					 $categories=$cat->show_category();
					 if($categories){
						 while($result=$categories->fetch_assoc()){
					?>
					<li><a href="productbycat.php?catid=<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></a></li>
					<?php	 
							}
						}
					?>
				</ul>
			</div>
		</div>
	</div>

	<?php
	include_once 'inc/footer.php';
	?>