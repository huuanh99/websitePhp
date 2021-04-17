<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/brand.php';
include_once '../classes/category.php';
include_once '../classes/product.php';
include_once '../helpers/format.php';
$pd = new product();
$fm = new Format();
if (isset($_GET['productId']) && is_numeric($_GET['productId'])) {
	$id = $_GET['productId'];
	$delpro = $pd->del_product($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<?php if (isset($delpro)) {
				echo $delpro;
			} ?>
			<table class="data display datatable" id="example">
				<thead>

					<tr>
						<th width="5%">ID</th>
						<th width="15%">Product Name</th>
						<th width="10%">Price</th>
						<th width="10%">Image</th>
						<th width="10%">Category</th>
						<th width="10%">Brand</th>
						<th width="20%">Description</th>
						<th width="10%">Type</th>
						<th width="10%">Action</th>
					</tr>

				</thead>
				<tbody>
					<?php
					$pdlist = $pd->show_product();
					if ($pdlist) {
						$i = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $fm->textShorten($result['productName'], 50) ?></td>
								<td><?php echo number_format($result['price'], 0, ',', '.') . ' VND' ?></td>
								<td><img width="80" src="<?php echo 'uploads/' . $result['image'] ?>" alt=""></td>
								<td><?php echo $result['catName'] ?></td>
								<td><?php echo $result['brandName'] ?></td>
								<td><?php echo $fm->textShorten($result['product_desc'], 50) ?></td>
								<td><?php
										if ($result['type'] == 1) 	echo 'Featured';
										else echo 'Non-Featured';
										?></td>
								<td><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a> || <a onclick="return confirm('Do you want to delete?')" href="?productId=<?php echo $result['productId'] ?>">Delete</a></td>
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