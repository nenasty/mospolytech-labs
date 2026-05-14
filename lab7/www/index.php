<?php

spl_autoload_register(function (string $className) { 
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className) . '.php';
}); //www/../src/MyProject/Controllers/MainController.php

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/../src/routes.php';//переменная куда сохраняем все маршруты

$isRouteFound = false; //переменная-флаг изначально маршрут не найден

foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
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
unset($matches[0]);
//Nastya чтобы передать его в метод sayBye()



$controllerName = $controllerAndAction[0];


$actionName = $controllerAndAction[1];

//Создаём объект контроллера
$controller = new $controllerName();

//Вызываем метод контроллера
//передать все элементы массива как аргументы
$controller->$actionName(...$matches);
//sayBye('Nastya')