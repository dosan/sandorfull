<div class="content">
	<div class="col-md-5 col-md-offset-2">
		<h2 class="form-header"><?php echo $this->mess['header_sign_up'] ?></h2>
	</div>
	<form method="post" id="registerForm">
		<div class="r_form_input">
			<input type="text" name="user_name" id="user_name" class="form-control" value="" placeholder="<?php echo $this->mess['r_ph_username'] ?>" autofocus>
		</div>
		<div class='hide' id="errUserName"></div>
		<div class="r_form_input">
			<input id="user_email" class="form-control" type="email" name="user_email" placeholder="<?php echo $this->mess['r_ph_email'] ?>"  />
		</div>
		<div class='hide' id="errUserEmail"></div>
		<div class="r_form_input">
			<input id="user_password" class="form-control" type="password" name="user_password" placeholder="<?php echo $this->mess['r_ph_password'] ?>" autocomplete="off" />
		</div>
		<div class='hide' id="errUserPassword"></div>
		<div class="r_form_input">
			<input id="user_password_repeat" class="form-control" type="password" name="user_password_repeat" placeholder="<?php echo $this->mess['r_ph_rep_password'] ?>" autocomplete="off" />
		</div>
		<div class='hide' id="errUserPasswordNew"></div>
		<div class="col-md-5 col-md-offset-2">
			<a href="#" class="button small submit" onclick="registerNewUser('registerForm'); return false;"><?php echo $this->mess['btn_register'] ?></a>
			<a href="<?php echo URL.'user' ?>"><?php echo $this->mess['back_to_login'] ?></a>
		</div>
	</form>
</div>