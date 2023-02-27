<?php
include "config/base_url.php";
include "config/db_url.php";
include "config/time.php";


$sql = "SELECT b.*, u.nickname, c.name FROM blogs b
LEFT OUTER JOIN users u ON b.author_id=u.id
LEFT OUTER JOIN categories c ON b.category_id=c.id";
$q = '';

if(isset($set['cat_id'])){
	$category = $_GET['cat_id'];
	$sql .= " WHERE b.category_id=$category";
}
if(isset($_GET['q'])){
	$q = strtolower($_GET['q']);
	$sql .= " WHERE LOWER (b.title) LIKE ?, OR
	LOWER (b.description) LIKE ?, OR 
	LOWER (u.nickname) LIKE ?, OR 
	LOWER (c.name) LIKE ?  
	";
}

if($q){
	$param = "%$q%";
	$prep = mysqli_prepare($con, $sql)
	mysqli_stmt_bind_param($prep, "ssss", $param, $param, $param, $param);
	mysqli_stmt_execute($prep)
	$blogs = mysqli_stmt_get_result($param);
}else{
	$blogs = mysqli_query($con, $sql);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Главная</title>
    <?php include "views/head.php";?>
</head>
<body>
<?php include "views/header.php";?>



<section class="container page">
	<div class="page-content">
			<h2 class="page-title">Блоги по программированию</h2>
			<p class="page-desc">Популярные и лучшие публикации по программированию для начинающих
 и профессиональных программистов и IT-специалистов.</p>

		<div class="blogs">
			<?php
			if(mysqli_num_rows($blogs) > 0){
				while($row = mysqli_fetch_assoc($blogs)){
			?>
			<div class="blog-item">
				<img class="blog-item--img" src="<?=$BASE_URL?>/<?=$row['img']?>" alt="">
				<div class="blog-header">
					<a href ="<?=$BASE_URL?>/blog-details.php?id=<?=$row['id']?>"><h3> <?=$row['title']?></h3></a>
				</div>
				<p class="blog-desc"><?=$row['description']?></p>

				<div class="blog-info">
					<span class="link">
						<img src="images/date.svg" alt="">
						<?=time_elapsed_string(strtotime($row['date']))?>
					</span>
					<span class="link">
						<img src="images/visibility.svg" alt="">
						21
					</span>
					<a class="link">
						<img src="images/message.svg" alt="">
						4
					</a>
					<span class="link">
						<img src="images/forums.svg" alt="">
						<?=$row['name']?>
					</span>
					<a class="link" href="<?=$BASE_URL?>profile.php?nickname=<?=$row['nickname']?>">
						<img src="images/person.svg" alt="">
						<?=$row['nickname']?>
					</a>
				</div>
			<?php
				}
			}else{
				?>
			
			</div>
			

			<!-- <h3>0 blogs</h3> -->
<?php
			}
			?>
			
		</div>
	</div>
	<?php
	include "views/categories.php";
	?>

	
</section>	
<script src="js/comment.js"></script>
</body>
</html>