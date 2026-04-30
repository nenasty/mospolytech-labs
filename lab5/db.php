<?php
// Настройки подключения к базе данных
//это константы
define('DB_HOST', 'sql104.infinityfree.com');
define('DB_USER', 'if0_41669991');
define('DB_PASS', 'Nva20071');
define('DB_NAME', 'if0_41669991_phonebook');
//функция возвращает объект подключения к базе данных типа mysqli
function getDB(): mysqli {
    //для сохранения соединения с базой данных, чтобы не создавать его заново при каждом вызове функции
    static $conn = null;
    if ($conn === null) {//если ещё не подключились → подключаемся
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (mysqli_connect_errno()) {//если ошибка подключения → останавливаем программу
            die('<p style="color:red">Ошибка подключения к БД: '
                . htmlspecialchars(mysqli_connect_error()) . '</p>');
        }
        mysqli_set_charset($conn, 'utf8mb4');//чтобы корректно работал русский текст
    }
    return $conn;//возвращаем соединение с БД
}
