<?php

class View
{
    // Путь к директории с шаблонами
    protected string $basePath;

    // Данные для передачи в шаблон
    protected array $data = [];

    // Глобальные переменные (общие для всех шаблонов)
    protected static array $sharedData = [];




    // Конструктор: Устанавливаем базовый путь к шаблонам
    // @param string $basePath
    public function __construct(string $basePath)
    {
        //  Убираем лишний слэш
        $this->basePath = rtrim($basePath, '/');
    }


    // Установка глобальных данных
    // @param string $key
    // @param mixed $value
    public static function share(string $key, $value): void 
    {
        self::$sharedData[$key] = $value;
    }


    // Установка данных для текущего шаблона
    // @param array $data
    public function with(array $data = []): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }





     // Рендеринг шаблонов
    //  @param string $view Имя шаблона (без расширения)
    //  @param array $data Локальные данные для шаблона
    //  @return string Результат рендеринга
    public function render(string $view, array $data = []): string
    {

        //Полный путь к файлу шаблона
        $viewPath = $this->resolveViewPath($view);

        // Проверяем наличие файла
        if(!file_exists($viewPath)) {
            throw new Exception("Шаблон {$view} не найден по пути: {$viewPath}");
        }


        // Объединяем локальные, общие и глобальные данные
        $data = array_merge(self::$sharedData, $this->data, $data);

        // Старт буферизации
        ob_start();

        // Извлекаем переменые 
        extract($data);

        // Подключаем файл шаблона

        try {
            include $viewPath;
        } catch (Throwable $th) {
            // В случае ошибки очищаем буфер
            ob_end_clean();
            throw $e;
        }


        // Возвращаем результат и очищаем буфер 
        return ob_get_clean();
         
    }


    // Путь к шаблону
    // @param string $view
    // @return string
    protected function resolveViewPath(string $view):string
    {
        // Преобразует имя шаблона в путь
        return "{$this->basePath}/" . str_replace('.', '/', $view) . '.php';
    }


    // Рендеринг другого шаблона внутри текущего
    // @param string $view Имя вложеного шаблона
    // @param array $data Локальные данные для вложенного шаблона
    public function include(string $view, array $data = []): void
    {
        echo $this->render($view, $data);
    }

}
