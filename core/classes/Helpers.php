<?php

namespace Core\Classes;
use Core\Classes\App;
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

    public static function isValidImage($image)
    {
        $fileExtension = explode('.', $image['name']);

                //Vérifie si le type est autorisé
        return  in_array($image['type'], App::getAuthorizedImagesType())&&
                //vérifie la faille de double extension (par exemple, "image.php.png")
                count($fileExtension)<=2 && 
                //vérifie que l'extension est autorisée
                in_array(strtolower(end($fileExtension)), App::getAuthorizedImagesExtension())&&
                //vérifie que la taille ne dépasse pas la taille maximale
                $image['size'] <= App::getMaxImageSize() && 
                //vérifie qu'il n'y a pas d'erreur avec l'image
                !$image['error'];
    }
}