<?php
$equation = "22 * X  = 220";
$original = $equation;


$equation = str_replace(" ", "", $equation);//пробелы внутри
$equation = strtolower($equation);//нижний регистр


$sides = explode("=", $equation);//режем по х
$leftSide  = $sides[0]; 
$rightSide = (int)$sides[1]; 


if (strpos($leftSide, '+') !== false) {
    $sign = '+';
} elseif (strpos($leftSide, '-') !== false) {
    $sign = '-';
} elseif (strpos($leftSide, '*') !== false) {
    $sign = '*';
} elseif (strpos($leftSide, '/') !== false) {
    $sign = '/';
}


$members = explode($sign, $leftSide);//разрез левую часть по оператору
$first  = $members[0]; 
$second = $members[1]; 


if ($first === 'x') {
    $position = "слева";
    $number = (int)$second;
} else {
    $position = "справа";
    $number = (int)$first;
}


if ($sign === '+') {
    $answer = $rightSide - $number;

} elseif ($sign === '-') {
    if ($position === "слева") {
        $answer = $rightSide + $number;
    } else {
        $answer = $number - $rightSide;
    }

} elseif ($sign === '*') {
    $answer = $rightSide / $number;

} elseif ($sign === '/') {
    if ($position === "слева") {
        $answer = $rightSide * $number;
    } else {
        $answer = $number / $rightSide;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Решение уравнения</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <img src="../logo.png" alt="МосковскийПолитех">
        <h1>Лабораторная работа №3</h1>
    </header>

    <main>
        <h2>Решение уравнения</h2>
        <p>Уравнение: <?= $original ?></p>
        <p>Оператор: <?= $sign ?></p>
        <p>X находится: <?= $position ?></p>
        <div class="result-box">X = <?= $answer ?></div>

        <h2>Блок-схема алгоритма</h2>
        <img src="diagrama.png" alt="Блок-схема" style="max-width: 100px; width: 100%; margin-top: 20px;">
    </main>

    <footer>
        <p>Задание: решение уравнения <?= $original ?> </p>
    </footer>
</body>
</html>