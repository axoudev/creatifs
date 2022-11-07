<?php

namespace App\Models\Repositories;

use \PDO, \Core\Classes\App;
use PDOException;

abstract class CreatifsRepository
{

    /**
     * Selectione tout les créatifs
     *
     * @param string $message
     * @return Creatif[] $obj un tableau d'objets Creatif
     */
    public static function findAll(&$message = 'CreatifsRepository->findAll: ')
    {
        try{
            $sql = "SELECT * 
                    FROM creatifs;";
            $rs = App::getConnexion()->query($sql);
            $rs->execute();
            $rs->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Creatif');
            $obj = $rs->fetchAll();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $obj;
    }

    /**
     * Selectione le créatif qui correspond à l'ID envoyé
     *
     * @param integer $id identifiant du créatif
     * @param string $message
     * @return Creatif $obj objet Creatif 
     */
    public static function findOneById(int $id, &$message = 'CreatifsRepository->findOneById: ')
    {
        try{
            $sql = "SELECT * 
                    FROM creatifs
                    WHERE id = :id;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":id", $id, PDO::PARAM_INT);
            $rs->execute();
            $rs->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Creatif');
            $obj = $rs->fetch();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $obj;
    }

    public static function findNbProjects(int $id, &$message = 'CreatifsRepository->findOneById: ')
    {
        try{
            $sql = "SELECT count(p.id) 
                    FROM creatifs c JOIN projets p ON c.id = p.creatif
                    WHERE c.id = :id
                    GROUP BY c.id;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":id", $id, PDO::PARAM_INT);
            $rs->execute();
            $nb_projects = $rs->fetchColumn();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $nb_projects;
    }
}