<?php 
    include("includes/header.php");
    if(!isset($_SESSION['now_user_login']))
        session_start();
    $_SESSION["support_msg"] = '';
    if(isset($_POST["add_user"])){
        if(!(empty($_POST["login"]))&&!(empty($_POST["password"]))&&!(empty($_POST["surname"]))&&
        !(empty($_POST["name"]))&&!(empty($_POST["mail"]))&&!(empty($_POST["phone"]))){
            $login = $_POST["login"];
            $query = "SELECT login FROM user WHERE `login` = '{$login}'";
            $result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)> 0){
                $_SESSION["support_msg"] = "Пользователь с таким логином уже зарегистрирован. Выберите другой логин.";
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
                $insert_query .= "VALUE('{$login}', '$hash_pass', '{$surname}', '{$name}', '{$patronymic}', '{$mail}', {$phone})";
                $insert_res = mysqli_query($connection, $insert_query);
                if(!$insert_res){
                    $_SESSION['support_msg'] = 'ОШИБКА ПРИ ЗАПИСИ';
                }else{  
                    header('Location: ../all_users.php');
                }
            }
        }else{
            $_SESSION["support_msg"] = "Заполните все поля для ввода!";
        }
    }
    ?>
    <div class="wrapperOneBlock">
        <?php include("includes/left_side_menu.php"); ?>
		<div class="content">
            <form action="" method="post" class="single-form">
                <p> 
                    <!---<label for="login">Логин</label>--->
                    <input name="login" id="login" placeholder="Логин" type="text">
                </p>
                <p>
                    <input name="surname" id="surname" placeholder="Фамилия" type="text">
                </p>
                <p>
                    <input name="name" id="name" placeholder="Имя" type="text">
                </p>
                <p>
                    <input name="patronymic" i  d="patronymic" placeholder="Отчество" type="text">
                </p>
                <p>
                    <input name="mail" id="mail" placeholder="E-mail" type="text">
                </p>
                <p>
                    <input name="phone" id="phone" placeholder="Телефон" type="text">
                </p>
                <p>
                    <input name="password" id="password" placeholder="Пароль" type="password">
                </p>
                <button name = "add_user" id="submit" type="submit" class="smarthome-button">Add User</button>
                <p  class ="support_msg"> <?php echo ($_SESSION['support_msg']);?></p>
            </form>
        </div>
    </div>
<?php 
    include("includes/footer.php");
?>