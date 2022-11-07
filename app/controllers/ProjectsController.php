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
        if (!empty($image)){

            $fileExtension = explode('.', $image['name']);

            if(in_array($image['type'], App::getAuthorizedImagesType()))
            {
                //vérifie la faille de double extension (par exemple, "image.php.png") et vérifie que l'extension est autorisée
                if(count($fileExtension)<=2 && in_array(strtolower(end($fileExtension)), App::getAuthorizedImagesExtension()))
                {
                    //vérifie que la taille ne dépasse pas la taille maximale et qu'il n'y à pas d'erreur
                    if($image['size'] <= App::getMaxImageSize() && !$image['error'])
                    {
                        $newImgName = uniqid().'.'.\strtolower(end($fileExtension));
                        //vérifie qu'il n'y à pas eu d'erreur lors de l'upload
                        if(move_uploaded_file($image['tmp_name'], '../public/assets/images/'.$newImgName))
                        {
                            //Tout s'est bien passé au niveau de l'image -> on insère les data dans la DB
                            $executed = ProjectsRepository::addOne($data, $newImgName);
                            header('Location:'.App::getPublic_root());

                        }
                        else{
                            echo 'Erreur lors de l\'upload...';
                        }
                    }
                    else{
                        echo 'Taille du fichier trop grande ...';
                    } 
                }
                else{
                    echo 'Type de fichier non autorisé';
                }
            }
        }
    }
}