var webstoreObject = {
	init : function(){
		"use strict";
		this.submitLoginForm($('#loginForm'));
	},
	emailValidation :function(email){
		"use strict";
		var emailPattern = /^[a-zA-Z0-9._\-]+@[a-zA-Z0-9]+([.\-]?[a-zA-Z0-9]+)?([\.]{1}[a-zA-Z]{2,4}){1,4}$/;
		return emailPattern.test(email);
	},
	isValid : function(thisFields){
		"use strict";
		if (thisFields.length > 0) {
			var thisErrors = [];
			$.each(thisFields, function(thisIndex, thisElement){

				var thisValue = thisElement.value;
				var thisName  = thisElement.name;
				var thisTitle = thisElement.title;
				var thisType  = thisElement.type;

				if ($(this).hasClass('required')) {
					switch(thisType){
						case 'text':
						case 'password':
						case 'textarea':
						if (thisValue === '') {
							$('.' + thisName).append('<div class="warning">'+thisTitle+'</div>');
							thisErrors.push(thisName);
						};
						break;

						case 'email':
							if (!webstoreObject.emailValidation(thisValue)) {
								$('.' + thisName).append('<div class="warning">'+thisTitle+'</div>');
								thisErrors.push(thisName);
							};
						break;
					}
				}
			});
			if (thisErrors.length > 0) {
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	},
	validate : function(validation){
		"use strict";
		$.each(validation, function(k, v){
			if ($('.' + k).length > 0) {
				$('.' + k).append('<div class="warning">'+v+'</div>');
			}
		});
	},
	reset : function(thisForm){
		"use strict";
		thisForm[0].reset();
	},
	submitLoginForm : function(form){
		"use strict";
		form.submit(function(e){
			e.preventDefault();
			e.stopPropagation();
			var thisForm = $(this);

			thisForm.find('.warning').remove();

			var thisFields = thisForm.find(':input');

			if (thisFields.length > 0 && webstoreObject.isValid(thisFields)) {

				var thisArray = thisForm.serializeArray();
				$.ajax({
					type : 'POST',
					dataType : 'json',
					url : '/user/login',
					data : {fields : thisArray},
					success : function(data){
						if (data) {
							if (!data.error) {
								document.location.reload(true);
							}else if(data.validation){
								webstoreObject.validate(data.validation);
							}
						}
					}
				});
			}
		});
	}
}