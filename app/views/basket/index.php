<div class="col-sm-8 blog-main">
<h2>Данные заказа</h2>
<?php if ($this->product == null): ?>
	<h2>В корзине пусто</h2>
<?php else: ?>
<form action="<?php echo URL ?>basket/order/" method="POST">
	<div class="table-responsive">
	<table class="table table-striped">
		<tr>
			<td>
				№
			</td>
			<td>
				Наименование
			</td>
			<td>  
			   Количество
			</td>
			<td>  
			   Цена за еденицу
			</td>
			<td>
			   Цена
			</td>
			<td>
				Действие
			</td>
		</tr>
	<?php
	$i = 1;
	 foreach ($this->product as $item): ?>
	<tr>
			<td>
				<?php echo $i; ?>
			</td>
			<td>
				<a href="<?php echo URL ?>product/<?php echo $item['product_id']; ?>">
				<?php echo $item['product_name']; ?>
				</a><br>
			</td>
			<td>  
				<input name="itemCount_<?php echo $item['product_id'] ?>" id="itemCount_<?php echo $item['product_id']?>" type='text' value='1' onchange="conversionPrice(<?php echo $item['product_id'] ?>);">
			</td>
			<td>  
				<span id="itemPrice_<?php echo $item['product_id'] ?>" value="<?php echo $item['product_price'] ?>">
					<?php echo $item['product_price'] ?>
				</span>
			</td>
			<td> 
				<span id="itemRealPrice_<?php echo $item['product_id'] ?>">
					<?php echo $item['product_price'] ?>
				</span>
			</td>
			<td> 
			<a id="removeBasket_<?php echo $item['product_id'] ?>" onClick="removeFromBasket(<?php echo $item['product_id']?>); return false;" href="#" alt="Удалить из корзины">Delete</a>
			
			<a id="addBasket_<?php echo $item['product_id'] ?>" class="hide" onClick="addToBasket(<?php echo $item['product_id']?>); return false;" href="#" alt="add to basket">Undo</a>
			</td>
	</tr>	
	<?php $i++ ?>
	<?php endforeach ?>
	</table>

   <input name='buttonOrder' type="submit" class='btn btn-lg btn-success' value="Оформить заказ"/>    
	</div>
</form>	
	
<?php endif ?>
</div>