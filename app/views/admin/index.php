
	<div id='blockNewCategory'>
		Новая категория:

		<input  name="newCategoryName" id="newCategoryName" type="text" value="" />
		<br /> 
		Является подкатегарией для
		<select name="generalCatId">
			<option value="0">Главная Категория
				<?php foreach ($this->resultCategories as $item): ?>
					<option value="<?php echo $item['cat_id'] ?>"><?php echo $item['cat_name'] ?>
				<?php endforeach ?>
		</select>
		<br>
			<input class="btn btn-success" type="button" onclick="newCategory();" value="Дабавить категорию">

	</div>
