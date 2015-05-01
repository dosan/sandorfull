<h1>Photo Gallery &gt; Categories</h1>
<form name="add_category" action="" method="post">
	<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
		<tr>
			<th><label for="name">Category name: *</label></th>
			<?php echo isset($confirmation) ? $confirmation : NULL ?>
			<td><?php
			echo isset($valid_name) ? $valid_name : NULL;
			echo isset($valid_duplicate) ? $valid_duplicate : NULL;
			 ?><input type="text" name="name" id="name" class="fld" value=""></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><label for="btn" class="sbm"><input type="submit" id="btn" class="btn" value="Add"></label></td>
		</tr>
	</table>
</form>
<?php if (count($categories) > 0): ?>
	<table cellpadding="0" cellspacing="0" border="0" class="tbl_repeat">
		<tr>
			<th>Category name</th>
			<th class="ta_r">Images</th>
			<th class="ta_r">Remove</th>
			<th class="ta_r">Edit</th>
		</tr>
		<?php foreach ($categories as $key => $value): ?>
		<tr>
			<td><?php echo $value['name']; ?></td>
			<td class="ta_r"><a href="<?php echo URL ?>gallery/<?php echo $value['id'] ?>">(<?php echo $value['total'] ?>) Images</a> </td>
			<td class="ta_r"><a href="<?php echo URL ?>gallery/remove/<?php  echo $value['id']?>">Remove</a> </td>
			<td class="ta_r"><a href="<?php echo URL ?>gallery/edit/<?php  echo $value['id']?>">Edit</a></td>
		</tr>
		<?php endforeach ?>
	</table>
<?php endif ?>