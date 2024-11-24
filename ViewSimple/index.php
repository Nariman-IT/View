<?php


require_once 'classView.php';

try{
    // Cоздаем экземпляр класса View
    $view = new View(__DIR__ . '/views');

    // Рендерим шаблон
    $output = $view->make('welcome', ['message' => 'Привет, Laravel на PHP!'])->render();

    // Выводим результат
    echo $output;

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}


// Пример через статический метод 

require_once 'classView.php';

echo View::renderStatic(__DIR__ . '/views', 'welcome', ['message' => 'Привет, мир!']);