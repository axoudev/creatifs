<?php

namespace App\Controllers;

use \App\Models\Repositories\ProjectsRepository;
use App\Models\Repositories\TagsRepository;
use App\Models\Repositories\CreatifsRepository;

abstract class ProjectsController
{
    /**
     * Affiche 10 projets en fonction de la page sur laquelle on se trouve
     *
     * @param integer $page n° de la page sur laquelle on se trouve (page n°1 par défaut)
     * @return void
     */
    public static function indexAction(int $page = 1) :void
    {
        $projects = ProjectsRepository::findAll($page);
        $total_nb_projects = ProjectsRepository::count($page);

        global $content;
        ob_start();
        include '../app/views/projects/index.php';
        $content = ob_get_clean();
    }

    /**
     * Affiche les détails d'un projet
     *
     * @param integer $projectId ID du projet à afficher
     * @return void
     */
    public static function showAction(int $projectId) :void
    {
        $project = ProjectsRepository::findOneById($projectId);
        $tags = TagsRepository::findAllByPost($projectId);

        global $content;
        ob_start();
        include '../app/views/projects/show.php';
        $content = ob_get_clean();
    }

    /**
     * Supprime un projet puis redirige vers la page d'acceuil
     *
     * @param integer $id ID du projet à supprimer
     * @return void
     */
    public static function deleteAction(int $id) :void
    {
        if(ProjectsRepository::deleteOneById($id)){
            header('Location:'.\Core\Classes\App::getPublic_root());
        }else{
            echo 'Erreur lors de la suppression';
        }
        
    }

    /**
     * Envoie sur le formulaire d'ajout d'un projet
     *
     * @return void
     */
    public static function addAction() :void
    {
        $creatifs = CreatifsRepository::findAll();
        
        global $content;
        ob_start();
        include '../app/views/projects/addForm.php';
        $content = ob_get_clean();
    }

    /**
     * Ajout un pprojet à la base de données
     *
     * @param array $data les données du projet
     * @param array $image l'image du projet
     * @return void
     */
    public static function insertAction(array $data, array $image) :void
    {
        if (!empty($image)){
            $fileName = $image['name'];
            $fileType = $image['type'];
            $fileSize = $image['size'];
            $fileTemp = $image['tmp_name'];
            $fileError = $image['error'];

            $AuthorizedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
            $AuthorizedTypes = ['image/png','image/jpg','image/jpeg','image/gif'];

            $fileExtension = explode('.', $image['name']);

            $maxSize = 10000000;

            if(in_array($image['type'], $AuthorizedTypes))
            {
                //faille double extension
                if(count($fileExtension)<=2)
                {
                    //verifie si l'extension est bien dans les extensions autorisées
                    if(in_array(strtolower(end($fileExtension)), $AuthorizedExtensions))
                    {
                        //vérifie que la taille ne dépasse pas la taille maximale
                        if($image['size'] <= $maxSize)
                        {

                        }
                    }
                }
            }
        }
        ProjectsRepository::addOne($data, $image);
        header('Location:'.\Core\Classes\App::getPublic_root());
    }
}