<?php
include_once 'inc/header.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];
} else {
	echo "<script>window.location='order.php'</script>";
}
if (!isset($_SESSION['customer'])) {
	echo "<script>window.location='login.php'</script>";
}
$subtotal = 0;
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Chi tiết hóa đơn</h2>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
					</tr>
					<?php
					$orderdetails = $ct->show_orderdetail($id);
					if ($orderdetails) {
						while ($result = $orderdetails->fetch_assoc()) {
							$pd = $product->getProductById($result['product_id']);
					?>
							<tr>
								<td><?php echo $pd['productName'] ?></td>
								<td> <a href="details.php?proId=<?php echo $pd['productId'] ?>">
										<img src="admin/uploads/<?php echo $pd['image'] ?>" alt="" />
									</a>
								</td>
								<td><?php echo number_format($pd['price'], 0, ',', '.') . ' VND' ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo number_format($pd['price'] * $result['quantity'], 0, ',', '.') . ' VND' ?></td>
							</tr>
					<?php
							$subtotal += $pd['price'] * $result['quantity'];
						}
					}
					?>
				</table>
				<?php
				if ($subtotal == 0) {
					echo "<script>window.location='order.php'</script>";
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
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include_once 'inc/footer.php';
?>