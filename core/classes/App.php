<?php

namespace Core\Classes;

use \PDO, \PDOException;

abstract class App
{
    private static $_connexion = null, $_public_root, $_slugMaxChars, $_authorizedImagesExtension, $_authorizedImagesType, $_maxImageSize;

    /**
     * Démarre une session et initialise les propriétés de l'App
     *
     * @return void
     */
    public static function start(): void
    {
        session_start();
        SELF::setConnexion();
        SELF::setPublic_root();
        SELF::setAuthorizedImagesExtension();
        SELF::setAuthorizedImagesType();
        SELF::setMaxImageSize();
        SELF::setSlugMaxchars();
    }

    /**
     * Ferme la connexion à la DB
     *
     * @return void
     */
    public static function close(): void
    {
        SELF::$_connexion = null;
    }


    //------------------------
    // GETTERS 
    //------------------------
    
    /**
     * Retourne la connexion à la db
     *
     * @return PDO connexion à la db
     */
    public static function getConnexion(): PDO
    {
        return SELF::$_connexion;
    }

    /**
     * Retourne le chemin absolu du dossier public
     *
     * @return string chemin absolu du dossier public
     */
    public static function getPublic_root(): string
    {
        return SELF::$_public_root;
    }

    /**
     * Retourne les extensions d'images acceptées
     *
     * @return array tableau d'extensions d'image
     */
    public static function getAuthorizedImagesExtension() :array
    {
        return SELF::$_authorizedImagesExtension;
    }

    /**
     * Retourne les types d'images acceptés
     *
     * @return array tableau de types d'images
     */
    public static function getAuthorizedImagesType() :array
    {
        return SELF::$_authorizedImagesType;
    }

    /**
     * Retourne la taille maximale acceptée pour un image
     *
     * @return integer taille maximale d'une images
     */
    public static function getMaxImageSize() :int
    {
        return SELF::$_maxImageSize;
    }

    /**
     * Retourne le nombre maximum de caracteres pour un slug
     *
     * @return integer nombre macimal de caractères
     */
    public static function getSlugMaxChars() :int
    {
        return SELF::$_slugMaxChars;
    }
    //------------------------
    // SETTERS 
    //------------------------

    /**
     * Crée la connexion à la base de données
     *
     * @return void
     */
    private static function setConnexion(): void
    {
        try {
            SELF::$_connexion = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD);
        } catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * instancie le chemin absolu du dossier public
     *
     * @return void
     */
    private static function setPublic_root(): void
    {
        $tempURL = implode('/', explode('/', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], -2));

        SELF::$_public_root = $tempURL . '/public/';
    }

    /**
     * instancie les extension autorisée pour les images
     *
     * @return void
     */
    private static function setAuthorizedImagesExtension() :void
    {
        SELF::$_authorizedImagesExtension = ['png', 'jpg', 'jpeg', 'gif'];
    }

    /**
     * instancie les types autorisés pour les images
     *
     * @return void
     */
    private static function setAuthorizedImagesType() :void
    {
        SELF::$_authorizedImagesType = ['image/png','image/jpg','image/jpeg','image/gif'];;
    }

    /**
     * instancie la taille maximale autorisée pour une image
     *
     * @return void
     */
    private static function setMaxImageSize() :void
    {
        SELF::$_maxImageSize = 10000000;
    }

    /**
     * instancie le nombre maximal de caractères dans un slug
     *
     * @return void
     */
    private static function setSlugMaxchars() :void
    {
        SELF:: $_slugMaxChars = 25;
    }
}
?>