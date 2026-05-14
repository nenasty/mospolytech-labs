<?php

namespace MyProject\View;

class View
{
    private string $templatesPath;//путь до папки с шаблонами

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    
//$templateName — имя шаблона
//$vars — переменные для шаблона
    public function renderHtml(string $templateName, array $vars = [])
    {
        extract($vars);
        include $this->templatesPath . '/' . $templateName; 
        
    }
}
//['name' => 'Nastya'] — $name = 'Nastya'
//Подключает файл шаблона
//templates/main/main.php