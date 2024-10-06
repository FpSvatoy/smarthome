
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="css/style-reg-auth.css">
</head>
	<body>
		<div class = "centerBlock">
		<main class = "mainAuth">
			<?php session_start(); 
			    if (isset($_GET["exit"])) {
					$_SESSION["now_user_login"] = '';
					$_SESSION["now_user_id"] = '';
					$_SESSION["now_user_id_access"] = '';
					$_SESSION["support_msg"] = '';
				}
				if (empty($_SESSION["support_msg"])) {
					$_SESSION["now_user_login"] = '';
					$_SESSION["now_user_id"] = '';
					$_SESSION["now_user_id_access"] = '';
					$_SESSION["support_msg"] = '';
				}
			?>	
			<section>
				<p1> Умный Дом <img src="https://cdn1.ozone.ru/s3/multimedia-9/6616033677.jpg" alt="чай улун"> </p1>
			</section>
			<section class = "section_authoriz">
				<form action="backend/authorizez.php" method="post">
					<p>
						<input name="login" id="login" placeholder="Логин" type="text">
					</p>
					<p>
						<input name="password" id="password" placeholder="Пароль" type="password">
					</p>
					<button name = "submit" id="submit" type="submit">Войти</button>
				</form>
				<div id="href-reg">
					<a id="auth-reg" href="backend/regBack.php">
						Регистрация
					</a>
				</div>
				<p  class ="support_msg"> <?php echo ($_SESSION['support_msg']);?></p>
			</section>
		</main>
		<div>
	</body>
</html>