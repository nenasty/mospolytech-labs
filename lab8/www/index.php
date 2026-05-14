<?php
//встроенная ф-ция, когда встретишь новый класс вызови ф-ция
spl_autoload_register(function (string $className) { //имя класса которое надо загрузить
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
}); //www/../src/MyProject/Controllers/MainController.php

$route = $_GET['route'] ?? ''; //берём параметр route из адресной строки
$routes = require __DIR__ . '/../src/routes.php';//переменная куда сохраняем все маршруты

$isRouteFound = false; //переменная-флаг изначально маршрут не найден
//Для каждого правила из списка $routes — возьми шаблон адреса в $pattern и действие в $controllerAndAction
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);//проверяет совпадает ли адрес с регуляркой(matches — сюда сохраняются все совпадения)
    if (!empty($matches)) {//если совпадения нашлись
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    echo 'Страница не найдена!';
    return;
}
 //unset — удаляем элемент из массива
 //первый элемент массива — это полное совпадение по регулярке,
 // например bye/Nastya. Он нам не нужен — нам нужен только Nastya
unset($matches[0]);



//Берём первый элемент — имя класса:
//MyProject\Controllers\MainController
$controllerName = $controllerAndAction[0];

//Берём второй элемент — имя метода:
//sayBye
$actionName = $controllerAndAction[1];

//Создаём объект контроллера
$controller = new $controllerName();

//Вызываем метод контроллера
//$matches это передать все элементы массива как аргументы
$controller->$actionName(...$matches);