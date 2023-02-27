<!-- <?php
include "config/base_url.php";
include "config/db_url.php";?> -->
<header class="header container">
	<div class="header-logo">
	    <a href="index.php">Decode Blog</a>	
	</div>
	
	<<form method = "GET" class="header-search">
		<input name = "q" type="text" class="input-search" placeholder="Поиск по блогам">
		<button type = "submit" class="button button-search">
			<img src="images/search.svg" alt="">	
			Найти
		</button>

	</div>
</form>
	<div>
		
        <!-- <a href="profile.php">
            <img class="avatar" src="images/avatar.png" alt="Avatar">
        </a> -->

        <!-- <div class="button-group">
            <a href="register.php" class="button">Регистрация</a>
            <a href="login.php" class="button">Вход</a>
        </div> -->

		<?php
		if(isset($_SESSION['nickname'])) {
		?>
		<a href="<?=$BASE_URL?>/profile.php?nickname=<?=$_SESSION['nickname']?>">
			<img class="avatar" src="images/avatar.png" alt="Avatar"></a>
		<?php
		}else{
		?>
		<div class="button-group">
			<a href="register.php" class="button">Регистрация</a>
			<a href="login.php" class="button">Вход</a> 
		</div>
		<?php
		}
		?>
	</div>
</header>
