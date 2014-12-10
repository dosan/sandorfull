	<h2>Категория</h2>
	<table border="1" cellpadding="1" cellspacing="1">
		<tr>
			<th>N</th>
			<th>id</th>
			<th>Имя категории</th>
			<th>Родительская категория</th>
			<th>Действие</th>
		</tr>
		<?php $i=1; foreach ($this->resultCategories as $item): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $item['cat_id']; ?></td>
				<td>
					<input type="edit" id="itemName_<?php echo $item['cat_id']; ?>" value="<?php echo $item['cat_name'] ?>">
				</td>
				<td>
					<select id="parentId_<?php echo $item['cat_id'] ?>">
						<option value="0">Главная категория
						<?php foreach ($this->resultMainCategories as $mainItem): ?>
							<option value="<?php echo $mainItem['cat_id'] ?>" <?php if ($item['parent_id'] == $mainItem['cat_id']) { ?>selected <?php } ?>><?php echo $mainItem['cat_name'] ?>
						<?php endforeach ?>
					</select>
				</td>
				<td>
					<input type="button" value="Сохранить" onclick="updateCat(<?php echo $item['cat_id'] ?>)">
				</td>
			</tr>
		<?php $i++; endforeach ?>
	</table>
