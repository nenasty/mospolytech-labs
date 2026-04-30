<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <img src="../logo.png" alt="logo">
    <h1>Лабораторная работа №4</h1>
</header>

<main>
    <h2>Калькулятор</h2>


<form method="POST" action="calc.php" class="calculator"> 
    <?php if (isset($_GET['error'])): ?>
        <div class="error">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <input type="text" id="display" name="expr"  value="<?php echo htmlspecialchars($_GET['result'] ?? ''); ?>">

    <div class="buttons">

        <button type="button" class="btn-func" onclick="press('^')">xʸ</button>
        <button type="button" class="btn-func" onclick="press('sqrt(')">√</button>
        <button type="button" class="btn-func" onclick="press('ln(')">ln</button>
        <button type="button" class="btn-func" onclick="press('log(')">log</button>

        <button type="button" class="btn-func" onclick="press('!')">n!</button>
        <button type="button" class="btn-func" onclick="press('pi')">π</button>
        <button type="button" class="btn-func" onclick="press('e')">e</button>
        <button type="button" class="btn-clear" onclick="clearDisplay()">C</button>

        <button type="button" onclick="press('7')">7</button>
        <button type="button" onclick="press('8')">8</button>
        <button type="button" onclick="press('9')">9</button>
        <button type="button" class="btn-operator" onclick="press('+')">+</button>

        <button type="button" onclick="press('4')">4</button>
        <button type="button" onclick="press('5')">5</button>
        <button type="button" onclick="press('6')">6</button>
        <button type="button" class="btn-operator" onclick="press('-')">-</button>

        <button type="button" onclick="press('1')">1</button>
        <button type="button" onclick="press('2')">2</button>
        <button type="button" onclick="press('3')">3</button>
        <button type="button" class="btn-operator" onclick="press('*')">×</button>

        <button type="button" onclick="press('0')">0</button>
        <button type="button" onclick="press('.')">.</button>
        <button type="button" onclick="press('()')">()</button>
        <button type="button" class="btn-operator" onclick="press('/')">÷</button>

        <button class="btn-equal" type="submit">=</button>

    </div>
</form>


</main>

<footer>
    <p>Задание: Калькулятор</p>
</footer>

<script src="script.js"></script>

</body>
</html>
