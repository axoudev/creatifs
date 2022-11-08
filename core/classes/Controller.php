<?php

namespace Core\Classes;

abstract class Controller
{
    public static function indexAction()
    {
        ${static::$table}= static::$repository::findAll();

        global $content;
        ob_start();
        include '../app/views/'.static::$table.'/index.php';
        $content = ob_get_clean();
    }

    public static function showAction(int $id)
    {
        ${substr(static::$table, 0, -1)}= static::$repository::findAll();

        global $content;
        ob_start();
        include '../app/views/'.static::$table.'/show.php';
        $content = ob_get_clean();
    }
}
?>