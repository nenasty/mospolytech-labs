<?php
function getEditForm(): string { //возвращает HTML
    $db      = getDB();//подключ к бд
    $message = '';//ошибка/успех
    $button  = 'Сохранить'; //текст кнопки

    //получения списка контактов (id, фамилия, имя) с сортировкой
    $listRes = mysqli_query($db, "SELECT id, surname, name FROM contacts ORDER BY surname ASC, name ASC");
    $contacts = [];//массив для контактов 
    while ($r = mysqli_fetch_assoc($listRes)) {  //берёт одну строку из результата возвращает как масси
        $contacts[] = $r; //добавляем эту строку в массив $contacts
    }

    $currentId = $_GET['id'] ?? ($contacts[0]['id'] ?? 0);//достаем айди если нет берём id первого контакта если контактов нет 0
    $currentId = (int)$currentId; //делаем айди числом

    if (isset($_POST['button']) && $_POST['button'] === 'Сохранить') { //проверяет если ли кнопка в пост. проверяет значение кнопки 
        $id       = (int)$_POST['id'];//получаем id записи и приводим к числу
        $surname  = mysqli_real_escape_string($db, $_POST['surname']); //получаем данные из формы(кранирует строку (добавляет слеши, убирает опасные символы)
        $name     = mysqli_real_escape_string($db, $_POST['name']);
        $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
        $gender   = mysqli_real_escape_string($db, $_POST['gender']);
        $date     = mysqli_real_escape_string($db, $_POST['date']);
        $phone    = mysqli_real_escape_string($db, $_POST['phone']);
        $location = mysqli_real_escape_string($db, $_POST['location']);
        $email    = mysqli_real_escape_string($db, $_POST['email']);
        $comment  = mysqli_real_escape_string($db, $_POST['comment']);
//обновляем таблицу через сэт задаём новые значения полей
        $sql = "UPDATE contacts SET 
            surname='{$surname}', name='{$name}', lastname='{$lastname}',
            gender='{$gender}', date=" . ($date ? "'{$date}'" : "NULL") . ",
            phone='{$phone}', location='{$location}',
            email='{$email}', comment='{$comment}'
            WHERE id={$id}"; //обновляем конкретную запись по id

        if (mysqli_query($db, $sql)) { //выполняем SQL-запрос
            $message = '<p class="success">Запись обновлена</p>';
            $currentId = $id; //обновляем текущий id
        } else {
            $message = '<p class="error">Ошибка: запись не обновлена</p>';
        }
    }

    $row = [ //создали массив с пустыми знач
        'id'=>'','surname'=>'','name'=>'','lastname'=>'','gender'=>'',
        'date'=>'','phone'=>'','location'=>'','email'=>'','comment'=>''
    ];

    if ($currentId) {//если есть айди
        $res = mysqli_query($db, "SELECT * FROM contacts WHERE id={$currentId}");//берем из базы 1 запись по айди
        if ($r = mysqli_fetch_assoc($res)) {//получаем эту запись как массив
            $row = $r;//записываем данные в $row
        }
    }

    ob_start();//буферизацию вывода-не сразу отправляется в браузер-сначала собирается хтмл
    ?>
    <?= $message ?> 

    <div class="edit-wrapper">

        <div class="div-edit">
            <h3>Контакты:</h3>
            <?php foreach ($contacts as $c): ?>
                <div class="<?= ($c['id']==$currentId?'currentRow':'') ?>">
                    <a href="index.php?action=edit&id=<?= $c['id'] //при клике загружается другой контакт ?>"> 
                        <?= htmlspecialchars($c['surname'].' '.$c['name'])  /**вывод фамилии и имени */?> 
                    </a> 
                </div>
            <?php endforeach; ?>
        </div>

        <form method="post" action="index.php?action=edit&id=<?= $currentId ?>">
            <input type="hidden" name="id" value="<?= $currentId /**скрыто передаём id записи */?>"> 

            <div class="column">

                <div class="add">
                    <label>Фамилия</label>
                    <input type="text" name="surname" value="<?= $row['surname'] ?>" required>
                </div>

                <div class="add">
                    <label>Имя</label>
                    <input type="text" name="name" value="<?= $row['name'] ?>" required>
                </div>

                <div class="add">
                    <label>Отчество</label>
                    <input type="text" name="lastname" value="<?= $row['lastname'] ?>">
                </div>

                <div class="add">
                    <label>Пол</label>
                    <select name="gender">
                        <option value="">— не указан —</option>
                        <option value="мужской" <?= $row['gender']=='мужской'?'selected':'' ?>>мужской</option>
                        <option value="женский" <?= $row['gender']=='женский'?'selected':'' ?>>женский</option>
                    </select>
                </div>

                <div class="add">
                    <label>Дата рождения</label>
                    <input type="date" name="date" value="<?= $row['date'] ?>">
                </div>

                <div class="add">
                    <label>Телефон</label>
                    <input type="text" name="phone" value="<?= $row['phone'] ?>">
                </div>

                <div class="add">
                    <label>Адрес</label>
                    <input type="text" name="location" value="<?= $row['location'] ?>">
                </div>

                <div class="add">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $row['email'] ?>">
                </div>

                <div class="add">
                    <label>Комментарий</label>
                    <textarea name="comment"><?= $row['comment'] ?></textarea>
                </div>

                <button type="submit" name="button" value="<?= $button /**кнопка "Сохранить" */?>" class="form-btn">
                    <?= $button ?>
                </button>

            </div>
        </form>

    </div>
    <?php
    return ob_get_clean(); /**возвращаем весь HTML */
}