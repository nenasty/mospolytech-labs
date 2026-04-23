<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>get_headers</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header>
        <img src="../logo.png" alt="МосковскийПолитех">
        <h1>Лабораторная работа №2</h1>
    </header>

    <main>
        <h2>Заголовки HTTP-ответа</h2>
        <p>Результат функции <b>get_headers()</b> для <b>https://httpbin.org/post</b></p>

        <textarea class="headers-output" readonly><?php
$url = 'https://httpbin.org/post';
$headers = get_headers($url);

if ($headers === false) {
    echo "Ошибка: не удалось получить заголовки.";
} else {
    foreach ($headers as $i => $header) {
        echo "[$i] $header\n";
    }
}
?></textarea>

        <div class="btn-row">
            <a href="index.php" class="btn">Страница 1</a>
        </div>
    </main>

    <footer>
        <p>Задание: форма обратной связи</p>
    </footer>

</body>
</html>
