<?php

namespace Core\Classes;

abstract class Helpers
{
    public static function getFormatedDate(string $date, string $format = 'd-m-Y')
    {
        return date_format(date_create($date), $format);
    }

    public static  function slugify(string $text)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', str_replace(array('.','\'',','),'',$text))));;
    }
}