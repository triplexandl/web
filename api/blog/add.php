<?php
include "../../config/base_url.php";
include "../../config/db_url.php";

if(isset(
    $_POST['title'],
    $_POST['category_id'],
    $_POST['description'] 
    )&&
    strlen($_POST['title']) > 0 &&
    strlen($_POST['description']) > 0
    intval($_POST['category_id'])
){
        $title = $_POST['title'];
        $cat_id = $_POST['category_id'];
        $desc = $_POST['description'];
        session_start();
        $author = $_SESSION['id'];
        
     if(isset($_FILES['image'], $_FILES['image']['name'])&&
     strlen($_FILES['image'],['name'])) {//item.png
        $ext = end(explode(".", $_FILES['image'],['name'])); // png
        $image_name = time().".".$ext; // time
        move_uploaded_file($_FILES['image']['tmp_name'],
        "../../images/blogs/$image_name");
        $path = "images/blogs/".$image_name;
    }
     else{
        $prep = mysqli_prepare($con,
        "INSERT INTO blogs (title, description, category_id, author_id)
        VALUES(?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($prep, "ssii",
        $title, $desc, $cat_id, $author_id, $path);
        mysqli_stmt_execute($prep);
      

     }
        $nickname = $_SESSION['nickname'];
        header("Location:$BASE_URL/profile.php?nicknamw=$nickname");

    } else{
        header("Location: $BASE_URL/newblog.php?error=1")
    }
    
?>