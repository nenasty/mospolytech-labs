<?php

class Post
{
    private string $title; //заголовок
    private string $text; //текст

    public function __construct(string $title, string $text)
    {
        $this->title = $title;
        $this->text = $text;
    }
}
//есть у урока автоматически есть $title и $text 
class Lesson extends Post
{
    private string $homework; //добавляем новое свойство

    public function __construct(string $title, string $text, string $homework)
    { //вызывает конструктор родителя чтобы он сам записал заголовок и текст
        parent::__construct($title, $text);
        $this->homework = $homework;
    }
}

class PaidLesson extends Lesson
{
    private float $price;

    public function __construct(string $title, string $text, string $homework, float $price)
    {
        parent::__construct($title, $text, $homework);
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }


    public function setPrice(float $price): void //изменить цену после создания объекта
    {
        $this->price = $price;
    }
}

$lesson = new PaidLesson('Урок о наследовании в PHP', 'Лол, кек, чебурек', 'Ложитесь спать, утро вечера мудренее', 99.90);
var_dump($lesson);


