<?php
//Адрес этого класса — MyProject\View
namespace MyProject\View;

class View
{
    private string $templatesPath;//путь до папки с шаблонами

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }
//метода — "отрисовать HTML"
//Публичный метод renderHtml принимает два параметра:

//$templateName — имя шаблона (строка, обязательный)
//$vars — переменные для шаблона (массив, необязательный, по умолчанию пустой)
    public function renderHtml(string $templateName, array $vars = [])
    {
        extract($vars);
        include $this->templatesPath . '/' . $templateName;
        
    }
}

// extract($vars);
// •	extract — встроенная функция PHP
// •	Она превращает массив в переменные!
// •	Например если передали ['name' => 'Nastya'] — появляется переменная $name = 'Nastya'
// •	Именно поэтому в шаблоне можно писать просто $name а не $vars['name']


// include — подключить файл
// $this->templatesPath — путь до папки с шаблонами
// '/' — разделитель
// $templateName — имя шаблона

// Итого получается путь например: /templates/main/main.php