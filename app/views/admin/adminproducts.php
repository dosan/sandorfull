<div ng-app="ProductApp" ng-controller="AdminCtrl">
	<h2>Продукты</h2>
	<form name="addProduct" novalidate>
		<table border="1" cellpadding="1" cellspacing="1">
			<caption>Дабавить продукт</caption>
			<tr>
				<th>Название</th>
				<th>Цена</th>
				<th>Категория</th>
				<th>Описание</th>
				<th>Сохранить</th>
			</tr>
			<tr>
					<td>
						<input type="text" ng-model="product.name" name="pName" required=""><br>
						<div class="warning" ng-show="addProduct.$submitted || addProduct.pName.$touched">
							<div ng-show="addProduct.pName.$error.required">Provide product name.</div>
						</div>
					</td>
					<td>
						<input type="number" ng-model="product.price" name="pPrice" required="">
						<div class="warning" ng-show="addProduct.$submitted || addProduct.pPrice.$touched">
							<div ng-show="addProduct.pPrice.$error.required">Provide product price</div>
							<div ng-show="addProduct.pPrice.$error.number">Not valid number!</div>
						</div>
					</td>
					<td>
						<select ng-model="product.category" name="pCategory" required="">
						<option value="0">Главная категория
						<?php foreach ($this->resultCategories as $item): ?>
							<option value="<?php echo $item['cat_id'] ?>"><?php echo $item['cat_name'] ?>
						<?php endforeach ?>
						</select>
						<div class="warning" ng-show="addProduct.$submitted || addProduct.pCategory.$touched">
							<div ng-show="addProduct.pCategory.$error.required">Choose the category</div>
						</div>
					</td>
					<td>
						<textarea ng-model="product.description" name="pDesc" required=""></textarea>
						<div class="warning" ng-show="addProduct.$submitted || addProduct.pDesc.$touched">
							<div ng-show="addProduct.pDesc.$error.required">Fill the product description</div>
						</div>
					</td>
					<td>
						<input type="submit" ng-click="save(product)" value="Сохранить">
					</td>
			</tr>
		</table>
	</form>
	<form name="editProduct" novalidate>
		<table border="1" cellpadding="1" cellspacing="1">
			<caption>Редакировать</caption>
			<tr>
				<th>N</th>
				<th>ID</th>
				<th>Название</th>
				<th>Цена</th>
				<th>Категория</th>
				<th>Описание</th>
				<th>X</th>
				<th>Изображение</th>
				<th>Сохранить</th>
			</tr>
			<?php $i=1; foreach ($this->resultProducts as $item): ?>
			<tr>
				<td><?php echo $i++ ?></td>
				<td><?php echo $item['product_id'] ?></td>
				<td>
					<input type="text" id="itemName_<?php echo $item['product_id'] ?>" value="<?php echo $item['product_name'] ?>">
				</td>
				<td>
					<input type="number" size="7" id="itemPrice_<?php echo $item['product_id'] ?>" value="<?php echo $item['product_price'] ?>">
				</td>
				<td>
					<select id="itemCatId_<?php echo $item['product_id'] ?>">
					<option value="0">Главная категория
					<?php foreach ($this->resultCategories as $itemCat): ?>
						<option value="<?php echo $itemCat['cat_id'] ?>"  <?php if ($item['cat_id'] == $itemCat['cat_id']) { ?>selected <?php } ?>><?php echo $itemCat['cat_name'] ?>
					<?php endforeach ?>
					</select>
				</td>
				<td>
					<textarea type="checkbox" id="itemDesc_<?php echo $item['product_id'] ?>"><?php echo $item['product_description'] ?></textarea>
				</td>
				<td>
					<input type="checkbox" id="itemStatus_<?php echo $item['product_id'] ?>" <?php $item['product_status'] == 0 ? print "checked='checked'" : ''?>>
				</td>
				<td>
					<?php if ($item['product_image']): ?>
						<img src="<?php echo URL."public/img/products/" . $item['product_image']?> " width="100">
					<?php endif ?>
					<form action="<?php echo URL ?>admin/upload/" method="post" enctype="multipart/form-data">
						<input type="file" name="filename"><br>
						<input type="hidden" name="itemId" value="<?php echo $item['product_id'] ?>">
						<input type="submit" value="загрузить"><br>
					</form>
				</td>
				<td>
					<input type="button" value="Сохранить" onClick="updateProduct(<?php echo $item['product_id'] ?>)"><br>
				</td>
			</tr>
			<?php endforeach ?>
		</table>
	</form>
</div>
