<?php
include "config/base_url.php";
include "config/db_url.php";
include "config/time.php";
$id = $_GET['id']
$query = mysqli_query($con,
"SELECT b.*, u.nickname, c.name FROM blogs b
LEFT OUTER JOIN users u ON b.author_id=u.id
LEFT OUTER JOIN categories c ON b.category_id=c.id
WHERE b.id=$id");

$blog = mysqli_fetch_assoc($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Профиль</title>
    <?php include "views/head.php";?>
</head>

<body data-baseurl = "<?=$BASE_URL?>"
 data-blogid=<?=$blog['id']?>
 data-authorid=<?=$_SESSION['id']?>
 data-blogauthor=<?=$blog['author_id']?>
> 

<?php include "views/header.php";?>

<section class="container page">
	<div class="page-content">
		<div class="blogs">
			<div class="blog-item">
				<img class="blog-item--img" src="<?=$BASE_URL?>/<?=$blog['img']?>" alt="">

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

				<div class="blog-header">
					<h3><?=$blog['title']?></h3>
				</div>
				<p class="blog-desc">
					<?=$blog['description']?></p>
			</div>
		</div>

        <div class="comments">
            <h2>
                2 комментариея
            </h2>

            <div class="comment">
                <div class="comment-header">
                    <img src="images/avatar.png" alt="">
                    Елнур Сеитжанов
                </div>
                <p>
                В отличие от обычных виджетов пользовательского интерфейса JavaScript, комплексные виджеты - это полноценные приложения, которые не требуют дополнительной настройки и кастомизации.
                </p>
            </div>
              
            <?php
			if(isset($_SESSION['id'])){
			?>
            <span class="comment-add">
                <textarea name="" class="comment-textarea" placeholder="Введит текст комментария"></textarea>
                <button class="add_btn">Отправить</button>
            </span>

        <?php
			}else{
				?>
            <span class="comment-warning">
                Чтобы оставить комментарий <a href="<?=$BASE_URL?>/register.php">зарегистрируйтесь</a> , или  <a href="<?$BASE_URL?>/login.php">войдите</a>  в аккаунт.
            </span>
<?php

			}
			?>
        </div>
	</div>
	

    <div class="page-info">
		<div class="page-header">
            <h2>Категории</h2>
        </div>

		<a class='list-item' href=''></a>
       
	</div>

	<?php
	include "views/categories.php"
?>
</section>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>