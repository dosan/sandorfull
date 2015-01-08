<div class="content">
	<form method="post" id="loginForm">
		<div class="col-md-4 col-md-offset-3">
			<h2 class="form-header"><?php echo $this->mess['header_sign_in'];?></h2>
		</div>
		<div class="l_form_input">
			<input name="user_name" type="text" id="user_name" class="form-control" value="" placeholder="<?php echo $this->mess['ph_email_or_login'];?>" autofocus>
		</div>
		<div id="errUserName"></div>
		<div class="l_form_input">
			<input name="user_password" type="password" id="user_password" class="form-control" value="" placeholder="<?php echo $this->mess['ph_password'];?>">
		</div>
		<div id="errUserPassword"></div>
		<div class="col-md-4 col-md-offset-3">
			<a href="#" class="button small submit" onclick="loginAd('loginForm'); return false;">Login</a>
			<a href="<?php echo URL ?>user/register" title="Регистрация"><?php echo $this->mess['link_to_register'];?></a>
		</div>
	</form>
</div>