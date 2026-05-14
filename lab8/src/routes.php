<?php
//список маршрутов
//добавили роут для hello:
return [
    '~^hello/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayHello'],
    '~^bye/(.*)$~' => [\MyProject\Controllers\MainController::class, 'sayBye'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
];

//MainController::class — это просто способ написать полное имя класса:
//MyProject\Controllers\MainController

//Ключ — шаблон адреса:
//'~^bye/(.*)$~'
//Значение — что делать:
//[MainController::class, 'sayBye']


//Зашли на /hello/Nastya → вызови sayHello('Nastya')