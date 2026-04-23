<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Hello, World!</title>
    <link rel="stylesheet" href="../style.css">
</head>
    
<body>
    <header>
    	<img src="../logo.png" alt="МосковскийПолитех">
    	<h1>Лабораторная работа №1</h1>
    </header>
    
    <main>
    	<?php echo '<h2>Hello, Word!</h2>'; ?>
		<?php echo '<p>Текущее время сервера: <b>' . date('H:i:s') . '</b></p>'; ?>
		<?php echo '<p>Сегодня: <b>' . date('d.m.Y') . '</b></p>'; ?>
	</main>

	<footer>
        <p>Задание: создать веб-страницу с динамическим контентом</p>
	</footer>

</body>
</html>
