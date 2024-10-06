
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
		<main class = "mainReg">
<?php session_start(); ?>	
<section>
<p1> Умный Дом <img src="https://cdn1.ozone.ru/s3/multimedia-9/6616033677.jpg" alt="чай улун"> </p1>
</section>
<section class = "section_reg">
<form action="backend/regBack.php" method="post">
	<p>
		<input name="login" id="login" placeholder="Логин" type="text">
	</p>
	<p>
		<input name="surname" id="surname" placeholder="Фамилия" type="text">
	</p>
	<p>
		<input name="name" id="name" placeholder="Имя" type="text">
	</p>
	<p>
		<input name="patronymic" id="patronymic" placeholder="Отчество" type="text">
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
	<button name = "regsubmit" id="submit" type="submit">Зарегистрироваться</button>
</form>
<div id="href-reg">
	<a id="auth-reg" href="backend/authorizez.php">
		Вход в лк
	</a>
	
	<a href="terms.php" style="color: rgb(172, 161, 161);">
		Соглашение об использовании
	</a>
</div>
<p  class ="support_msg"> <?php echo ($_SESSION['support_msg']);?></p>
</section>
		</main>
		<div>
	</body>
</html>

