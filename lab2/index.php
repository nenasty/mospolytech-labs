<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма обратной связи</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header>
        <img src="../logo.png" alt="МосковскийПолитех">
        <h1>Лабораторная работа №2</h1>
    </header>

    <main>
        <h2>Форма обратной связи</h2>

        <form action="https://httpbin.org/post" method="post">

            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" placeholder="Введите ваше имя" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="example@mail.ru" required>
            </div>

            <div class="form-group">
                <label for="type">Тип обращения</label>
                <select id="type" name="type" required>
                    <option value="" disabled selected>Выберите тип...</option>
                    <option value="complaint">Жалоба</option>
                    <option value="suggestion">Предложение</option>
                    <option value="gratitude">Благодарность</option>
                </select>
            </div>

            <div class="form-group">
                <label for="message">Текст обращения</label>
                <textarea id="message" name="message" placeholder="Опишите ваше обращение..." required></textarea>
            </div>

            <div class="form-group">
                <label>Вариант ответа</label>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="reply[]" value="sms"> СМС
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="reply[]" value="email"> E-mail
                    </label>
                </div>
            </div>

            <div class="btn-row">
                <button type="submit" class="btn">Отправить</button>
                <a href="page2.php" class="btn">Страница 2</a>
            </div>

        </form>
    </main>

    <footer>
        <p>Задание: форма обратной связи</p>
    </footer>

</body>
</html>
