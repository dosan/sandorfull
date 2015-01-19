<h1>Photo Gallery &gt; Categories &gt; Edit</h1>
<form name="add_category" action="" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
		<tr>
			<th><label for="name">Category name: </label></th>
			<?php echo isset($confirmation) ? $confirmation : NULL ?>
			<td><?php
			echo isset($valid_name) ? $valid_name : NULL;
			echo isset($valid_duplicate) ? $valid_duplicate : NULL;
			 ?><input type="text" name="name" id="name" class="fld" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $category[0]['name'] ?>"></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><label for="btn" class="sbm"><input type="submit" id="btn" class="btn" value="Edit"></label></td>
		</tr>
	</table>
</form>