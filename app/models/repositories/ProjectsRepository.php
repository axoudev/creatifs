<?php

namespace App\Models\Repositories;

use \PDO, \Core\Classes\App;
use PDOException;

abstract class ProjectsRepository
{
    /**
     * Selectionne les projets par 10 (ordonés du plus récents au plus ancien) en fontion de la page sur laquelle on se trouve
     *
     * @param integer $page n° de la page sur laquelle on se trouve
     * @param string $message
     * @return Project[] $obj Tableau d'objets Projects
     */
    public static function findAll(int $page)
    {
        $low_limit = ($page*10)-10;
        try{
            $sql = "SELECT * 
                    FROM projets
                    ORDER BY dateCreation DESC
                    LIMIT 10 OFFSET :low_limit;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":low_limit", $low_limit, PDO::PARAM_INT);
            $rs->execute();
            $obj = $rs->fetchAll(PDO::FETCH_CLASS, '\App\Models\Project');
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $obj;
    }

    /**
     * Compte le nombre total de projets existants
     *
     * @param string $message
     * @return integer $nb_projects nombre de projets existants
     */
    public static function count()
    {
        try{
            $sql = "SELECT COUNT(id) 
                    FROM projets;";
            $rs = App::getConnexion()->query($sql);
            $rs->execute();
            $nb_projects = $rs->fetchColumn();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $nb_projects;
    }

    /**
     * Trouve un projet en fonction de son ID
     *
     * @param integer $id id du projet
     * @param string $message
     * @return Project $obj objet Project correspondant à l'ID envoyé
     */
    public static function findOneById(int $id)
    {
        try{
            $sql = "SELECT * 
                    FROM projets
                    WHERE id = :id;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":id", $id, PDO::PARAM_INT);
            $rs->execute();
            $rs->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Project');
            $obj = $rs->fetch();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $obj;
    }

    /**
     * Retire les liens entre le projet et ses tags
     *
     * @param integer $projectId ID du projet
     * @param string $message
     * @return void
     */
    private static function deleteProjectLinkToTag(int $projectId)
    {
        try{
            $sql = "DELETE FROM projets_has_tags
                    WHERE projet = :projectId;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":projectId", $projectId, PDO::PARAM_INT);
            $executed = $rs->execute();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $executed;
    }

    /**
     * supprime un projet
     *
     * @param integer $id ID du projet à supprimer
     * @param string $message
     * @return void
     */
    public static function deleteOneById(int $id)
    {
        SELF::deleteProjectLinkToTag($id);
        try{
            $sql = "DELETE FROM projets
                    WHERE id = :id;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":id", $id, PDO::PARAM_INT);
            $executed = $rs->execute();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $executed;
    }

    /**
     * Ajoute un projet à la DB
     *
     * @param array $data les champs du projet
     * @param string $imageName le nom de l'image
     * @return void
     */
    public static function addOne(array $data, string $imageName){
        try{
            $sql = "INSERT INTO projets
                    SET titre = :titre,
                        texte = :texte,
                        image = :image,
                        creatif = :creatif;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":titre", $data['title'], PDO::PARAM_STR);
            $rs->bindValue(":texte", $data['text'], PDO::PARAM_STR);
            $rs->bindValue(":image", $imageName, PDO::PARAM_STR);
            $rs->bindValue(":creatif", (int)$data['creatif_id'], PDO::PARAM_INT);
            $rs->execute();
            $id = App::getConnexion()->lastInsertId();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $id;
    }

    /**
     * Modifie un projet dans la DB
     *
     * @param integer $id ID du projet modifé
     * @param array $data Nouvelles données du projet
     * @param string $imageName Nouvelle image du projet
     * @return void
     */
    public static function editOne(int $id, array $data, string $imageName){
        try{
            $sql = "UPDATE projets
                    SET titre = :titre,
                        texte = :texte,
                        image = :image,
                        creatif = :creatif
                    WHERE id = :id;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":titre", $data['title'], PDO::PARAM_STR);
            $rs->bindValue(":texte", $data['text'], PDO::PARAM_STR);
            $rs->bindValue(":image", $imageName, PDO::PARAM_STR);
            $rs->bindValue(":creatif", (int)$data['creatif_id'], PDO::PARAM_INT);
            $rs->bindValue(":id", $id, PDO::PARAM_INT);
            $executed = $rs->execute();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $executed;
    }
}
?>