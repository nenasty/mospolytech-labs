<?php

function getViewer(string $sort, int $page): string { //возвращает HTML-код таблицы
    $db = getDB();//подключение к базе данных через функцию getDB()

    $sortMap = [ //хранит варианты сортировки
        'id'      => 'id ASC', //что пришло из юрл как сортировать в бд
        'surname' => 'surname ASC, name ASC',
        'date'    => 'date ASC'
    ];
    $orderBy = $sortMap[$sort] ?? 'id ASC';

    // общее количество записей
    $countRes = mysqli_query($db, "SELECT COUNT(*) FROM contacts");//mysqli_query() — функция выполнения SQL-запроса. считает кол-во строк
    $total    = (int)mysqli_fetch_row($countRes)[0];//функция получает рез запроса приводит к числу

    $perPage  = 10; //макс 10 записей
    $pages    = (int)ceil($total / $perPage); //скок старниц(округ вверх)
    if ($page < 1) $page = 1; //защита от бреда
    if ($page > $pages && $pages > 0) $page = $pages; //запросил страницу которой нет выводим последнюю сущ
    $offset = ($page - 1) * $perPage; //смещение (offset) — с какого места брать записи из базы
//$page = 2
//offset = (2 - 1) * 10 = 10
//пропускаем первые 10 записей
    if ($total === 0) { //если в бд пусто
        return '<p style="margin-top:30px">База данных пуста.</p>';
    }
//формирование HTML-меню для сортировки
//три ссылки a, каждая задаёт сортировку
    $html = '<div class="submenu"> 
        <a href="index.php?action=view&sort=id" class="'.($sort=='id'?'select':'').'">По добавлению</a>
        <a href="index.php?action=view&sort=surname" class="'.($sort=='surname'?'select':'').'">По фамилии</a>
        <a href="index.php?action=view&sort=date" class="'.($sort=='date'?'select':'').'">По дате рождения</a>
    </div>';


    $res  = mysqli_query($db, "SELECT * FROM contacts ORDER BY {$orderBy} LIMIT {$perPage} OFFSET {$offset}");//зпрос к бд
    $html .= '<table>
    <tr>
        <th>№</th><th>Фамилия</th><th>Имя</th><th>Отчество</th>
        <th>Пол</th><th>Дата рождения</th><th>Телефон</th>
        <th>Адрес</th><th>Email</th><th>Комментарий</th>
    </tr>';

    $num = $offset + 1;//порядковый номер(на 1 странице офсет 0 на второй с 10)
    while ($row = mysqli_fetch_assoc($res)) {//функция которая каждый раз достаёт одну строку из результата запроса возвращает её как массив
        $html .= '<tr>';//создаем ячейку для номера
        $html .= '<td>' . $num++ . '</td>'; // добавляем ячейку с порядковым номером
        //$field принимает следующее значение из списка — 'surname'
        foreach (['surname','name','lastname','gender','date','phone','location','email','comment'] as $field) {
            $val   = htmlspecialchars($row[$field] ?? '');//берём значение из базы и делаем его безопасным для вывода
            $html .= "<td>{$val}</td>"; //оборачиваем значение в ячейку таблицы и дописываем в $html
        }
        $html .= '</tr>';
    }
    $html .= '</table>';

//пагинация выводится только если страниц больше одной
    if ($pages > 1) {
        $html .= '<div class="pagination">'; //контейнер для кнопок
        for ($i = 1; $i <= $pages; $i++) { // цикл от 1 до количества страниц.
            $active = ($i === $page) ? ' class="active"' : '';  //если это текущая страница добавляем класс 
            $html  .= "<a href=\"index.php?action=view&sort={$sort}&page={$i}\"{$active}>{$i}</a> "; //создаём ссылку на страницу
        }
        $html .= '</div>';
    }

    return $html;
}