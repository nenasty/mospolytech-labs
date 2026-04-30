<?php

function getDeletePage(): string {//возвращает HTML страницы удаления
    $db      = getDB();
    $message = '';

    if (isset($_GET['del']) && (int)$_GET['del'] > 0) {//передан ли id для удаления через URL
        $id = (int)$_GET['del'];//берём id и делаем числом
        $res = mysqli_query($db, "SELECT surname FROM contacts WHERE id={$id}");//ищем запись в базе (чтобы проверить, существует ли)
        if ($row = mysqli_fetch_assoc($res)) {// пытается достать строку из результата запрос
            $surname = htmlspecialchars($row['surname']);//берём фамилию (для сообщения) и защищаем вывод
            if (mysqli_query($db, "DELETE FROM contacts WHERE id={$id}")) {
                $message = "<p class=\"success\">Запись с фамилией <strong>{$surname}</strong> удалена</p>";
            } else {
                $message = '<p class="error">Ошибка при удалении записи</p>';
            }
        } else {
            $message = '<p class="error">Запись не найдена</p>';
        }
    }
//получаем список всех контактов (отсортирован по фамилии и имени)
    $listRes  = mysqli_query($db, "SELECT id, surname, name, lastname FROM contacts ORDER BY surname ASC, name ASC");
    $contacts = [];//создаём пустой массив
    while ($r = mysqli_fetch_assoc($listRes)) {//перебираем записи из результата запроса
        $contacts[] = $r;//добавляем каждую запись в массив
    }

    ob_start();//начинаем собирать хтмл
    ?>
    <?= $message ?>
    <div class="delete-list">
        <h3>Выберите запись для удаления:</h3>
        <?php if (empty($contacts)): ?>
            <p>Записей нет.</p>
        <?php else: ?>
            <?php foreach ($contacts as $c): ?>
                <?php
                    $fio = htmlspecialchars($c['surname'] . ' '
                         . ($c['name'] ? mb_substr($c['name'], 0, 1) . '.' : '') //делаем инициалы
                         . ($c['lastname'] ? mb_substr($c['lastname'], 0, 1) . '.' : ''));
                ?>
                <a href="index.php?action=delete&del=<?= $c['id'] //при клике передаётся id для удаления?>"
                   onclick="return confirm('Удалить <?= htmlspecialchars($c['surname']) //всплывающее окно «Удалить?»?>?')">
                    <?= $fio //показываем ФИО?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();//возвращаем весь HTML
}
