<?php 
    include("includes/header.php");

    if( intval($_SESSION['now_user_id_access']) > 0 ) {?>
		<div class="error-message">
            Эту страницу могут просматривать только администраторы, вернитесь
            <a href="<?php echo "/smarthome/all_device.php"; ?>">к списку устройств</a>
        </div>
		<?php die();		
    }

    if(isset($_POST["updateAccess"])){
        if(!(empty($_POST["updateAccess"]))){
            $id_user = $_POST["updateAccess"];
            $access = $_POST["access"];	
            $query = "UPDATE user SET `id_access` = '{$access}' WHERE id_user = '{$id_user}' ";
            $update_access_query = mysqli_query($connection, $query);
            if(!$update_access_query) {
                die("query failed ". mysqli_error($connection));
            }
        }
    }
    ?>
    <div class="wrapperOneBlock">
    <?php include("includes/left_side_menu.php"); ?>
		<div class="content">
            <table class="tableCapability">
				<thead>
					<tr class = "headTable">
				    	<th>Логин</th>
						<th>E-mail</th>
					    <th>Уровень доступа</th>
					</tr>
				</thead>
				<tbody class = "bodyTable">
					<?php 
						$query = "SELECT * FROM user";
                        $select_user = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_array($select_user)) {
                            $login = $row["login"];
                            $email = $row["mail"];
                            $access = $row["id_access"];
                            $id_user = $row["id_user"];
                            echo "<tr>";
                                echo "<td>{$login}</td>";
                                echo "<td>{$email}</td>";
                                ?>
                            <td>
                            <form action="" method = "post">
                            <select id="access" name = "access">
                            <?php
                            switch($access){
                                case 0:
                                    echo "<option value='0'>Admin</option>";
                                    echo "<option value='1'>Tester</option>";
                                    echo "<option value='2'>Requester</option>";
                                    break;
                                case 1:
                                    echo "<option value='1'>Tester</option>";
                                    echo "<option value='0'>Admin</option>";
                                    echo "<option value='2'>Requester</option>";
                                    break;
                                case 2:
                                    echo "<option value='2'>Requester</option>";
                                    echo "<option value='1'>Tester</option>";
                                    echo "<option value='0'>Admin</option>";
                                    break;
                            }
                            ?>  
                            </select>
                            <button name = "updateAccess" value = '<?php echo $id_user;?>' id = "updateAccess" type = "submit">ОК</button>
                            </form>
                            </td>
                        <?php }
					?>
				</tbody>
			</table>
        </div>         
        <nav class="sidebar commandbar">
            <li><a href="newuser.php"> Добавить пользователя </a>
        </nav>
    </div>
<?php 
    include("includes/footer.php");
?>