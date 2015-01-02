<div id="wrapper">
	<div id="formWrapper">
			<form method="post" enctype="multipart/form-data" id="formContact">
					<h1>Contact Form with PHP</h1>
					<div class="large-6 columns">
						<label for="type">Email class: *</label>
						<div class="type"></div>
							<select name="type" id="type" class="select required contact" title ="Please select the library">
								<option value="">Select one</option>
								<option value="1">PHPMailer</option>
								<option value="2">SwiftMailer</option>
								<option value="3">Zend Mail</option>
							</select>
					</div>
					<div class="large-6 columns">
						<label for="fullName">Full Name : *</label>
						<div class="fullName"></div>
						<input type="text" name="fullName" id="fullName" class="field required" title="Please provide your full name">
					</div>
					<div class="large-6 columns">
						<label for="telephone">Telephone: *</label>
						<div class="telephone"></div>
						<input type="text" name="telephone" id="telephone" class="field required" title="Please provide your telephone number">
					</div>
					<div class="large-6 columns">
						<label for="email">Email: *</label>
						<div class="email"></div>
						<input type="email" name="email" id="email" class="field required" title="Please provide your valid email address">
					</div>
					<div class="large-12 columns">
						<label for="enquiry">Enquiry: *</label>
						<div class="enquiry"></div>
						<textarea name="enquiry" id="enquiry" class="area required" title="Please provide your enquiry"></textarea>
					</div>
					<div id="fileList"></div>
					<div id="fileUpload"></div>
					<a href="#" class="button small submit" data-target="formContact">Send Message</a>
			</form>
	</div>
</div>