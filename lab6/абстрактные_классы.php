<?php

abstract class HumanAbstract //шаблон для классов
{
    private string $name; //объявляем свойство $name 

    public function __construct(string $name) //имя автомат записывается в св-во нейм
    {
        $this->name = $name;
    }

//Чтобы получить напрямую значение приватного свойства у объекта
    public function getName(): string //геттер - метод возврат имя 
    {
        return $this->name;
    }
// 2 абстрактных метода - каждый наследник пишет их сам
    abstract public function getGreetings(): string;
    abstract public function getMyNameIs(): string;

    public function introduceYourself(): string //собираем приветствие 
    {
        return $this->getGreetings() . '! ' . $this->getMyNameIs() . ' ' . $this->getName() . '.';
    }
}

class RussianHuman extends HumanAbstract
{ //реализуем абстрактный метод 
    public function getGreetings(): string
    {
        return 'Привет';
    }

    public function getMyNameIs(): string
    {
        return 'Меня зовут';
    }
}

class EnglishHuman extends HumanAbstract
{
    public function getGreetings(): string
    {
        return 'Hello';
    }

    public function getMyNameIs(): string
    {
        return 'My name is';
    }
}
//Создаём русского человека и просим представиться
$russian = new RussianHuman('Иван');
echo $russian->introduceYourself() . PHP_EOL;

$english = new EnglishHuman('Oliver');
echo $english->introduceYourself() . PHP_EOL;