	<h1>Товары категорий <?php echo $this->cat_data['cat_name'] ?> </h1>
	<div class="col-sm-8 blog-main">
		<div class="row">
		<?php if (isset($this->products)): ?>
				<?php foreach ($this->products as $item): ?>
					<div class="col-lg-4">
						<a href="<?php echo URL."product/".$item['product_id']; ?>/">
							<img width="190" height="108" class="img-circle" src="<?php echo URL."public/img/products/".$item['product_image'] ?>"  alt="" style="width: 140px; height: 140px;">
						</a>
						<h2><?php echo $item['product_name'] ?></h2>
						<p class="price">Price: $<?php echo $item['product_price'] ?></p>
						<p><a class="btn btn-default" href="<?php echo URL."product/".$item['product_id']; ?>/" role="button">View details &raquo;</a></p>
					</div>
				<?php endforeach ?>
			<?php else: ?>
			<?php foreach ($this->child_cats as $item): ?>
				<h2><a href="<?php echo URL ?>category/<?php echo $item['cat_id'] ?>/"><?php echo $item['cat_name'] ?></a></h2>
			<?php endforeach ?>
		<?php endif ?>
		</div>
	</div>