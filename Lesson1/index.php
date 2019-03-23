<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Практическое задание 1</title>
</head>
<body>

<h2>1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.</h2>

<h2>2. Описать свойства класса из п.1 (состояние).</h2>

<h2>3. Описать поведение класса из п.1 (методы).</h2>

<h2>4. Придумать наследников класса из п.1. Чем они будут отличаться?</h2>

<h2>5. Дан код:</h2>
<p>Что он выведет на каждом шаге? Почему?</p>
<pre>
class A {
public function foo() {
static $x = 0;
echo ++$x;
}
}
$a1 = new A();
$a2 = new A();
    <? class A
    {
        public function foo()
        {
            static $x = 0;
            echo ++$x;
        }
    }

    $a1 = new A();
    $a2 = new A(); ?>

$a1->foo(); // <? $a1->foo(); ?> //
$a2->foo(); // <? $a2->foo(); ?> //
$a1->foo(); // <? $a1->foo(); ?> //
$a2->foo(); // <? $a2->foo(); ?> //
</pre>
<p>переменная X - статическая, является глобальной переменной для объектов этого класса,
    при каждом обращении к методу происходит инкремент этой переменной</p>
<h2>6. Немного изменим п.5:</h2>
<p>Объясните результаты в этом случае.</p>
<pre>
class A {
public function foo() {
static $x = 0;
echo ++$x;
}
}
class B extends A {
}
$a1 = new A();
$b1 = new B();

    <? class A2
    {
        public function foo()
        {
            static $x = 0;
            echo ++$x;
        }
    }

    class B2 extends A2
    {
    }

    $a1 = new A2();
    $b1 = new B2(); ?>

$a1->foo(); // <? $a1->foo(); ?> //
$b1->foo(); // <? $b1->foo(); ?> //
$a1->foo(); // <? $a1->foo(); ?> //
$b1->foo(); // <? $b1->foo(); ?> //</pre>
<p>Ответ: при наследовании класса А создается новая изолированная переменная X, которая является глобальной переменной
    теперь для класса В. Вызовы методов разных классов инкрементируют разные переменные.
</p>

<h2>7. *Дан код:</h2>
<p>Что он выведет на каждом шаге? Почему?</p>
<pre>
class A {
public function foo() {
static $x = 0;
echo ++$x;
}
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
    <?

    class A3
    {
        public function foo()
        {
            static $x = 0;
            echo ++$x;
        }
    }

    class B3 extends A3
    {
    }

    $a1 = new A3;
    $b1 = new B3;
    ?>

$a1->foo(); // <? $a1->foo(); ?> //
$b1->foo(); // <? $b1->foo(); ?> //
$a1->foo(); // <? $a1->foo(); ?> //
$b1->foo(); // <? $b1->foo(); ?> //
</pre>
<p>Ответ: при наследовании класса А создается новая изолированная переменная X, которая является глобальной переменной
    теперь для класса В. Вызовы методов разных классов инкрементируют разные переменные. <br>
Разница между 6 и 7 заданием в том, что при создании объекта нет "скобок" в имени класса, т.к. не переопределен конструктор
    класса и этих параметров нет, поэтому при создании объектов на основании этого класса "скобки"  можно опустить. </p>
</body>
</html>