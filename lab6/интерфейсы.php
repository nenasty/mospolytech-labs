<?php
//кто его подпишет обязан уметь считать площадь
interface CalculateSquare
{//обязательный метод который должен быть у всех кто реализует этот интерфейс
    public function calculateSquare(): float;
}
//implements означает я подписываю контракт CalculateSquare
class Circle implements CalculateSquare
{
    const PI = 3.1416; //объявляем константу
    private float $r;//радиус

    public function __construct(float $r)
    {
        $this->r = $r;
    }
//Метод вычисления площади круга
    public function calculateSquare(): float
    {
        return self::PI * ($this->r ** 2);
    }//self::PI обращаемся к константе PI этого класса
}

class Rectangle //прямоугольник не подписал контракт
{//стороны
    private float $x;
    private float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function calculateSquare(): float
    {
        return $this->x * $this->y;
    }//интерфейс не реализован — поэтому Rectangle попадёт в else
}

class Square implements CalculateSquare
{
    private float $x;

    public function __construct(float $x)
    {
        $this->x = $x;
    }

    public function calculateSquare(): float
    {
        return $this->x ** 2;
    }
}


$objects = [
    new Square(5),
    new Rectangle(2, 4),
    new Circle(5),
];

foreach ($objects as $object) {
    $className = get_class($object);//получаем название класса текущего объекта с помощью функции get_class()
    if ($object instanceof CalculateSquare) { //instanceof возвращает true или false(подписал ли конракт)
        echo 'Объект класса ' .  $className . ' реализует интерфейс CalculateSquare. Площадь: ' . $object->calculateSquare() . PHP_EOL;
    } else {
        echo 'Объект класса ' . $className . ' не реализует интерфейс CalculateSquare.' . PHP_EOL;
    }
}