<div class="col-sm-8 blog-main">
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
		
	<?php
		$i = 1;
		foreach ($this->resultProducts as $item): ?>

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
	<?php 
			$i++;
	endforeach ?>
		
	</table>
		
	<?php if (Session::get('user_login_status') == 1):
		$buttonClass = "";
	?>

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
	<?php else: ?>
		
		<div id="loginBox">
			<h2>Авторизация</h2>
					<div class="form-group">
						<label for="user_name">Логин</label>
						<input class="form-control" type="text" id="user_name" name="user_name" value=""/>
					</div>
					<div class="form-group">
						<label for="user_password">Пароль</label>
						<input class="form-control" type="password" id="user_password" name="user_password" value=""/>
					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="button" onclick="login();" value="Войти"/>
					</div>
		</div> 
		
		<div id="registerBox">или
			<h2>Регистрация нового пользователя:</h2>
				<div class="form-group">
					<label for="login_input_username">Ваше Имя * (Толко буквы и числа, от 4 до 64 сиволов)</label>
					<input class="form-control" id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" id="user_name" name="user_name" required />
				</div>
				<div class="form-group">
					<label for="login_input_email">Ваш Email *</label>
					<input class="form-control" id="login_input_email" class="login_input" type="email" name="user_email" required />
				</div>
				<div class="form-group">
					<label for="login_input_password_new">Пароль * : (мин. 6 символов)</label>
					<input class="form-control" id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
				</div>
				<div class="form-group">
					<label for="login_input_password_repeat">Повторить пароль * :</label>
					<input class="form-control" id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
				</div>
				<div class="form-group">
					<label for="user_phone">Тел * :</label>
					<input class="form-control" type="text" id="user_phone" pattern="[0-9]{4,64}" name="user_phone" value="" />
				</div>
				<div class="form-group">
					<label for="user_adress">Адрес * :</label>
					<textarea class="form-control"  id="user_adress" name="user_adress" /></textarea>
				</div>
				<input class="btn btn-primary" type="button"  onclick="registerNewUser();" value="Зарегистрироваться"/>
		</div>
		
	<?php 
		$buttonClass = "class='hide'";
	endif ?>

	<input <?php echo $buttonClass ?> id="btnSaveOrder" type="button" onclick="saveOrder();" value="Оформить заказ"/>
	</form>
</div>
