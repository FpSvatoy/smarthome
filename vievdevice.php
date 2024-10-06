<?php 
    include("includes/header.php");
    include("functions.php");

    if (isset($_GET["delete_id"])) {
        $id_delete = $_GET["delete_id"];
        $query = "DELETE FROM device WHERE ID_DEVICE = '{$id_delete}'";
        $checklog = mysqli_query($connection, $query);
        header('Location: all_device.php');
    }
    if (isset($_GET["condition"])) {

        $id_device = $_GET["now_id_device"];
        $condition = $_GET["condition"] ? "activated" : "deactivated";

        if($_GET["condition"]) {
            execute_hooks('activation');
        } else {
            execute_hooks('deactivation');
        }
        
        $username = $_SESSION['now_user_login'];

        $query = "INSERT into condition_device (`id_device`, `status`, `initalize`, `date`, `comment`) ";
        $query .= "VALUES ($id_device, '$condition', '$username', CURRENT_DATE(), 'normal');";

        $update_condition_query = mysqli_query($connection, $query);
        if(!$update_condition_query) {
            echo ("query failed ". mysqli_error($connection));
        }
    }
    if (isset($_GET["now_id_device"])) {
        $id_device = $_GET["now_id_device"];
        $query = "SELECT * FROM device WHERE `id_device` = '{$id_device}'";
        $result = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result);
        $name = $row["ALIAS"];
        $imgPath = $row["PATH_IMAGE"];
    } 
    ?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawStatusChart);
      google.charts.setOnLoadCallback(drawPowerChart);


      function drawStatusChart() {
        var data = google.visualization.arrayToDataTable([
          ['Число', 'Статус'],
          <?php 
            $query = "SELECT * FROM condition_device WHERE `id_device` = '{$id_device}' AND MONTH(date) = MONTH(CURRENT_DATE())";
            $status_history_result = mysqli_query($connection, $query);
            if($status_history_result) {
                while($status_history = mysqli_fetch_array($status_history_result)) {
                    $date = new DateTime($status_history['date']);
                    $status = $status_history['status'] == 'activated' ? 1 : 0;
                   // $initiator = $status_history['initalize'];
                    $day=$date->format('j');

                    echo "[$day, $status ],";
                }
            }
          ?>
        ]);

        var options = {
          title: 'Статус',
          hAxis: {title: 'Число текущего месяца'},
          vAxis: {title: 'Статус'},
          isStacked: true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('status-chart'));

        chart.draw(data, options);
      }


      function drawPowerChart() {
        var data = google.visualization.arrayToDataTable([
          ['Число', 'Заряд(%)'],         
          <?php 
            $query = "SELECT * FROM soc_battery WHERE `id_device` = '{$id_device}' AND MONTH(date) = MONTH(CURRENT_DATE())";
            $power_history_result = mysqli_query($connection, $query);
            if($power_history_result) {
                while($power_history = mysqli_fetch_array($power_history_result)) {
                    $date = new DateTime($power_history['date']);
                    $power_level = $power_history['now_soc'];
                    $day=$date->format('j');

                    echo "[$day, $power_level ],";
                }
            }
          ?>
        ]);

        var options = {
          title: 'Уровень заряда',
          hAxis: {title: 'Число текущего месяца',  titleTextStyle: {color: '#333'}},
          vAxis: {title: 'Заряд(%)', minValue: 0, maxValue: 100}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('power-chart'));
        chart.draw(data, options);
      }

    </script>

    <div class="wrapperOneBlock">
    <?php include("includes/left_side_menu.php"); ?>
		<div class="content">
            <div class="device-info">
                <div class="device-field">
                    <h2> <?php echo "Устройство: <span style='color: gray;'>" . $name . "</span>"?></h2>
                </div>   
                <div class="device-field device-quickstatus">
                    <img src="<?php echo "res/".$imgPath; ?>">
                    <div>
                        <h3>Таблица активности устройства в текущем месяце</h3>
                        <p>Посмотреть <a href=#>за всё время</a>?</p>
                        <table class="device-status">  
                            <tr>
                                <th>Активность</th>
                                <th>Дата</th>
                                <th>Инициатор</th>
                                <th>Комментарий</th>
                            </tr>
                                <?php 
                                    $query = "SELECT * FROM condition_device WHERE `id_device` = '{$id_device}' AND MONTH(date) = MONTH(CURRENT_DATE())";
                                    $status_history_result = mysqli_query($connection, $query);
                                    if($status_history_result) {
                                        while($status_history = mysqli_fetch_array($status_history_result)) {
                                            $date = new DateTime($status_history['date']);
                                            $status = $status_history['status'] == "activated" ? "Online" : "Offline";
                                            $initiator = $status_history['initalize'];
                                            $date_string = $date->format('d.m.Y');
                                            $comment = $status_history['comment'];
                                            echo "<tr>";
                                            echo "<td>$status</td>";
                                            echo "<td>$date_string</td>";
                                            echo "<td>$initiator</td>";
                                            echo "<td>$comment</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="device-field">
                    <h2>Подробная статистика:</h2>
                </div>  

                <div class="device-field">
                    <h3>Аптайм устройства в текущем месяце</h3>
                    <div id="status-chart"></div>
                </div>     
                
                <div class="device-field">
                    <h3>Питание/заряд устройства в текущем месяце</h3>
                    <div id="power-chart"></div>
                </div>  
            </div>            
        </div>
        <nav class="sidebar commandbar">
            <li><a href="vievdevice.php?now_id_device=<?php echo $id_device?>&condition=1"> Включить устройство </a>
            <li><a href="vievdevice.php?now_id_device=<?php echo $id_device?>&condition=0"> Выключить устройство </a>
            <li><a href="vievdevice.php?delete_id=<?php echo $id_device?>"> Удалить устройство </a>
        </nav>
    </div>
<?php 
    include("includes/footer.php");
?>