<?php
require __DIR__ . '/../vendor/autoload.php';
try {
    unset($argv[0]);

    spl_autoload_register(function (string $className) {
require_once __DIR__ . '/../../src/' . $className . '.php';
    });

    // Составляем полное имя класса, добавив нэймспейс
    $className = '\\MyProject\\Cli\\' . array_shift($argv);
    if (!class_exists($className)) {
        throw new \MyProject\Exceptions\CliException('Class "' . $className . '" not found');
    }

    // Подготавливаем список аргументов
    $params = [];
    foreach ($argv as $argument) {
        preg_match('/^-(.+)=(.+)$/', $argument, $matches);
        if (!empty($matches)) {
            $paramName = $matches[1];
            $paramValue = $matches[2];

            $params[$paramName] = $paramValue;
        }
    }

    //Проверка на то, что класс, указанный в качестве аргумента, является наследником класса AbstractCommand
    if (!class_exists($className)) {
        throw new \MyProject\Exceptions\CliException('Class "' . $className . '" is not inherited');
    }

    $class = new $className($params);
    $class->execute();

} catch (\MyProject\Exceptions\CliException $e) {
    echo 'Error: ' . $e->getMessage();
}
