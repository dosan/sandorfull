<div class="col-sm-8 blog-main">
	<div class="row">
		<?php foreach ($this->products as $item): ?>
		<div class="col-lg-4">
			<img width="190" height="108" class="img-circle" src="<?php echo URL."public/img/products/".$item['product_image'] ?>" alt="" style="width: 140px; height: 140px;">
			<h2><?php echo $item['product_name'] ?></h2>
			<a href="<?php echo URL."product/".$item['product_id']; ?>/"></a>
			<p class="price">Price: $<?php echo $item['product_price'] ?></p>
			<p><a class="btn btn-default" href="<?php echo URL."product/".$item['product_id']; ?>/" role="button">View details &raquo;</a></p>
		</div><!-- /.col-lg-4 -->
		<?php endforeach ?>
	</div><!-- /.row -->
</div>