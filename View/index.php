<?php

include_once 'classView.php';

$view = new View(__DIR__ . '/views');

View::share('appName', 'My Awesome App');


echo $view->with(['index' => 'Данные для текущего шаблона.'])->render('home', [
    'title' => 'Главная страница',
    'content' => 'Добро пожаловать на наш сайт!',
]);

