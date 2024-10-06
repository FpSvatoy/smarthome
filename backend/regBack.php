<?php
session_start();
include "../includes/database.php";
$_SESSION["support_msg"] = '';
if(isset($_POST["regsubmit"])){
    if(!(empty($_POST["login"]))&&!(empty($_POST["password"]))&&!(empty($_POST["surname"]))&&
    !(empty($_POST["name"]))&&!(empty($_POST["mail"]))&&!(empty($_POST["phone"]))){
        $login = $_POST["login"];
        $query = "SELECT login FROM user WHERE `login` = '{$login}'";
		$result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result)> 0){
            $_SESSION["support_msg"] = "Пользователь с таким логином уже зарегистрирован. Выберите другой логин.";
            header('Location: ../reg.php');
        }else{
            if(!(empty($_POST["patronymic"]))){
                $patronymic = $_POST["patronymic"];
            }else{
                $patronymic ='';
            }
            $hash_pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $surname = $_POST["surname"];
            $name = $_POST["name"];
            $mail = $_POST["mail"];
            $phone = $_POST["phone"];
            $insert_query = "INSERT INTO user ( `login`, `password`, `surname`,`name`,`patronymic`,`mail`,`phone`)";
            $insert_query .= "VALUE('{$login}', '{$hash_pass}', '{$surname}', '{$name}', '{$patronymic}', '{$mail}', '{$phone}' )";
            $insert_res = mysqli_query($connection, $insert_query);
            if(!$insert_res){
                $_SESSION['support_msg'] = 'ОШИБКА ПРИ ЗАПИСИ';
                header('Location: ../reg.php');
            }else{  
                header('Location: ../index.php');
            }
        }
    }else{
        $_SESSION["support_msg"] = "Заполните все поля для ввода!";
        header('Location: ../reg.php');
    }
}else{
    echo "Ошибка: button regsubmit не была нажата";
    header('Location: ../reg.php');
}
?>

