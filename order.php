<?php
include_once 'inc/header.php';
if(!isset($_SESSION['customer'])){
  echo "<script>window.location='login.php'</script>";
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];
	$receiveOrder = $ct->receive_order($id);
}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Order</h2>
				<table class="tblone">
					<tr>
						<th width="25%">Tổng số tiền</th>
						<th width="25%">Thời gian đặt hàng</th>
						<th width="25%">Tình trạng</th>
						<th width="25%">Chi tiết đơn hàng</th>
					</tr>
					<?php
					$orders=$ct->show_order($_SESSION['customer']);
          if($orders){
            while($result=$orders->fetch_assoc()){
					?>
							<tr>
								<td><?php echo number_format($result['total'], 0, ',', '.') . ' VND' ?></td>
								<td><?php echo $fm->formatDate($result['time_order']) ?></td>
								<td><?php if($result['status']==0){
                  echo 'Đang chờ xử lý';
                }else if($result['status']==1){
								?>
								<a onclick="return confirm('Bạn xác nhận đã nhận hàng ?')" href="?id=<?php echo $result['id'] ?>">Đang giao hàng</a>
								<?php
								}
								else{
                  echo 'Đã nhận hàng';
                } ?></td>
								<td><a href="orderdetail.php?id=<?php echo $result['id'] ?>">Chi tiết đơn hàng</a></td>
							</tr>
					<?php
						}
					}
					?>
				</table>
				<?php
				if($orders==null){
					echo "<span class='empty_cart'>Bạn chưa có đơn hàng nào</span>";
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
