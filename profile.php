<?php
include "config/base_url.php";
include "config/db_url.php";
include "config/time.php";
$nickname = $_GET['nickname'];

$prep = mysqli_prepare($con, "SELECT b.*, u.nickname, c.name FROM blogs b
LEFT OUTER JOIN users u ON b.author_id=u.id
LEFT OUTER JOIN categories c ON b.category_id=c.id
WHERE u.nickname = ?");
mysqli_stmt_bind_param($prep, "s", $nickname);
mysqli_stmt_execute($prep);
$blogs = mysqli_stmt_get_result($prep);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Профиль</title>
    <?php include "views/head.php";?>
</head>
<body>

<?php include "views/header.php";?>
	

<section class="container page">
	<div class="page-content">
		<div class="page-header">
			<?php
			if($_SESSION['nickname'] == $_GET['nickname']){
			?>
			<h2>Мои блоги</h2>
			
			<a class="button" href="newblog.php">Новый блог</a>
			<?php
		}else{
			?>
			<h2>Блоги<?=$_GET['nickname']?></h2>
			<?php
		}
		?>
		</div>

		<div class="blogs">
        <?php
		if(mysqli_num_rows($blogs) > 0){
			while($blogs = mysqli_fetch_assoc($blogs)){
		
		?>
			<div class="blog-item">
				<img class="blog-item--img" src="<?=$BASE_URL?>/<?=$blog['img']?>" alt="">
				<div class="blog-header">
					<h3><?=$blogs['title']?></h3>
					<?php
					if($_SESSION['nickname'] == $_GET['nickname']){
						?>
					
					<span class="link">
						<img src="images/dots.svg" alt="">
						Еще

						<ul class="dropdown">
							<li> <a href="<?=$BASE_URL?>/editblog.php?id=<?=$blog['id']?>">Редактировать</a> </li>
							<li><a href="<?=$BASE_URL?>/api/blog/delete.php?id=<?=$blog['id']?>" class="danger">Удалить</a></li>
						</ul><?php
					}
					?>
</span>

				</div>
				<p class="blog-desc">
				<?=$blog['description']?>
				</p>

				<div class="blog-info">
					<span class="link">
						<img src="images/date.svg" alt="">
						<?=time_elapsed_string(strtotime($blog['date']))?>
						
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
						<?=$blog['name']?>
					</span>
					<a class="link">
						<img src="images/person.svg" alt="">
						<?=$blog['nickname']?>
					</a>
				</div>
			</div>
			<?php
			}
		}else{
	
?>
			<h1>0 blogs</h1>
<?php
		}
?>
		</div>
	</div>
	<div class="page-info">
		<div class="user-profile">
			<img class="user-profile--ava" src="images/avatar.png" alt="">

			<h1>Елнур Сеитжанов</h1>
			<h2>В основном пишу про веб - разработку, на React & Redux</h2>
			<p>285 постов за все время</p>
			<a href="" class="button">Редактировать</a>
			<a href="" class="button button-danger"> Выход</a>
		</div>
	</div>
</section>	
</body>
</html>