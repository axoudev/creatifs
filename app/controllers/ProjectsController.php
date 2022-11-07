<?php

namespace App\Controllers;

use \App\Models\Repositories\ProjectsRepository;
use App\Models\Repositories\TagsRepository;
use App\Models\Repositories\CreatifsRepository;

use \Core\Classes\App;

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
        $total_nb_projects = ProjectsRepository::count();

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
        $image = ProjectsRepository::findOneById($id)->getImage();

        //Supprime l'image du projet
        if(file_exists('../public/assets/images/'.$image))
        {
            unlink('../public/assets/images/'.$image); 
        }

        //Supprime le projet
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
     * Ajout un projet à la base de données puis redirige vers la page d'acceuil
     *
     * @param array $data les données du projet
     * @param array $image l'image du projet
     * @return void
     */
    public static function insertAction(array $data, array $image) :void
    {
        //vérifie que l'image existe
        if (!empty($image)){
            //crée un nom pour l'image avec un id unique
            $newImgName = uniqid().'.'.strtolower(end(explode('.', $image['name'])));
            //vérifie que l'image est valide
            if(\Core\Classes\Helpers::isValidImage($image)){
                //vérifie qu'il n'y à pas eu d'erreur lors de l'upload
                if(move_uploaded_file($image['tmp_name'], '../public/assets/images/'.$newImgName))
                {
                    //Tout s'est bien passé au niveau de l'image -> on insère les data dans la DB
                    ProjectsRepository::addOne($data, $newImgName);
                    header('Location:'.App::getPublic_root());

                }
                else{
                    echo 'Erreur lors de l\'upload...';
                }
            }
            
        }
    }

    public static function editAction(int $id) :void
    {
        $project = ProjectsRepository::findOneById($id); 
        $projectCreatif = CreatifsRepository::findOneByProjectId($id);
        $creatifs = CreatifsRepository::findAll();

        global $content;
        ob_start();
        include '../app/views/projects/editForm.php';
        $content = ob_get_clean();
    }

    public static function updateAction(int $id, array $data, array $image) :variant_mod
    {
        //ancienne image
        $Oldimage = ProjectsRepository::findOneById($id)->getImage();

        var_dump($image['name']);
        //vérifie que l'image existe
        if (!empty($image) && $image['size'] > 0){
            //crée un nom pour l'image avec un id unique
            $tmp = explode('.', $image['name']);
            $newImgName = uniqid().'.'.strtolower(end($tmp));
            //vérifie que l'image est valide
            if(\Core\Classes\Helpers::isValidImage($image)){
                //vérifie qu'il n'y à pas eu d'erreur lors de l'upload
                if(move_uploaded_file($image['tmp_name'], '../public/assets/images/'.$newImgName))
                {
                    //Supprime l'ancienne image du projet
                    if(file_exists('../public/assets/images/'.$Oldimage))
                    {
                        unlink('../public/assets/images/'.$Oldimage); 
                    }

                    //Tout s'est bien passé au niveau de l'image -> on insère les data dans la DB
                    ProjectsRepository::editOne($id, $data, $newImgName);
                }
                else{
                    echo 'Erreur lors de l\'upload...';
                }
            }
            
        }else{
            //Pas de nouvelle image -> on reprend l'ancienne
            ProjectsRepository::editOne($id, $data, $Oldimage);
        }
        header('Location:'.App::getPublic_root());
    }
}