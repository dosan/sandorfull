$(document).ready(function(){
	if ($("a.zoom").length > 0) {
		$("a.zoom").fancybox({
			'overlayOpacity' : 0.8,
			'overlayColor' : '#000'
		});
	}
});


/**
 * Авторизация пользователя
 * 
 */
function loginAd(idForm){
	var result;
	var res = validateLoginForm(idForm, getData('#'+idForm));
	if (res) {
		var thisArray = $('#'+idForm).serializeArray();
		$.ajax({
			type: 'POST',
			async: false,
			url: "/user/login",
			data: {fields: thisArray},
			dataType: 'json',
			success: function(data){
				if(!data['error']){
					result = true;
				}else{
					result = data['message'];
				}
			}
		}); 
	}else{
		result = 'Please provide your name and password';
	}
	switch(idForm){
		case 'sidebarLogin':
			if (result === true) {
				document.location.reload(true);
			}else{
				alert(result);
			}
		break;
		case 'loginForm':
			if (result === true) {
				document.location = '/user';
			}else{
				alert(result);
			}
		break;
		case 'orderLoginForm':
			if (result === true) {
				document.location.reload(true);
			}else{
				alert(result);
			}
	}
}
function validateLoginForm(idForm, data) {
	var user_name = data.user_name;
	var user_password = data.user_password;
	var regUserName = /^[a-zA-Z0-9_]+$/;
	var nameErr = [];
	var passErr = [];
	if (idForm !== 'loginForm') {
		if ((user_name == "" || user_name == null)
			&& !regUserName.exec(user_name)
			&& (user_password == "" || user_password == null)){
			return false;
		}
		return true;
	}else{
		if (user_name == "" || user_name == null) {
			nameErr.push(jsMessages['enter_your_name']);
		}
		if (!regUserName.exec(user_name)) {
			nameErr.push(jsMessages['r_name_letters_num']);
		}
		if (user_password == "" || user_password == null) {
			passErr.push(jsMessages['enter_your_password']);
		}
		if (nameErr.length > 0 || passErr.length > 0) {
			if (nameErr.length > 0) {
				var d = document.getElementById('errUserName');
				d.innerHTML =  nameErr;
				d.setAttribute('class', 'errmessage');
			}else{
				hideErrMessage('errUserName');
			}
			if (passErr.length > 0) {
				var d = document.getElementById('errUserPassword');
				d.innerHTML = passErr;
				d.setAttribute('class', 'errmessage');
			}else{
				hideErrMessage('errUserPassword');
			}
			return false;
		}else{
			return true;
		}
	}
}
/**
 * Регистрация нового пользователя
 * 
 */
function registerNewUser(idForm){
	var result;
	var res = validateRegisterForm(getData('#'+ idForm), idForm);
	if (res) {
		var thisArray = $('#'+idForm).serializeArray();
		$.ajax({
			type: 'POST',
			async: false,
			url: "/user/register",
			data: {fields: thisArray},
			dataType: 'json',
			success: function(data){
				if(!data.error){
					result = true;
				} else {
					result = data.message;
				}
			}
		});
	}else{
		result = 'invalid inputs';
	}
	switch(idForm){
		case 'registerForm':
			if (result === true) {
				alert("Your account has been created successfully. You can now log in.");
				document.location = '/user';
			}
		break;
		case 'orderLoginForm':
			if (result === true) {
				document.location.reload(true);
			}else{
				alert(result);
			}
	}
}

