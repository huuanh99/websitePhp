<div class="header_bottom">
<div class="rightsidebar span_3_of_1">
	<h2>CATEGORIES</h2>
	<ul>
		<?php
		$categories = $cat->show_category();
		if ($categories) {
			while ($result = $categories->fetch_assoc()) {
		?>
				<li><a href="productbycat.php?catid=<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></a></li>
		<?php
			}
		}
		?>
	</ul>
</div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <?php
                    $slider_featured = $product->getProductFeatured();
                    if ($slider_featured) {
                        while ($result = $slider_featured->fetch_assoc()) {
                    ?>
                        <li><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>