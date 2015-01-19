<div class="col-md-9">
	<div class="warning"></div>
	<h2>Данные заказа</h2>
	<form id="formOrder" method="POST">
	<table class="table table-striped">
		<tr>
			<td>№</td>
			<td>Наименование</td>
			<td>Количество</td>
			<td>Цена за еденицу</td>
			<td>Стоимость</td>
		</tr>
	<?php $i = 1; foreach ($this->resultProducts as $item): ?>
			<tr>
				<td><?php echo $i ?></td>
				<td>
					<a href="<?php echo URL ?>product/<?php echo $item['product_id'] ?>/">
						<?php echo $item['product_name'] ?>
					</a></td>
				<td>
					<span id="itemCount_<?php echo $item['product_id'] ?>">
					 <input type="hidden" name="itemCount_<?php echo $item['product_id'] ?>" value="<?php echo $item['product_id'] ?>" /> 
						<?php echo $item['cnt'] ?>
					</span>
				</td>
				<td>  
					<span id="itemPrice_<?php echo $item['product_id'] ?>">
					  <input type="hidden" name="itemPrice_<?php echo $item['product_id'] ?>" value="<?php echo $item['product_price'] ?>" /> 
						<?php echo $item['product_price'] ?>
				  </span>
				</td>
				<td>  
					<span id="itemRealPrice_<?php echo $item['product_id'] ?>">
						<input type="hidden" name="itemRealPrice_<?php echo $item['product_id'] ?>" value="<?php echo $item['realPrice'] ?>" /> 
						<?php echo $item['realPrice'] ?>
					</span>
				</td>
			</tr>
	<?php $i++; endforeach ?>
	</table>
		
	<?php if (Session::get('user_login_status') == 1): $buttonClass = ""; ?>
		<h2>Данные заказчика</h2>
		<div id="orderUserInfoBox" <?php echo $buttonClass; ?>>
			<div class="form-group">
				<label for="login_input_username">Username</label>
				<input  class="form-control"  type="text" id="user_name"   name="user_name"  value="<?php echo Session::get('user_name') ?>" />
			</div>
			<div class="form-group">
				<label for="user_phone">Phone</label>
				<input  class="form-control"  type="text" id="user_phone" pattern="[0-9]{2,64}" name="user_phone" value="<?php echo Session::get('user_phone') ?>" />
			</div>
			<div class="form-group">
				<label for="user_adress">Adress</label>
				<textarea  class="form-control"  id="user_adress" name="user_adress" /><?php echo Session::get('user_adress') ?></textarea>
			</div>
		</div>
	</form>
	<?php else: ?>
	</form>
		<form method="post" id="orderLoginForm">
			<div class="form-group">
				<input name="user_name" type="text" id="user_name" class="form-control" value="" placeholder="<?php echo $this->mess['ph_email_or_login'];?>" autofocus>
			</div>
			<div class="form-group">
				<input name="user_password" type="password" id="user_password" class="form-control" value="" placeholder="<?php echo $this->mess['ph_password'];?>">
			</div>
			<a href="#" class="btn btn-primary" onclick="loginAd('orderLoginForm'); return false;">Login</a>
		</form>
	<?php $buttonClass = "class='hide'"; endif ?>
	<input <?php echo $buttonClass ?> id="btnSaveOrder" type="button" onclick="saveOrder();" value="Оформить заказ"/>
</div>
