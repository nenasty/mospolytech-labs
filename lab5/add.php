<?php
function getAddForm(): string { //возвращает строку (HTML формы)
    $db      = getDB();
    $message = '';
    $button  = 'Добавить';

    if (isset($_POST['button']) && $_POST['button'] === 'Добавить') { //проверяем, что форма отправлена кнопкой добавить
        $surname  = mysqli_real_escape_string($db, trim($_POST['surname']  ?? '')); //берём значение из формы
        $name     = mysqli_real_escape_string($db, trim($_POST['name']     ?? ''));//убираем пробелы в начале и конце
        $lastname = mysqli_real_escape_string($db, trim($_POST['lastname'] ?? ''));//очищаем для безопасного SQL
        $gender   = mysqli_real_escape_string($db, trim($_POST['gender']   ?? ''));
        $date     = mysqli_real_escape_string($db, trim($_POST['date']     ?? ''));
        $phone    = mysqli_real_escape_string($db, trim($_POST['phone']    ?? ''));
        $location = mysqli_real_escape_string($db, trim($_POST['location'] ?? ''));
        $email    = mysqli_real_escape_string($db, trim($_POST['email']    ?? ''));
        $comment  = mysqli_real_escape_string($db, trim($_POST['comment']  ?? ''));
//создаётся SQL-запрос добавления новой записи
        $sql = "INSERT INTO contacts (surname,name,lastname,gender,date,phone,location,email,comment)
                VALUES ('{$surname}','{$name}','{$lastname}','{$gender}',
                        " . ($date ? "'{$date}'" : "NULL") . ",
                        '{$phone}','{$location}','{$email}','{$comment}')";

        if (mysqli_query($db, $sql)) { //выполняем SQL-запрос (добавление записи)
            $message = '<p class="success">Запись добавлена</p>';
        } else {
            $message = '<p class="error">Ошибка: запись не добавлена</p>';
        }
    }
//создаём массив с пустыми значениями
//нужен для формы, чтобы поля были пустыми по умолчанию
    $row = [
        'surname'=>'','name'=>'','lastname'=>'','gender'=>'',
        'date'=>'','phone'=>'','location'=>'','email'=>'','comment'=>''
    ];

    ob_start();
    ?>
    <?= $message ?>
    <form method="post" action="index.php?action=add">
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
                    <option value="мужской">мужской</option>
                    <option value="женский">женский</option>
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

            <button type="submit" name="button" value="<?= $button ?>" class="form-btn">
                <?= $button ?>
            </button>

        </div>
    </form>
    <?php
    return ob_get_clean();
}