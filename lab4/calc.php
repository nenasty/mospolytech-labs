<?php

function calculate($expr) {
    $expr = str_replace(' ', '', $expr);
    $expr = str_replace('pi', M_PI, $expr);
    $expr = str_replace('e', M_E, $expr);
    $pos = 0; //переменная-указатель(на какой символ строки смотрим)
    return parseExpr($expr, $pos);//передаем строку в след ф
}

function parseExpr(&$expr, &$pos) {//сложение и вычитаение
    $result = parseTerm($expr, $pos);
    while ($pos < strlen($expr) && ($expr[$pos] === '+' || $expr[$pos] === '-')) {
        $op = $expr[$pos];
        $pos++;
        $term = parseTerm($expr, $pos);
        if ($op === '+') $result += $term;
        else $result -= $term;
    }
    return $result;
}

function parseTerm(&$expr, &$pos) {//умнож и дел
    $result = parsePower($expr, $pos);
    while ($pos < strlen($expr) && ($expr[$pos] === '*' || $expr[$pos] === '/')) {
        $op = $expr[$pos];
        $pos++;
        $power = parsePower($expr, $pos);
        if ($op === '*') $result *= $power;
        else {
            if ($power == 0) { header("Location: index.php?error=деление на ноль"); exit; }
            //header используется для отправки HTTP-заголовка. для перенаправления пользователя на другую страницу.
            $result /= $power;
        }
    }
    return $result;
}

function parsePower($expr, &$pos) {
    $result = parseUnary($expr, $pos);
    if ($pos < strlen($expr) && $expr[$pos] === '^') {
        $pos++;
        $exp = parsePower($expr, $pos); 
        $result = pow($result, $exp);
    }
    return $result;
}

function parseUnary(&$expr, &$pos) {
    if ($pos < strlen($expr) && $expr[$pos] === '-') {
        $pos++;
        return -parseFactor($expr, $pos);
    }
    return parseFactor($expr, $pos);//минуса нет дальше идем
}

function parseFactor(&$expr, &$pos) {//факториал
    if ($expr[$pos] === '(') {
        $pos++;
        $result = parseExpr($expr, $pos);//считаем внутри скобок
        $pos++;
        if ($pos < strlen($expr) && $expr[$pos] === '!') {
            $pos++;//пропуск !
            $result = factorial($result);
        }
        return $result;
    }
    if (substr($expr, $pos, 5) === 'sqrt(') {//первые 5 символос слвово корен
        $pos += 5;
        $arg = parseExpr($expr, $pos);
        $pos++;//пропуск 2 скобки
        return sqrt($arg);
    }
    if (substr($expr, $pos, 3) === 'ln(') {
        $pos += 3;
        $arg = parseExpr($expr, $pos);
        $pos++;
        return log($arg);//в php это нат лог
    }
    if (substr($expr, $pos, 4) === 'log(') {
        $pos += 4;
        $arg = parseExpr($expr, $pos);
        $pos++;
        return log10($arg);
    }
    $num = '';
    //пока эт цифра или точка доб в нам
    while ($pos < strlen($expr) && (is_numeric($expr[$pos]) || $expr[$pos] === '.')) {
        $num .= $expr[$pos];
        $pos++;
    }
    if ($pos < strlen($expr) && $expr[$pos] === '!') {
        $pos++;
        return factorial((int)$num);
    }
    return (float)$num;//строку в число если нет факториал
}

function factorial($n) {
    if ($n < 0) {
        header("Location: index.php?error=факториал отрицательного числа");
        exit;
    }
    if ($n === 0 || $n === 1) return 1;
    return $n * factorial($n - 1);
}

function validate($expr) {//проверка на разрешенные символы
    return preg_match('/^[0-9+\-*\/().^!a-z\s]+$/', $expr);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //если запрос был пост
    $expr = $_POST['expr'] ?? '';//возьми переменную из формы
    if (empty($expr)) { header("Location: index.php?error=пустое выражение"); exit; } //емпти - пусто ли. если пусто ошибка
    if (!validate($expr)) { header("Location: index.php?error=недопустимые символы"); exit; }
    $result = calculate($expr);
    header("Location: index.php?result=" . round($result, 10));//перейти на хтмл передай резы
    exit;
}