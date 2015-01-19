<h1>Photo Gallery &gt; Images &gt; Category: <?php echo $id ?></h1>
<?php echo isset($confirm_message) ? $confirm_message : NULL; ?>
<form action="" name="frm_insert" method="post" enctype="multipart/form-data">
	<table cellpadding="0" cellspacing="0" border="0" class="tbl_insert">
		<tr>
			<th><label for="caption">Caption: *</label></th>
			<td><?php
				echo isset($valid_caption) ? $valid_caption : NULL;
			 ?><input type="text" name="caption" id="caption" class="fld" value="<?php echo isset($caption) ? $caption : NULL ?>"></td>
		</tr>
		<tr>
			<th><label for="image">Image: *</label></th>
			<td><?php
				echo isset($valid_image) ? $valid_image : NULL;
				echo isset($valid_image_error) ? $valid_image_error : NULL;
				echo isset($valid_image_size) ? $valid_image_size : NULL;
				echo isset($valid_image_type) ? $valid_image_type : NULL;
			 ?><input type="file" name="image" id="image" size="40"></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><label for="btn" class="sbm"><input type="submit" id="btn" class="btn" value="Upload"></label></td>
		</tr>
	</table>
</form>
<?php if (count($images) > 0): ?>
<div class="dev br_ts">&nbsp;</div>
<?php echo isset($confirmation) ? $confirmation : NULL ?>
<form action="" name="update" method="post">
	<ul id="ul_gal">
		<?php foreach ($images as $key => $value): ?>
		<?php if (is_file(UPLOAD_PATH_THUMB.$value['image'])): ?>
			<li>
				<a class="zoom" rel="group" href="<?php echo URL.'uploads'.DS.$value['image'] ?>" title="<?php echo $value['caption'] ?>">
					<img src="<?php echo URL.'uploads/'.$value['image'] ?>" alt="<?php  echo $value['caption'] ?>" <?php echo getSize(4, UPLOAD_PATH_THUMB.$value['image']); ?> />
				</a>
				<label for="remove#<?php echo $value['id'] ?>">
					<input type="checkbox" name="remove#<?php echo $value['id'] ?>" id="remove#<?php echo $value['id'] ?>" value="<?php echo $value['id'] ?>">
					<span>R</span>
				</label>
				<label for="display_order#<?php echo $value['id'] ?>">
					<input type="text" name="display_order#<?php echo $value['id'] ?>" id="display_order#<?php echo $value['id'] ?>" value="<?php echo $value['display_order'] ?>" class="fld_ord">
				</label>
			</li>
		<?php endif ?>
		<?php endforeach ?>
	</ul>
	<input type="hidden" name="update" value="go">
	<div class="dev">&nbsp;</div>
	<div class="dev br_ts">&nbsp;</div>
	<label for="btn2" class="sbm" ><input type="submit" id="btn2" class="btn" value="Update"></label>
	<div class="cl">&nbsp;</div>
</form>
<?php else: ?>
	<p>There are currently no images associated with this category.</p>
<?php endif ?>