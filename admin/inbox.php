<?php
include 'inc/header.php';
include 'inc/sidebar.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$id = $_GET['id'];
	$handleOrder = $ct->handle_order($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Quản lý đơn hàng</h2>
		<div class="block">
			<?php
			if (isset($handleOrder)) {
				echo 	$handleOrder;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Tên khách hàng</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ nhận hàng</th>
						<th>Tổng số tiền</th>
						<th>Thời gian đặt hàng</th>
						<th>Trạng thái</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pendingOrder = $ct->showPendingOrder();
					if ($pendingOrder) {
						$i = 0;
						while ($result = $pendingOrder->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['name'] ?></td>
								<td><?php echo $result['phone'] ?></td>
								<td><?php echo $result['address'] ?></td>
								<td><?php echo number_format($result['total'], 0, ',', '.') . ' VND' ?></td>
								<td><?php echo $fm->formatDate($result['time_order']) ?></td>
								<td><?php if ($result['status'] == 0) { ?>
										<a href="?id=<?php echo $result['id'] ?>">Đang chờ xử lý</a>
									<?php
										} else {
											echo 'Đang vận chuyển';
										}
									?>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>