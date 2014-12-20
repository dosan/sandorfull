<div id="wrapper">
	<div id="formWrapper">
		<form method="post" enctype="multipart/form-data" id="formContact">
			<div class="row">
				<div class="rowLeft type">
					<label for="type">Email class: *</label>
				</div>
				<div class="rowRight fullName">
					<label for="fullName">Full Name : *</label>
				</div>
			</div>
			<div class="row">
				<div class="rowLeft">
					<select name="type" id="type" class="select required" title ="Please select the library">
						<option value="">Select one</option>
						<option value="1">PHPMailer</option>
						<option value="2">SwiftMailer</option>
						<option value="3">Zend Mail</option>
					</select>
				
				</div>
				<div class="rowRight">
					<input type="text" name="fullName" id="fullName" class="field required" title="Please provide your full name">
				</div>
			</div>

			<div class="row">
				<div class="rowLeft telephone">
					<label for="telephone">Telephone: *</label>
				</div>
				<div class="rowRight email">
					<label for="email">Email: *</label>
				</div>
			</div>
			<div class="row">
				<div class="rowLeft">
					<input type="text" name="telephone" id="telephone" class="field required" title="Please provide your telephone number">
				</div>
				<div class="rowRight">
					<input type="email" name="email" id="email" class="field required" title="Please provide your valid email address">
				</div>
			</div>

			<div class="row enquiry">
				<label for="enquiry">Enquiry: *</label>
			</div>
			<div class="row enquiry">
				<textarea name="enquiry" id="enquiry" class="area required" title="Please provide your enquiry"></textarea>
			</div>
		</form>

		<div class="row">
			<div id="fileList"></div>
			<div id="fileUpload"></div>
			<a href="#" class="button buttonGreen submit" data-target="formContact">Submit enquiry</a>
		</div>
	
	</div>
</div>