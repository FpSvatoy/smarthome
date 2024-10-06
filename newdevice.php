<?php 
    include("includes/header.php");

    $_SESSION["support_device_msg"] = '';
    if(isset($_POST["add_device"])){
        if(!(empty($_POST["device_name"]))&&!(empty($_FILES['post_image']['name']))){
            $alias = $_POST["device_name"];
            $query = "SELECT alias FROM device WHERE `alias` = '{$alias}'";
            $result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)> 0){
                $_SESSION["support_device_msg"] = "Данный девайс уже зарегестрирован, напишите новые данные.";
            }else{
                $post_image = $_FILES['post_image']['name'];
                $temp_image_location = $_FILES['post_image']['tmp_name'];
                $access_id = isset($_POST['admin_only']) ? 0 : 1;
                move_uploaded_file($temp_image_location, "res/$post_image"); 
                
                $query = "INSERT INTO device(`alias`, `path_image`,`id_access`)";
                $query .= " VALUES('$alias','$post_image','$access_id')";
                $create_post_query = mysqli_query($connection, $query);
                if(!$create_post_query){
                    $_SESSION['support_device_msg'] = 'ОШИБКА ПРИ ЗАПИСИ';
                }else{  
                    $_SESSION["support_device_msg"] = "Устройство добавлено!";
                    header('Location: /smarthome/all_device.php');
                }
            }
        }else{
            $_SESSION["support_device_msg"] = "Заполните все поля для ввода!";
        }
    }
    ?>
    <div class="wrapperOneBlock">
    <?php include("includes/left_side_menu.php"); ?>
		<div class="content">
            <form action="" method="post" class="single-form" enctype="multipart/form-data">
                <p> 
                    <input name="device_name" placeholder="Название" type="text">
                </p>
                <p class="form-fields-inline">
                    <label for="admin_only">Показывать только администратору:</label>
                    <input name="admin_only" type="checkbox">
                </p>
                <p class="form-fields-inline">
                    <label for="post_image">Иконка устройства:</label>
                    <input type="file" name="post_image" accept="image/png, image/jpeg" />
                </p>
                <button name = "add_device" id="submit" type="submit">Add Device</button>
            <p  class ="support_msg"> <?php echo ($_SESSION['support_device_msg']);?></p>
            </form>
        </div>
    </div>
<?php 
    include("includes/footer.php");
?>