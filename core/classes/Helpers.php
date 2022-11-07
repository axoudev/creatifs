<?php

namespace Core\Classes;
use Core\Classes\App;
abstract class Helpers
{
    /**
     * Formate une date à partir d'une chaine de caractère en fonction du format donné ('d-m-Y' par défaut)
     *
     * @param string $date chaine de caractère
     * @param string $format format voulu de la date
     * @return void
     */
    public static function getFormatedDate(string $date, string $format = 'd-m-Y')
    {
        return date_format(date_create($date), $format);
    }

    /**
     * Crée un slug à partir d'une chaine de caractère donnée
     *
     * @param string $text chaine de caractère
     * @return void
     */
    public static  function slugify(string $text)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', str_replace(array('.','\'',',','!','?',';'),'',iconv('UTF-8','ASCII//TRANSLIT',$text)))));;
    }

    /**
     * Vérifie la validité d'une image
     *
     * @param array $image fichier à vérifier 
     * @return boolean
     */
    public static function isValidImage(array $image)
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