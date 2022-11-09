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
     * @param string $text chaine de caractère "slugifiée"
     * @return void
     */
    public static  function slugify(string $text)
    {
        //Raccourci le slug à l'espace juste avant le nombre limite de caractères
        $text = SELF::truncate($text, App::getSlugMaxChars());
        //Remplace les caractères accentués par leur équivalent non-accentué
        $text = iconv('UTF-8','ASCII//TRANSLIT', $text);
        //Supprime les caractères spéciaux
        $text = str_replace(App::getSpecialChars(),'',$text);
        //Remplace le espaces par des tirets
        $text = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
        //Met la chaine de caractères en minuscule
        $text = strtolower($text);

        return $text;
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
    
    /**
     * Tronque une chaine de caractères à l'espace juste avant la limite de caractères
     *
     * @param string $string
     * @param int $limit
     * @return string chaine de caractère raccourcie au nombre de caractères limite
     */
    public static function truncate(string $string, int $limit)
    {
        $words = explode(' ', $string);
        $tmpNbChars = 0;

        foreach($words as $key=>$word){
            $tmpNbChars += strlen($word);
            if($tmpNbChars >= $limit){
                $words = array_slice($words, 0, $key);
            }
        }
        return implode(' ', $words);
    }
}