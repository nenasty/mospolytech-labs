<?php
require_once 'db.php'; //подключ файл с бд
require_once 'menu.php';


$allowedActions = ['view', 'add', 'edit', 'delete']; //список разрешенных знач
$allowedSorts   = ['id', 'surname', 'date'];//массив разрешенных сортировок

// action
$action = $_GET['action'] ?? 'view';//получаем параметр action из супрглоб массива(если нет табличку)
if (!in_array($action, $allowedActions)) {//проверяем через ф если не из списка разшененных
    $action = 'view';//просто показ табличку
}

// sort(viewer)
$sort = $_GET['sort'] ?? 'id';//по порядку добавления
if (!in_array($sort, $allowedSorts)) {
    $sort = 'id';
}

// page (пагинация)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;//если в юрл есть page берем число, нет ставим 1(тип 1 стр)
$page = max(1, $page);//чтобы не могло быть меньше 1
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <?php echo getMenu(); ?>
</header>

<main>
<?php
switch ($action) {

    case 'view':
        require_once 'viewer.php';
        echo getViewer($sort, $page);//запрос в бд формирует табл возврат хтмл и вывести на экран
        break;

    case 'add':
        require_once 'add.php';
        echo getAddForm();//показ формы+обработка данных+доб данные бд
        break;

    case 'edit':
        require_once 'edit.php';
        echo getEditForm();
        break;

    case 'delete':
        require_once 'delete.php';
        echo getDeletePage();
        break;

    default://если фигня пришла
        require_once 'viewer.php';
        echo getViewer($sort, $page);
}
?>
</main>

<footer></footer>

</body>
</html>