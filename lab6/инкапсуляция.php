<?php

class Cat
{
    private string $name;
    private string $color;

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function sayHello(): void
    {
        echo 'Привет! Меня зовут ' . $this->name . '.' . ' Я ' . $this->color . ' кошка.';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}

$cat1 = new Cat('Мурка', 'белая');
$cat1->sayHello();