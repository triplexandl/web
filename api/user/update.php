<?php
include "../../config/db_url.php";
include "../../config/base_url.php";

if(isset($_GET['id'], $_POST["nickname"],
$_POST["full_name"], $_POST['email']) &&
intval($_GET['id']) &&
strlen($_POST['nickname']) > 0 &&
strlen($_POST['full_name'])> 0 &&
strlen($_POST['email'])> 0){
   $id = $_GET['id'];
   $nickname = $_POST['nickname'];
   $full_name = $_POST['full_name'];
   $email = $_POST['email'];

if(isset($_POST['about']) && strlen ($_POST['about']) > 0){
   $prep = mysqli_prepare($con,
   "UPDATE users SET nickname=?, full_name=?, email=?, about=? WHERE id=?");
   mysqli_stmt_bind_param($prep, "ssssi", $nickname, $full_name,
   $email, $id);
   mysqli_stmt_execute($prep);
}else{
    $prep = mysqli_prepare($con,
    "UPDATE users SET nickname=?, full_name=?, email=? WHERE id=?");
    mysqli_stmt_bind_param($prep, "sssi", $nickname, $full_name,
    $email, $id);
    mysqli_stmt_execute($prep);
}
   session_start();
   $_SESSION['nickname'] = $nickname;
   $nick = $_SESSION["nickname"];
   header("Location:$BASE_URL/profile.php?nickname=$nick");
}else{
    header("Location:$BASE_URL/editProfile.php?error=1");
}
?>