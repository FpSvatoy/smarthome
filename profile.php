<?php 
    include("includes/header.php");
    if(!isset($_SESSION['now_user_login']))
        session_start();
    $_SESSION["support_msg"] = '';
    if(isset($_POST["btn_update_profile"])){
        if(!(empty($_POST["login"]))&&!(empty($_POST["surname"]))&&!(empty($_POST["name"]))&&
        !(empty($_POST["patronymic"]))&&!(empty($_POST["mail"]))&&!(empty($_POST["phone"]))){
            $user_id = $_SESSION["now_user_id"];
           
            $login = $_POST["login"];	
            $surname = $_POST["surname"];	
            $name = $_POST["name"];	
            $patronymic = $_POST["patronymic"];	
            $mail = $_POST["mail"];	
            $phone = $_POST["phone"];	

            $query = "UPDATE user SET `login` = '{$login}', `surname` = '{$surname}', `name` = '{$name}' , `patronymic` = '{$patronymic}', `mail` = '{$mail}', `phone` = '{$phone}'";
            $query .= "WHERE id_user = '{$user_id}' ";
            $update_category_query = mysqli_query($connection, $query);
            if(!$update_category_query) {
                die("query failed ". mysqli_error($connection));
            }
        }
    }
    
    ?>
    <div class="wrapperOneBlock">
        <?php include("includes/left_side_menu.php"); ?>
		<div class="content">
            <form action="" method="post" class="single-form">
                <?php   
                    if(isset($_SESSION["now_user_id"])){
						$user_id = $_SESSION["now_user_id"];
						$user = "SELECT * FROM user WHERE `id_user` = '{$user_id}'";
						$select_user = mysqli_query($connection, $user);
						$row_user = mysqli_fetch_assoc($select_user);
						
                        $login = $row_user["login"];	
                        $surname = $row_user["surname"];
                        $name = $row_user["name"];
                        $patronymic = $row_user["patronymic"];
                        $mail = $row_user["mail"];
                        $phone = $row_user["phone"];
                    }else{
                        $login = '';
                        $surname = '';
                        $name = '';
                        $patronymic = '';
                        $mail = '';
                        $phone = '';
                    }
				?>
                <p> 
                    <!---<label for="login">Логин</label>--->
                    <input name="login" id="login" placeholder="Логин" type="text" value="<?php echo ($login);?>" readonly>
                </p>
                <p>
                    <input name="surname" id="surname" placeholder="Фамилия" type="text" value="<?php echo ($surname);?>" >
                </p>
                <p>
                    <input name="name" id="name" placeholder="Имя" type="text" value="<?php echo ($name);?>" >
                </p>
                <p>
                    <input name="patronymic" id="patronymic" placeholder="Отчество" type="text" value="<?php echo ($patronymic);?>" >
                </p>
                <p>
                    <input name="mail" id="mail" placeholder="E-mail" type="text" value="<?php echo ($mail);?>" >
                </p>
                <p>
                    <input name="phone" id="phone" placeholder="Телефон" type="text" value="<?php echo ($phone);?>">
                </p>
                <button name = "btn_update_profile" id="submit" type="submit" class="smarthome-button">Update</button>
                <p  class ="support_msg"> <?php echo ($_SESSION['support_msg']);?></p>
            </form>
        </div>
        <nav class="sidebar commandbar">
            <li><a href="index.php?exit=1"> Выйти из профиля </a>
        </nav>
    </div>
<?php 
    include("includes/footer.php");
?>