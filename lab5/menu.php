<?php
function getMenu(): string { //возвращает строку (хтмл меню)
    $action = $_GET['action'] ?? 'view'; //берём action из URL
    //если нет → 'view'

//массив меню
    $items = [
        'view'   => 'Просмотр',
        'add'    => 'Добавление записи',
        'edit'   => 'Редактирование записи',
        'delete' => 'Удаление записи',
    ];

    $html = ''; //сюда собирать хтмл
    foreach ($items as $key => $label) { //key → view, add(label - текст)
        $active = ($action === $key) ? ' class="select"' : '';//если текущая страница совпадает с пунктом меню(добавляем класс select)
        $html .= "<a href=\"index.php?action={$key}\"{$active}>{$label}</a>\n"; //создаётся одна ссылка меню
    }

    return $html; //возврат готовое меню
}