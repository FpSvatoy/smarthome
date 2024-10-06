<?php
session_start();
include "../includes/database.php";
$_SESSION["support_msg"] = '';
if(isset($_POST["submit"])){
    if(!(empty($_POST["login"]))||!(empty($_POST["password"]))){
$login = $_POST["login"];
$password = $_POST["password"];
$query = "SELECT * FROM user WHERE `login` = '{$login}'";
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result)> 0){
    $row = mysqli_fetch_assoc($result);
    $hashpass = $row["password"];
    if(password_verify($password,$hashpass)){
        $now_user_login = $row["login"];
        $now_user_id = $row["id_user"];
        $now_user_id_access = $row["id_access"];
        $_SESSION["now_user_login"] = $now_user_login;
        $_SESSION["now_user_id"] = $now_user_id;
        $_SESSION["now_user_id_access"] = $now_user_id_access;
        $_SESSION["support_msg"] = "Вход выполнен. User:".$_SESSION["now_user_login"]."; ID:".$_SESSION["now_user_id"]."; Access:".$_SESSION["now_user_id_access"];
        header('Location: ../profile.php');
    }else{
        $_SESSION["support_msg"] = "Не верно введенный пароль. Повторите попытку.";
        header('Location: ../index.php');
    }
}else{
    $_SESSION["support_msg"] = "Данного пользователя не существует";
    header('Location: ../index.php');
}
    }else{
        $_SESSION["support_msg"] = "Заполните поля для ввода";
        header('Location: ../index.php');
    }
}else{
    echo "Ошибка: button submit не была нажата";
    header('Location: ../index.php');
}
?>

