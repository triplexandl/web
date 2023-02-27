<?php
include "config/base_url.php";
include "config/db_url.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Добавление нового блога</title>
    <?php include "views/head.php";?>
</head>
<body>
<?php include "views/header.php";?>

	<section class="container page">
		<div class="page-block">

			<div class="page-header">
				<h2>Новый блог</h2>
			</div>
			
			<form class="form" action="" method="POST" enctype="multipart/form-data">
				
			<fieldset class="fieldset">
				<input class="input" type="text" name="title" placeholder="Заголовок">
			</fieldset>

			<fieldset class="fieldset">
				<select name="category_id" id="" class="input">
					
					<option value="1">Прогнозы в IT</option>
				</select>
			</fieldset class="fieldset">
			
			<fieldset class="fieldset">
				<button class="button button-yellow input-file">
					<input type="file" name="image">	
					Выберите картинку
				</button>
			</fieldset>
				
			<fieldset class="fieldset">
				<textarea class="input input-textarea" name="description" id="" cols="30" rows="10" placeholder="Описание"></textarea>
			</fieldset>
			<fieldset class="fieldset">
				<button class="button" type="submit">Сохранить</button>
			</fieldset>
			</form>

			

				<!-- <p class="text-danger"> Заголовок и Описание не могут быть пустыми!</p> -->


		</div>

	</section>
	
</body>
</html>