function validateRegisterForm(data, idForm) {
	var user_name         = data.user_name;
	var user_email        = data.user_email;
	var user_password     = data.user_password;
	var user_password_rep = data.user_password_repeat;
	
	var nameErr = [];
	var emailErr = [];
	var passErr = [];
	var passRepErr = [];
	var regUserName = /^[a-zA-Z0-9_]+$/;
	var regUserEmail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

	if (idForm !== 'registerForm') {
		var allErr = [];
		if ((user_name == "" || user_name == null)
			&& !regUserName.exec(user_name)
			&& (user_password == "" || user_password == null)){
			return false;
		}
		return true;
	}else{
		if (user_name == "" || user_name == null) {
			nameErr.push(jsMessages['r_enter_your_name']);
		}
		if (user_name.length < 4 || user_name.length > 64) {
			nameErr.push(jsMessages['r_name_length']);
		}
		if (!regUserName.exec(user_name)) {
			nameErr.push(jsMessages['r_name_letters_num']);
		}
		if (user_email == "" || user_email == null || user_email.length > 64) {
			emailErr.push(jsMessages['r_enter_your_email']);
		}
		if (!regUserEmail.exec(user_email)) {
			emailErr.push(jsMessages['r_valid_email']);
		}
		if (user_password == "" || user_password == null) {
			passErr.push(jsMessages['enter_your_password']);
		}
		if (!regUserName.exec(user_password)) {
			passErr.push(jsMessages['r_name_letters_num']);
		}
		if (user_password.length < 6 || user_password.length > 64){
			passErr.push(jsMessages['r_password_length']);
		}
		if (user_password_rep == "" || user_password_rep == null) {
			passRepErr.push(jsMessages['r_confirm_password']);
		}
		if (user_password !== user_password_rep) {
			passRepErr.push(jsMessages['r_enter_same_pass']);
		}
		if (nameErr.length > 0 || emailErr.length > 0 || passErr.length > 0 || passRepErr.length > 0) {
			if (nameErr.length > 0) {
				reportErrors('errUserName', nameErr, 'errmessage');
			}else{
				hideErrMessage('errUserName');
			}
			if (emailErr.length > 0) {
				reportErrors('errUserEmail', emailErr, 'errmessage');
			}else{
				hideErrMessage('errUserEmail');
			}
			if (passErr.length > 0) {
				reportErrors('errUserPassword', passErr, 'errmessage');
			}else{
				hideErrMessage('errUserPassword');
			}
			if (passRepErr.length > 0) {
				reportErrors('errUserPasswordNew', passRepErr, 'errmessage');
			}else{
				hideErrMessage('errUserPasswordNew');
			}
			return false;
		}
		return true;
	}
}
 /**
 * Получение данных с формы
 * 
 */
function getData(obj_form){
		  var hData = {};
		  $('input, textarea, select',  obj_form).each(function(){
			   if(this.name && this.name!=''){
					hData[this.name] = this.value;
					console.log('hData[' + this.name + '] = ' + hData[this.name]);
			   }
		  });
		  return hData;
};
/**
 *  Функция добавления товара в корзину
 *  
 *  @param integer itemId ID продукта
 *  @return в случае успеха обновятся данные корзины на странице
 */
function addToBasket(product_id){
	$.ajax({
		type: 'POST',
		async: false,
		url: "/basket/addtobasket/" + product_id + '/',
		dataType: 'json',
		success: function(data){
			if(data['success']){
				$('#basketcountProducts').html(data['countProducts']);
				
				$('#addBasket_'+ product_id).attr('class', 'hide');
				$('#removeBasket_'+ product_id).attr('class', 'show');
			}
		}
	});   
}
/**
 * Удаление продукта из корзины
 * 
 * @param integer itemId ID продукта
 * @return в случае успеха обновятся данные корзины на странице
 */
function removeFromBasket(product_id){
	$.ajax({
		type: 'POST',
		async: false,
		url: '/basket/removeFromBasket/'+ product_id + '/',
		dataType: 'json',
		success: function(data){
			if (data['success']) {
				$('#basketcountProducts').html(data['countProducts']);

				$('#removeBasket_' + product_id).attr('class', 'hide');
				$("#addBasket_"+ product_id).attr('class', 'show');
			}
		}
	});
}
/**
 * Подсчет стоимости купленного товара
 * 
 * @param integer itemId ID продукта
 * 
 */
function conversionPrice(item_id){
	var newCount = $('#itemCount_' + item_id).val();
	var itemPrice = $('#itemPrice_' + item_id).attr('value');
	var itemRealPrice = newCount * itemPrice;

	$('#itemRealPrice_' + item_id).html(itemRealPrice);
}

	/**
	* Обновление данных пользователя
	* 
	*/
	function updateUserData(){
		var postData = getData('#'+ idForm);
		var user_phone  = $('#user_phone').val();
		var user_adress = $('#user_adress').val();
		var new_pass1   = $('#new_pass1').val();
		var new_pass2   = $('#new_pass2').val();
		var current_password = $('#current_password').val();
		var user_name   = $('#user_name').val();
			
		$.ajax({
			type: 'POST',

			async: false,
			url: "/user/updateuser",
			data: postData,
			dataType: 'json',
			success: function(data){
				if(data['success']){
					$('#userLink').html(data['user_name']);
					alert(data['message']);
				} else {
					alert(data['message']);
				}
			}
		});
	}

/**
 * Сохранение заказа
 * 
 */
function saveOrder(){
	var postData = getData('#formOrder');
	if (!isEmpty(postData.user_name) && !isEmpty(postData.user_phone) && !isEmpty(postData.user_adress)) {
		$.ajax({
			type: 'POST',
			async: false,
			url: "/basket/saveorder/",
			data: postData,
			dataType: 'json',
			success: function(data){
				if(data['success']){
					alert(data['message']);
					document.location = '/';
				} else {
					alert(data['message']);
				}
			}
		});
	}else{
		alert("Заполните все небходимые поля!");
	}
}
/**
 * Показывать или прятать данные о заказе
 * 
 */
