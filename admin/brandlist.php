<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/brand.php';
$brand = new brand();
if (isset($_GET['delId']) && is_numeric($_GET['delId'])) {
	$id = $_GET['delId'];
	$del_brand = $brand->del_brand($id);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>brand List</h2>
		<div class="block">
			<?php if (isset($del_brand)) {
				echo $del_brand;
			} ?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Brand Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_brand = $brand->show_brand();
					if ($show_brand) {
						$i = 0;
						while ($result = $show_brand->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['brandName'] ?></td>
								<td><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a> || <a onclick="return confirm('Do you want to delete?')" href="?delId=<?php echo $result['brandId'] ?>">Delete</a></td>
							</tr>
					<?php
						}
					} ?>
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