<div class="col-md-9">

	<h1><?php echo $this->product['product_name'] ?> </h1>
	<p class="lead">
	<img width="500" ng-src="<?php echo URL."public/img/products/".$this->product['product_image'] ?>" on-error-src="public/no-image.jpg" />
	</p>
	Price: <?php echo $this->product['product_price'] ?>
<p>
	
	<a id="removeBasket_<?php echo $this->product['product_id'] ?>"
		<?php if ($this->productInBasket == 0): ?>
			class="hide"
		<?php endif ?>
	onClick="removeFromBasket(<?php echo $this->product['product_id']?>); return false;" href="#" alt="Удалить из корзины">Удалить из корзины</a>

	<a id="addBasket_<?php echo $this->product['product_id'] ?>"
		<?php if ($this->productInBasket == 1): ?>
			class="hide"
		<?php endif ?>
	onClick="addToBasket(<?php echo $this->product['product_id']?>); return false;" href="#" alt="add to basket">Дабавить корзину</a>
</p>

	<p><h2>Description</h2> <br> <?php echo $this->product['product_description'] ?></p>

</div>