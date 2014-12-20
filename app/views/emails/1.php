<p>
	<strong>Full Name:</strong><?php echo $data['fullName'] ?><br>
	<strong>Telephone:</strong><?php echo $data['telephone'] ?><br>
	<strong>Email:</strong><a href="mailto:<?php echo $data['email'] ?>"><?php echo $data['email']; ?></a><br>
	<strong>Enquiry:</strong><br>
	<?php echo nl2br($data['fullName']) ?><br>
</p>