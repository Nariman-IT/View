<?php

class View 
{
    // Путь к папке с шаблонами
    protected string $path;

    // Данные для передачи в шаблон
    protected array $data = [];

    // Полный путь к файлу представления
    protected string $pathToFile;



    public function __construct(string $path)
    {
        // Убираем лишний слэш
        $this->path = rtrim($path, '/');
    }


    // Метод передачи данных данных в представление
    public function make(string $view, array $data = []): self 
    {
        $this->data = $data;
        $this->pathToFile = "{$this->path}/" . str_replace('.', '/', $view) . '.php';

        if(!file_exists($this->pathToFile)) {
            throw new Exception("View file {$this->pathToFile} not found.");
        }

        return $this;
    }


    // Метод для отображения представления
    public function render(): string 
    {

        // Извлекаем данные для использования в шаблоне
        extract($this->data);


        // Включаем буферизацию вывода
        ob_start();
        include $this->pathToFile;
        return ob_get_clean(); // Возвращаем содержимое буфера

    }


    // Статический хелпер для быстрого вызова
    public static function renderStatic(string $path, string $view, array $data = []): string 
    {
        return (new self($path))->make($view, $data)->render();
    }

}





