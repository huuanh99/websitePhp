<?php
include_once 'inc/header.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];
	$deleteItemInCart = $ct->delete_item_in_cart($id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$id = $_POST['idProduct'];
	$updateCart = $ct->update_cart($id, $quantity);
}
$subtotal = 0;
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					if (isset($_SESSION['cart'])) {
						foreach ($_SESSION['cart'] as $k => $v) {
							$pd = $product->getProductById($k);
					?>
							<tr>
								<td><?php echo $pd['productName'] ?></td>
								<td> <a href="details.php?proId=<?php echo $pd['productId'] ?>">
										<img src="admin/uploads/<?php echo $pd['image'] ?>" alt="" />
									</a>
								</td>
								<td><?php echo number_format($pd['price'], 0, ',', '.') . ' VND' ?></td>
								<td>
									<form action="" method="post">
										<input min="1" type="number" name="quantity" value="<?php echo $v ?>" />
										<input type="hidden" name="idProduct" value="<?php echo $k ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php echo number_format($pd['price'] * $v, 0, ',', '.') . ' VND' ?></td>
								<td><a onclick="return confirm('Do you want to delete?')" href="?id=<?php echo $k ?>">Xóa</a></td>
							</tr>
					<?php
							$subtotal += $pd['price'] * $v;
						}
					}
					$_SESSION['total'] = $subtotal;
					?>


				</table>
				<?php
				if ($subtotal == 0) {
					echo "<span class='empty_cart'>Your cart is empty. Please Shopping now</span>";
				} else {
				?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Giá hàng : </th>
							<td><?php echo number_format($subtotal, 0, ',', '.') . ' VND' ?></td>
						</tr>
						<tr>
							<th>Khuyến mãi : </th>
							<td><?php echo number_format($subtotal * 0.1, 0, ',', '.') . ' VND' ?></td>
						</tr>
						<tr>
							<th>Tổng số tiền :</th>
							<td><?php echo number_format($subtotal * 0.9, 0, ',', '.') . ' VND' ?> </td>
						</tr>
					</table>
				<?php
				}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include_once 'inc/footer.php';
?>