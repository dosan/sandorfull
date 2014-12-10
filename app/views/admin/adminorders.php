<h2>Заказы:</h2>
<?php if (!$this->resultOrders): ?>
	Нет заказов
<?php else: ?>
<table class="table table-striped">
		<tr>
			<th>№</th>
			<th>Действие</th>
			<th>ID заказа</th>
			<th width="110">Статус</th>
			<th>Дата создания</th>
			<th>Дата оплаты</th>
			<th>Дополнительная информация</th>
			<th>Дата изменения заказа</th>
		</tr>
		<?php

		$i = 1; foreach ($this->resultOrders as $item): ?>
			
			<tr>
				<td><?php echo $i; ?></td>
				<td><a href="#" onclick="showProducts('<?php echo $item['order_id']?>'); return false;" >Показать товар заказа</a></td>
				<td><?php echo $item['order_id']?></td>
				<td>
					<input type="checkbox" id="itemStatus_<?php echo $item['order_id'] ?>" <?php if ($item['status'] == 1) {?> checked="checked" <?php } ?> onclick="updateOrderStatus(<?php echo $item['order_id'] ?>);" >закрыть
				</td>
				<td><?php echo date('m-d, H:m', $item['date_created'])?></td>
				<td>
					<input id="datePayment_<?php echo $item['order_id'] ?>" type="text" value="<?php echo $item['date_payment'] ?>">
					<input type="button" value="Сохранить" onclick="updateOrderDatePayment(<?php echo $item['order_id'] ?>);">
				</td>
				<td><?php echo $item['comment']?></td>
				<td><?php echo $item['date_modification']?></td>
			</tr>
			
			<tr>
				<td colspan="8">
					<div class="hide" id="purchasesForOrderId_<?php echo $item['order_id']?>" >
					<?php if ($item['children']): ?>
						<table class="table table-striped">
							<tr>
								<th>№</th>
								<th>ID</th>
								<th>Название</th>
								<th>Цена</th>
								<th>Количество</th>
							</tr>
								<?php $i1 = 1; foreach ($item['children'] as $itemChild): ?>
								<tr>
									<td><?php echo $i1 ?></td>
									<td><?php echo $itemChild['product_id']?></td>
									<td><a href="<?php echo URL.'product/'.$itemChild['product_id']?>/"><?php echo $itemChild['product_name']?></a></td>
									<td><?php echo $itemChild['price']?></td>
									<td><?php echo $itemChild['amount']?></td>
								</tr>
								<?php $i1++; endforeach ?>
						</table>
					<?php endif ?>
					</div>
				</td>
			</tr>
		<?php $i++; endforeach ?>
	</table>
<?php endif ?>
</div>