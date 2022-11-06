<?php

namespace Core\Classes;

use \PDO, \PDOException;

abstract class App
{
    private static $_connexion = null, $_public_root, $_root;

    public static function start(): void
    {
        session_start();
        SELF::setConnexion();
        SELF::setPublic_root();
        SELF::setRoot();
    }

    public static function close(): void
    {
        SELF::$_connexion = null;
    }

    // GETTERS 
    public static function getConnexion(): PDO
    {
        return SELF::$_connexion;
    }

    public static function getPublic_root(): string
    {
        return SELF::$_public_root;
    }

    public static function getRoot(): string
    {
        return SELF::$_root;
    }

    // SETTERS 
    private static function setConnexion(): void
    {
        try {
            SELF::$_connexion = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD);
        } catch (PDOException $e) {
            echo "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    private static function setPublic_root(): void
    {
        $tempURL = implode('/', explode('/', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], -2));

        SELF::$_public_root = $tempURL . '/public/';
    }
    private static function setRoot() :void
    {
        SELF::$_root = implode('/', explode('/', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], -2)).'/';
    }
}
?>