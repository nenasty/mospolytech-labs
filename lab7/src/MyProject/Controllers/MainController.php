<?php
//в каком пространстве имён находится этот класс
namespace MyProject\Controllers;

use MyProject\View\View;

class MainController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }
//метод, который вызывается, когда открывается главная страница
    public function main()
    {
        $articles = [
            ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
            ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
        ];
//у объекта View — вызови метод renderHtml, покажи шаблон main/main.php и передай туда статьи
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayBye(string $name)
    {
        $this->view->renderHtml('main/bye.php', ['name' => $name]);
    }
}