    <?php 
        include("includes/header.php");
    ?>
    <div class="wrapperOneBlock">
    <?php include("includes/left_side_menu.php"); ?>
		<div class="content">
            <div class="device-list">
                <?php 
                    $id_access = $_SESSION["now_user_id_access"];
                    $query = "SELECT * FROM device WHERE `id_access` >= '{$id_access}'";
                    $result = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_array($result)) {
                        $name = $row["ALIAS"];
                        $imgPath = $row["PATH_IMAGE"];
                        $id_device = $row["ID_DEVICE"];
                    ?>
                    <div class="single-device">
                        <div class="device-tile">
                            <div class="device-field">
                            <p class="pretty-device-title"> <?php echo "<span class='device-label'>Устройство:</span>&nbsp;<span class='device-name'>" . " " . $name . " <span style='color: darkgray;'>: ID" . $id_device . "</span></span>"?></p>
                            </div> 
                            <div class="device-field">
                                <div class="device-icon" style="background: center / contain no-repeat url('<?php echo "res/".$imgPath; ?>')"></div>
                            </div>  
                            <div class="device-field">
                                <a href='vievdevice.php?now_id_device=<?php echo $id_device?>' class="smarthome-button">Просмотреть</a>
                            </div> 
                        </div>
                            <table class="device-status">  
                                <tr>
                                    <th>Активность</th>
                                    <th>Состояние (On/Off)</th>
                                    <th>Код состояния</th>
                                </tr>
                                <?php 
                                    $query = "SELECT * FROM condition_device WHERE `id_device` = '{$id_device}' AND MONTH(date) = MONTH(CURRENT_DATE()) ORDER BY `date` DESC; ";
                                    $status_history_result = mysqli_query($connection, $query);
                                    $counter = 0;
                                    if($status_history_result) {
                                        while($status_history = mysqli_fetch_array($status_history_result)) {
                                            if($counter >= 3) break;
                                            $status = $status_history['status'];
                                            $current_status = $status_history['status'];
                                            $initiator = $status_history['initalize'];
                                            $comment = $status_history['comment'];
                                            echo "<tr>";
                                            echo "<td>$status: $initiator</td>";
                                            echo "<td>$current_status</td>";
                                            echo "<td>$comment</td>";
                                            echo "</tr>";
                                            $counter += 1;
                                        }
                                        if ($counter < 3) {
                                            for($i = $counter; $i < 3; $i +=1 ){
                                                echo "<tr>";
                                                echo "<td>Нет данных</td>";
                                                echo "<td>Нет данных</td>";
                                                echo "<td>Нет данных</td>";
                                                echo "</tr>";
                                            }
                                    }
                                }
                                ?>
                            </table>
                    </div>
                <?php }?>
            </div>
        </div>
        <nav class="sidebar commandbar">
            <li><a href="newdevice.php"> Добавить устройство </a>
        </nav>
    </div>
<?php 
    include("includes/footer.php");
?>
<?php 
      while($row = mysqli_fetch_array($result)) {
?>
    <div>
        
    </div>
<?php 
    }
 ?>