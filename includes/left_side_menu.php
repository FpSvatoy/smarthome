<nav class="sidebar">
	<li><a href="all_device.php"> Устройства </a>
	<?php $has_access_to_devices = intval($_SESSION['now_user_id_access']) == 0; ?>
	<li><a <?php if( !$has_access_to_devices ) echo "href='#' class = 'inactive-menu-item'"; else echo "href='all_users.php'" ?>> Пользователи </a>
	<?php unset($has_access_to_devices);?>
	<li><a href="profile.php"> Профиль </a>
</nav>