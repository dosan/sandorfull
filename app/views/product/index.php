<div class="col-md-9">
	<div class="row">
	<?php if (isset($products)): ?>
		<?php foreach ($products as $item): ?>
			<div class="col-sm-4 col-lg-4 col-md-4">
				<div class="thumbnail">
				<a href="<?php echo URL."product/".$item['product_id']; ?>/">
					<img style="max-height: 150px; height: 150px;" src="<?php echo URL."public/img/products/".$item['product_image'] ?>" alt="Product">
				</a>
					<div class="caption">
						<h4 class="pull-right"><?php echo $item['product_price'] ?>tg</h4>
						<h4><a href="<?php echo URL."product/".$item['product_id']; ?>/"><?php echo $item['product_name'] ?></a></h4>
						<p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
	<?php foreach ($child_cats as $item): ?>
		<h2><a href="<?php echo URL ?>category/<?php echo $item['cat_id'] ?>/"><?php echo $item['cat_name'] ?></a></h2>
		<?php endforeach ?>
	<?php endif ?>
	</div>
</div>