function showProducts(id){
	var objName = "#purchasesForOrderId_" + id;
	if( $(objName).attr('class') != 'show' ) {
		$(objName).attr('class', 'show');
	} else {
		$(objName).attr('class', 'hide');
	}
}



/////////////////adjacency////////////////
	/**
	* Обновление данных пользователя
	* 
	*/
function updateUserDataa(){
	var user_name         = document.getElementById("update_input_username").value;
	var user_password     = document.getElementById("update_input_password_new").value;
	var user_password_rep = document.getElementById("update_input_password_repeat").value;
	var oldpassword       = document.getElementById("update_input_oldpassword").value;
	
	var nameErr = [];
	var passErr = [];
	var passRepErr = [];
	var oldPassErr = [];	

	var postData = {new_pass1: user_password, 
					new_pass2: user_password_rep, 
					current_password: oldpassword,
					user_name: user_name};
		
	$.ajax({
		type: 'POST',
		async: false,
		url: "/user/updateuser",
		data: postData,
		dataType: 'json',
		success: function(data){
			if(data['success']){
				alert(data['message']);
				document.location.reload(true);
			} else {
				var err = 'Current password is wrong.'
				reportErrors('errUpdateInput', err, 'updateerrmessage');
			}
		}
	});
}

function changeLang() {
	var list = document.getElementById("SelectLang");
	var selLang = list.options[list.selectedIndex].value;
	var postData = {language : selLang};
	$.ajax({
		type: 'POST',
		async: false,
		url: "/user/changeLang",
		data: postData,
		dataType: 'json',
		success: function(data){
			if(data['success']){
				document.location.reload(true)
			}else{
				alert(data['message']);
			}
		}
	});
}

function hideErrMessage(idErr){
	document.getElementById(idErr).setAttribute('class', 'hide');
}

function validateUpdateForm() {
	var user_name         = document.getElementById("update_input_username").value;
	var user_password     = document.getElementById("update_input_password_new").value;
	var user_password_rep = document.getElementById("update_input_password_repeat").value;
	var oldpassword       = document.getElementById("update_input_oldpassword").value;
	
	var err = [];
	var allerr = [];
	var regUserName = /^[a-zA-Z0-9_]+$/;

	if (user_name == "" || user_name == null) {
		err.push('name: '+jsMessages['r_enter_your_name']);
	}
	if (user_name.length < 4 || user_name.length > 64) {
		err.push('name:'+jsMessages['r_name_length']);
	}
	if (!regUserName.exec(user_name)) {
		err.push('name:'+jsMessages['r_name_letters_num']);
	}
	if (oldpassword == '' || oldpassword == null) {
		err.push('password:'+jsMessages['u_enter_oldpassword']);
	}
	if (user_password.length != 0) {
		if (user_password.length < 6 || user_password.length > 64){
			err.push('password:'+jsMessages['r_password_length']);
		}
		if (user_password_rep == '' || user_password_rep == null) {
			err.push('confirm password:'+jsMessages['r_confirm_password']);
		} else if (user_password !== user_password_rep ){
			err.push('repeat password:'+jsMessages['u_enter_same_pass']);
		}
	}
	if (err.length > 0) {
		allerr[0] = err.join('<br />');
		reportErrors('errUpdateInput', allerr, 'updateerrmessage');
		return false;
	}
	return true;
}

function reportErrors(idErr, err, classN){
	document.getElementById(idErr).innerHTML =  err[0];
	document.getElementById(idErr).setAttribute('class', classN);
}

function showUploadImage(){
	var showHiddenUploader = document.getElementById("showHiddenUploader");
	if( $(showHiddenUploader).attr('class') != 'show' ) {
		$(showHiddenUploader).attr('class', 'show');
	} else {
		$(showHiddenUploader).attr('class', 'hide');
	}
}
/**
 * Показывать или прятать данные о заказе
 * 
 */
function showFormAnswer(id){
	var objName = "#show_an_for_" + id;
	if( $(objName).attr('class') != 'show' ) {
		$(objName).attr('class', 'show');
	} else {
		$(objName).attr('class', 'hide');
	}
}
function sendReply(id){
	var answer = $('#answer_for_'+ id).val();
	var post_name = $('#post_name').val();
	var postData = {answer: answer, post_id: id, post_name: post_name};

	$.ajax({
		type: 'POST',
		async: false,
		url: "/post/addcomment/",
		data: postData,
		dataType: 'json',
		success: function(data){
			if (data['success']) {
				document.location.reload(true);
			}else{
				alert(data['message']);	
			}
		}
	});
};
function isEmpty(data){
	if (data == "" || data == null) {
		return true;
	}
	return false
}
